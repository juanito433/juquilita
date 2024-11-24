<?php
$host = "localhost"; 
$usuario = "root"; 
$contraseña = ""; 
$baseDeDatos = "fruteria"; 

$conexion = new mysqli($host, $usuario, $contraseña, $baseDeDatos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");


?>
