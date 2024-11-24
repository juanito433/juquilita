<?php
$conexion = mysqli_connect("localhost", "root", "", "fruteria");

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conexion, $_GET['query']);

    // Consulta para buscar productos
    $sql = "SELECT id, nombre, precio FROM products WHERE nombre LIKE '%$query%'";
    $resultado = mysqli_query($conexion, $sql);

    $productos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $productos[] = [
            'nombre' => $row['nombre'],
            'precio' => $row['precio']
            // Solo enviar el nombre del producto
        ];

    }

    // Retornar los resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($productos);
}
