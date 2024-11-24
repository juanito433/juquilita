<?php
$conexion = mysqli_connect("localhost", "root", "", "fruteria") or die("Error de conexión en la base de datos");
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
header("Location: ../tabla-productos.php");
exit();
?>
