<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_POST['id']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido_paterno = mysqli_real_escape_string($conexion, $_POST['apellido_paterno']);
$apellido_materno = mysqli_real_escape_string($conexion, $_POST['apellido_materno']);
$tipo = mysqli_real_escape_string($conexion,$_POST['tipo']);

$consulta = "UPDATE Cliente SET nombre_cliente='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno', tipo_cliente='$tipo' WHERE id_cliente=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-clientes.php");
exit();
?>
