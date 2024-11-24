<?php
$conexion = mysqli_connect("localhost", "root", "", "fruteria");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productos = json_decode(file_get_contents('php://input'), true);

    foreach ($productos as $producto) {
        $id = $producto['id'];
        $cantidad = $producto['cantidadGramos'];
        $precio = $producto['precioTotal'];

        $sql = "INSERT INTO ventas (producto_id, cantidad, precio_total) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, 'iid', $id, $cantidad, $precio);
        mysqli_stmt_execute($stmt);
    }

    echo "Venta registrada.";
    mysqli_close($conexion);
}
?>
