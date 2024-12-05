<?php
include('../../../connection/conexion.php');
$id = intval($_POST['id']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$precio = mysqli_real_escape_string($conexion, $_POST['precio']);
$empresa = mysqli_real_escape_string($conexion, $_POST['description']);
$tipo = mysqli_real_escape_string($conexion, $_POST['stock']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['fecha_caducidad']);
$marca = mysqli_real_escape_string($conexion, $_POST['categoria']);


$consulta = "UPDATE products SET nombre='$nombre', precio='$precio', description='$empresa', stock='$tipo', fecha_caducidad='$descripcion', categoria='$marca' WHERE id=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../productos.php");
exit();
?>
