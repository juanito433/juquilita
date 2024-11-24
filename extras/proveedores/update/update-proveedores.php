<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_POST['id']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$rfc = mysqli_real_escape_string($conexion, $_POST['rfc']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);


$consulta = "UPDATE proveedores SET empresa='$nombre', direccion='$direccion', telefono='$telefono',  rfc='$rfc', correo='$correo' WHERE id_empresa=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-proveedores.php");
exit();
?>
