<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_POST['id']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido_paterno = mysqli_real_escape_string($conexion, $_POST['apellido_paterno']);
$apellido_materno = mysqli_real_escape_string($conexion, $_POST['apellido_materno']);
$edad = intval($_POST['edad']);
$direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$rfc = mysqli_real_escape_string($conexion, $_POST['rfc']);
$departamento = mysqli_real_escape_string($conexion, $_POST['departamento']);

$consulta = "UPDATE Empleado SET nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno', edad=$edad, direccion='$direccion', correo='$correo', rfc='$rfc', departamento='$departamento' WHERE id_empleado=$id";
mysqli_query($conexion, $consulta);
mysqli_close($conexion);
header("Location: ../tabla-empleados.php");
exit();
?>
