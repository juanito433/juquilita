<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_users'])) {
    header("Location: ../login/login.html");
    exit();
}

// Conectar a la base de datos
include('../connection/conexion.php');

// Obtener datos del usuario logueado
$user_id = $_SESSION['id_users'];
$store_id = $_GET['id']; // ID de la tienda
$consulta_user = "SELECT * FROM users WHERE id = '$user_id'";
$resultado_user = mysqli_query($conexion, $consulta_user) or die(mysqli_error($conexion));

$user = mysqli_fetch_assoc($resultado_user);
$usuario = $user['nombre'];
$direccion = $user['direccion'];
$metodopago = 'efectvo';
$status = 'pendiente';
// Obtener el carrito desde el almacenamiento local (suponiendo que se pasa como POST)
$cart_data = isset($_POST['cart_data']) ? json_decode($_POST['cart_data'], true) : [];

// Verificar si el carrito está vacío
if (empty($cart_data)) {
    die("El carrito está vacío.");
}

// Iniciar la transacción
mysqli_begin_transaction($conexion);

try {
    // Insertar la nueva orden
    $total_price = 0;
    foreach ($cart_data as $item) {
        $total_price += $item['subtotal'];
    }

    $query_order = "INSERT INTO orders (direccion_entrega, status, total, fecha,  users_id, metodo_pago, store_id) 
                    VALUES ('$direccion', '$status', '$total_price',NOW(),'$user_id','$metodopago', '$store_id' )";
    $result_order = mysqli_query($conexion, $query_order);

    if (!$result_order) {
        throw new Exception("Error al insertar la orden.");
    }

    $order_id = mysqli_insert_id($conexion); // Obtener el ID del nuevo pedido

    // Insertar los productos del carrito en la tabla order_items
    foreach ($cart_data as $item) {
        $product_id = $item['products_id'];
        $quantity = $item['cantidad'];
        $subtotal = $item['subtotal'];
        $pricePerUnit = $item['precio_unitario'] * 1000;
        // Insertar el producto en order_items
        $query_order_item = "INSERT INTO orders_details (cantidad,precio_unitario, total, orders_id, products_id) 
                             VALUES ('$quantity','$pricePerUnit','$subtotal','$order_id', '$product_id')";
        $result_order_item = mysqli_query($conexion, $query_order_item);

        if (!$result_order_item) {
            throw new Exception("Error al insertar el producto en la orden.");
        }

        // Actualizar el inventario de la tienda
        $query_inventory = "UPDATE products SET stock = stock - $quantity WHERE id = '$product_id'";
        $result_inventory = mysqli_query($conexion, $query_inventory);

        if (!$result_inventory) {
            throw new Exception("Error al actualizar el inventario.");
        }
    }

    // Confirmar la transacción
    mysqli_commit($conexion);
    echo "<script>alert('¡Pedido realizado con éxito!'); window.location.href = 'index.php?id=$store_id';</script>";
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    mysqli_rollback($conexion);
    echo "Error al procesar el pedido: " . $e->getMessage();
}

// Cerrar la conexión
mysqli_close($conexion);
