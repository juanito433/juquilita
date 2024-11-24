<?php
$conexion = mysqli_connect("localhost", "root", "", "fruteria");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query) {
    $query = mysqli_real_escape_string($conexion, $query);
    $sql = "SELECT id, nombre, description, precio FROM products WHERE nombre LIKE '%$query%'";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        $productos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
        echo json_encode($productos);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

mysqli_close($conexion);
?>
