<?php
include('../../../connection/conexion.php');

// Verificar y sanitizar el parámetro recibido
$id = intval($_GET['id']);
if (!$id) {
    die("ID inválido.");
}

// Iniciar una transacción para garantizar la consistencia de los datos
mysqli_begin_transaction($conexion);

try {
    // Eliminar detalles de órdenes relacionados con el producto
    $consulta_order = "DELETE FROM orders_details WHERE products_id = $id";
    $stmt_order = $conexion->prepare($consulta_order);
    $stmt_order->bind_param("i", $id);
    $stmt_order->execute();

    // Verificar si la consulta fue exitosa
    if ($stmt_order->affected_rows < 0) {
        throw new Exception("Error al eliminar detalles de órdenes.");
    }

    // Eliminar el producto
    $consulta = "DELETE FROM products WHERE id = $id";
    $stmt_product = $conexion->prepare($consulta);
    $stmt_product->bind_param("i", $id);
    $stmt_product->execute();

    // Verificar si la consulta fue exitosa
    if ($stmt_product->affected_rows <= 0) {
        throw new Exception("Error al eliminar el producto.");
    }

    // Confirmar la transacción si todo salió bien
    mysqli_commit($conexion);
} catch (Exception $e) {
    // Revertir los cambios en caso de error
    mysqli_rollback($conexion);
    die("Error: " . $e->getMessage());
} finally {
    // Cerrar los statement y la conexión
    $stmt_order->close();
    $stmt_product->close();
    mysqli_close($conexion);
}

// Redirigir al usuario después de eliminar el producto
header("Location: ../productos.php");
exit();
?>
