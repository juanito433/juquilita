<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "DELETE FROM inventario WHERE id_inventario=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-inventario.php");
exit();
?>