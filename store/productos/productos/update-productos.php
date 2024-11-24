<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frutitasjuquilitadb";
$conn = new mysqli($servername, $username, $password, $dbname);
// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$query1 = "SELECT * FROM proveedores;";
$query2 = "SELECT * FROM tipo_producto";
$query3 = "SELECT * FROM productos";
$query4 = "SELECT *FROM inventario";

$result2 = $conn->query($query2);
$result1 = $conn->query($query1);
$result3 = $conn->query($query3);
$result4 = $conn->query($query4);



$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTA INVENTARIO</title>
    <link rel="stylesheet" href="formularios.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <br>
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-2 col-md-1"></div>
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form action="alta-inventario-subida.php" method="post">
                    <div class="formulario">
                        <center>
                            <h1>ACTUALIZAR Productos</h1>
                        </center>
                        <label for="nombre">Producto en inventario a actualizar:</label>
                        <select name="empleado" id="empleado" title="empleado" class="input-shadow" required>
                            <option selected>Identifica</option>
                            <?php
                            if ($result4->num_rows > 0) {
                                while ($filas = $result4->fetch_assoc()) {
                                    $filas2 = $result3->fetch_assoc();
                                    echo "<option value='" . $filas['id_inventario'] . "'>" . $filas['nombre'] . " (ID: " . $filas2['nombre_producto'] . ")</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="input-shadow">
                    
                        <label for="apellido">Precio:</label>
                        <input type="text" id="apellido-paterno" name="apellido-paterno" class="input-shadow" title="ap">

                        <label for="apellido">Empresa:</label>
                        <input type="text" id="apellido-materno" name="apellido-materno" class="input-shadow" title="am">

                        <label for="email">tipo:</label>
                        <input type="number" max="65" min="18" id="edad" name="edad" class="input-shadow" title="edad">
                    
                        <label for="telefono">Descripción:</label>
                        <input type="text" id="direccion" name="direccion" class="input-shadow" title="direc">

                        <label for="telefono">Marca:</label>
                        <input type="email" id="correo" name="correo" class="input-shadow" title="email">


                        <div class="btn-group">
                            <button type="submit" id="insertar" class="btn btn-primary">Insertar</button>
                            <!-- <button type="button" id="editar" class="btn btn-warning">Editar</button>
                            <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
                            <button type="button" id="actualizar" class="btn btn-success">Actualizar</button> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-md-1"></div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>