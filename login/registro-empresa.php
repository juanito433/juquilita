<?php
// Recibir datos del formulario
$nombre = $_POST['nombre_tienda'];
$ubicación = $_POST['ubicación'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

// Obtener la fecha actual como timestamp desde el servidor
date_default_timezone_set('America/Mexico_City'); // Cambia la zona horaria si es necesario
$fecha_creacion = date('Y-m-d H:i:s');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "fruteria");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Comprobar si se cargó una imagen
if (isset($_FILES['foto'])) {
    $image_file = $_FILES['foto'];

    // Verificar si la imagen se subió correctamente
    if ($image_file['error'] == UPLOAD_ERR_OK && is_uploaded_file($image_file['tmp_name'])) {
        // Leer el contenido del archivo de la imagen
        $image_data = file_get_contents($image_file['tmp_name']);
        // Escapar los datos binarios de la imagen para evitar errores SQL
        $foto = mysqli_real_escape_string($conexion, $image_data);

        // Preparar la consulta de inserción
        $consulta = "INSERT INTO store (nombre, ubicacion, foto, fecha_creacion, correo, password, telefono) VALUES ('$nombre', '$ubicación', '$foto', '$fecha_creacion', '$email', '$password', '$phone')";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $consulta)) {
            // Redirigir a la página de productos
            header("Location: ../store/productos/tabla-productos.php");
            exit;
        } else {
            echo "Error al subir el producto: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al cargar la imagen.";
    }
} else {
    echo "No se recibió ninguna imagen.";
}

// Cerrar la conexión
mysqli_close($conexion);
