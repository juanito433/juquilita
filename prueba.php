<?php

include('connection/conexion.php');
$consulta_user = "SELECT * FROM users WHERE id = 1";
$resultado_user = mysqli_query($conexion, $consulta_user) or die(mysqli_error($conexion));

$user= mysqli_fetch_assoc($resultado_user);
$usuario= $user['nombre'];
?>