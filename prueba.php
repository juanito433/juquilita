<?php 
include('connection/conexion.php');

// Consulta para obtener el inventario
$consulta_inventario = "SELECT * FROM inventories WHERE store_id = 1";
echo $consulta_inventario;  // Verifica que la consulta es correcta
$resultado_inventario = mysqli_query($conexion, $consulta_inventario) or die(mysqli_error($conexion));

if (mysqli_num_rows($resultado_inventario) > 0) {
    $fila_inventario = mysqli_fetch_row($resultado_inventario);
    $id_inventario = $fila_inventario[0];  // Cambiar el índice según la estructura de la tabla
    echo "ID Inventario: " . $id_inventario;  // Verifica el valor de $id_inventario
} else {
    echo "No se encontraron inventarios para la tienda.";
}

// Consulta para obtener los productos asociados al inventario
$consulta = "SELECT * FROM products WHERE inventories_id = 1";
echo $consulta;  // Verifica que la consulta es correcta
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

if (mysqli_num_rows($resultado) > 0) {
    while ($products = mysqli_fetch_assoc($resultado)) {
        // Mostrar cada producto
        echo "Producto: " . $products['nombre'] . "<br>";
    }
} else {
    echo "No se encontraron productos para este inventario.";
}
?>
