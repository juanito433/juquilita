<?php
include('../connection/conexion.php');
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $store_id = mysqli_real_escape_string($conexion, $_POST['store_id']);

    // Validar datos
    if (empty($nombre) || empty($store_id)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Insertar el nuevo inventario
    $query = "INSERT INTO inventories (nombre, fecha_creacion, store_id) VALUES ('$nombre', NOW(), '$store_id')";
    if (mysqli_query($conexion, $query)) {
        header("Location: panel.php"); // Redirigir al panel
        exit();
    } else {
        die("Error al crear el inventario: " . mysqli_error($conexion));
    }
} else {
    header("Location: ../login/login.html");
    exit();
}
?>
