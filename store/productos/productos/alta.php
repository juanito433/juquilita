<?php
include('../../../connection/conexion.php');
// Recibir datos del formulario
$nombre = $_POST['nombre'];
$description = $_POST['description'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fecha_caducidad = $_POST['fecha_caducidad'];
$categoria = $_POST['categoria'];
session_start(); // Siempre al inicio

if (!isset($_SESSION['id_store'])) {
    header("Location: ../../login/login_empresa.html");
    exit();
}
$id_store = $_SESSION['id_store'];
$queryinventario = "SELECT * FROM inventories WHERE store_id = '$id_store'";
$inventario = mysqli_query($conexion, $queryinventario);
$inv = mysqli_fetch_row($inventario);
$inventario = $inv[0];

// Obtener la fecha actual como timestamp desde el servidor
date_default_timezone_set('America/Mexico_City'); // Cambia la zona horaria si es necesario
$fecha_actual = date('Y-m-d H:i:s');

// Conexión a la base de datos

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
        $consulta = "INSERT INTO products (nombre, description, precio, stock, foto, fecha_caducidad, fecha_actualizacion, inventories_id, categoria ) 
                    VALUES ('$nombre', '$description', '$precio', '$stock', '$foto', '$fecha_caducidad', '$fecha_actual' ,'$inventario','$categoria')";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $consulta)) {
            // Redirigir a la página de productos
            header("Location: ../productos.php");
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
