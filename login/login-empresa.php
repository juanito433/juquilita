<?php
// Recibir datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Verificar que no estén vacíos
if (empty($email) || empty($password)) {
    die("El correo y la contraseña son obligatorios.");
}

// Conexión a la base de datos
include('../connection/conexion.php');
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Usar una consulta preparada para evitar inyección SQL
$consulta = $conexion->prepare("SELECT * FROM store WHERE correo = '$email' AND password = '$password'");

// Ejecutar la consulta
$consulta->execute();
$resultado = $consulta->get_result();
$store = mysqli_fetch_assoc($resultado);


// Validar credenciales
if ($resultado->num_rows > 0) {
    // Usuario válido: redirigir a la página de productos
    session_start();
    $_SESSION['id_store'] = $store['id'];
    header("Location: ../store/panel.php");
    exit;
} else {
    // Credenciales incorrectas
    echo "Correo o contraseña incorrectos.";
}

// Cerrar la consulta y la conexión
$consulta->close();
mysqli_close($conexion);
?>