<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_POST['id']);
$codigo = mysqli_real_escape_string($conexion, $_POST['codigo']);
$existencia = mysqli_real_escape_string($conexion, $_POST['existencia']);
$fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
$empresa = mysqli_real_escape_string($conexion, $_POST['empresa']);


$consulta = "UPDATE inventario SET codigo_id='$codigo', existencia='$existencia', fecha_entrada='$fecha', id_empresa='$empresa' WHERE id_inventario=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-inventario.php");
exit();
?>
