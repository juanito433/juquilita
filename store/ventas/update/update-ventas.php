<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_POST['id']);
$codigo = mysqli_real_escape_string($conexion, $_POST['codigo']);
$cantidad = intval($_POST['cantidad']);
$total = intval($_POST['total']);
$fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
$cliente = mysqli_real_escape_string($conexion, $_POST['cliente']);
$empleado = mysqli_real_escape_string($conexion, $_POST['empleado']);

$consulta = "UPDATE ventas SET codigo_id='$codigo', cantidad=$cantidad, total=$total, fecha_salida='$fecha', id_cliente='$cliente', id_empeado='$empleado' WHERE folio_venta=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-ventas.php");
exit();
?>
