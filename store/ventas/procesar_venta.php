<?php
include('../../connection/conexion.php');
session_start();

if (!isset($_SESSION['id_store'])) {
    header("Location: ../../login/login_empresa.html");
    exit();
}

$id_store = $_SESSION['id_store'];
$carrito = json_decode(file_get_contents('php://input'), true);

if (empty($carrito)) {
    http_response_code(400);
    echo json_encode(['error' => 'El carrito está vacío.']);
    exit();
}

// Calcular el total de la venta
$total = 0;
foreach ($carrito as $producto) {
    if (!isset($producto['precioTotal'], $producto['cantidadGramos'], $producto['precioPorKilo'], $producto['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Datos incompletos en el carrito.']);
        exit();
    }
    $total += $producto['precioTotal'];
}

// Insertar en la tabla sales
date_default_timezone_set('America/Mexico_City');

$fecha = date('Y-m-d H:i:s');
$queryVenta = "INSERT INTO sales (fecha, total, store_id) VALUES ('$fecha', '$total', '$id_store')";

if (!mysqli_query($conexion, $queryVenta)) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al registrar la venta: ' . mysqli_error($conexion)]);
    exit();
}

$sale_id = mysqli_insert_id($conexion);

// Insertar en la tabla sales_details
foreach ($carrito as $producto) {
    $cantidad = $producto['cantidadGramos'];
    $precio_unitario = $producto['precioPorKilo'] / 1000;
    $subtotal = $producto['precioTotal'];
    $product_id = $producto['id'];

    $queryDetalle = "INSERT INTO sales_details (cantidad, precio_unitario, subtotal, sales_id, products_id) 
                     VALUES ('$cantidad', '$precio_unitario', '$subtotal', '$sale_id', '$product_id')";
    if (!mysqli_query($conexion, $queryDetalle)) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al insertar detalles: ' . mysqli_error($conexion)]);
        exit();
    }
}

echo json_encode([
    'success' => true,
    'message' => 'Venta registrada correctamente.',
    'total' => $total
]);

mysqli_close($conexion);
?>
