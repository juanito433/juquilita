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
$consulta_clientes = "SELECT * FROM productos;";

$resultado_clientes = $conn->query($consulta_clientes);
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de datos</title>
    <link rel="stylesheet" href="formularios.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <br>
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-2 col-md-1"></div>
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form action="delete-clientes-base.php" method="post">
                    <div class="formulario">
                        <center>
                            <h1>ELIMINAR PRODUCTOS</h1>
                        </center>
                        <label for="nombre">Nombre:</label>
                        <select name="cliente" id="cliente" title="IDCliente" class="input-shadow" required>
                            <option selected>Escoge un producto</option>
                            <?php
                            if ($resultado_clientes->num_rows > 0) {
                                while ($filas = $resultado_clientes->fetch_assoc()) {
                                    echo "<option value='" . $filas['codigo_id'] . "'>" . $filas['nombre_producto'] . " (ID: " . $filas['codigo_id'] . ")</option>";
                                }
                            }
                            ?>
                        </select>



                        <div class="btn-group">
                            <button type="submit" id="insertar" class="btn btn-danger">Eliminar</button>
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