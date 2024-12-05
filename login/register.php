<?php
// Recibir datos del formulario
$nombre = $_POST['nombre'];
$ubicacion = $_POST['ubicacion'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

date_default_timezone_set('America/Mexico_City');

$fecha_creacion = date('Y-m-d H:i:s');

include('../connection/conexion.php');

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Preparar la consulta de inserción
$consulta = "INSERT INTO users (nombre, correo, password, direccion, telefono, fecha_creacion) VALUES ('$nombre', '$email', '$password', '$ubicacion', '$phone', '$fecha_creacion')";

// Ejecutar la consulta
if (mysqli_query($conexion, $consulta)) {
    // Redirigir a la página de productos
    header("Location: ../app/index.php");
    exit;
} else {
    echo "Error al registrar: " . mysqli_error($conexion);
}


// Cerrar la conexión
mysqli_close($conexion);
