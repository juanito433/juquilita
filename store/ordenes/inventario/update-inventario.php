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
                            <h1>ACTUALIZAR INVENTARIO</h1>
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

                        <label for="producto">Productos</label>
                        <select name="producto" id="producto" title="IDCliente" class="input-shadow" required>
                            <option selected>Escoge un producto</option>
                            <?php
                            if ($result3->num_rows > 0) {
                                while ($row = $result3->fetch_assoc()) {
                                    echo "<option value='" . $row['codigo_id'] . "'>" . $row['nombre_producto'] . " (ID: " . $row['codigo_id'] . ")</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="exitensia">Existencia:</label>
                        <input id="existenCia" name="existenCia" type="number" class="input-shadow" placeholder="numero de producto">

                        <label for="fecha">Fecha de entrada:</label>
                        <input id="Fecha" name="Fecha" type="date" class="input-shadow" placeholder="aaaa/mm/dd">

                        <label for="tipo">Empresa:</label>
                        <select name="empresa" id="empresa" title="IDCliente" class="input-shadow" required>
                            <option selected>Escoge un producto</option>
                            <?php
                            if ($result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    echo "<option value='" . $row['id_empresa'] . "'>" . $row['empresa'] . " (ID: " . $row['id_empresa'] . ")</option>";
                                }
                            }
                            ?>
                        </select>

                        <div class="btn-group">
                            <button type="submit" id="insertar" class="btn btn-success">Actualizar</button>
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