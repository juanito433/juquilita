<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "DELETE FROM cliente WHERE id_cliente=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-clientes.php");
exit();
?>
