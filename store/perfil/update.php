<?php
include('../../connection/conexion.php');
session_start();

if (!isset($_SESSION['id_store'])) {
    header("Location: ../../login/login_empresa.html");
    exit();
}

// Captura el ID de la tienda
$id_store = $_SESSION['id_store'];

// Recoge los datos del formulario
$name = mysqli_real_escape_string($conexion, $_POST['nombre']);
$location = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
$email = mysqli_real_escape_string($conexion, $_POST['correo']);
$phone = mysqli_real_escape_string($conexion, $_POST['telefono']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

// Manejo de la imagen
$image_query = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $image_file = $_FILES['foto']['tmp_name'];
    $image_data = file_get_contents($image_file);
    $escaped_image_data = mysqli_real_escape_string($conexion, $image_data);
    $image_query = ", foto = '$escaped_image_data'";
}

// Construcción de la consulta SQL
$query = "UPDATE store SET 
          nombre = '$name',
          ubicacion = '$location',
          correo = '$email',
          telefono = '$phone'";

if ($password) {
    $query .= ", password = '$password'";
}

$query .= $image_query;
$query .= " WHERE id = '$id_store'";

// Ejecución de la consulta
if (mysqli_query($conexion, $query)) {
    header("Location: perfil.php?success=1");
    exit();
} else {
    echo "Error al actualizar los datos: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
