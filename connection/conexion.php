<?php
$host = "localhost"; 
$usuario = "u418684783_juquilita1"; 
$contraseña = "Juquilita123"; 
$baseDeDatos = "u418684783_juquilita"; 

$conexion = new mysqli($host, $usuario, $contraseña, $baseDeDatos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");


?>
