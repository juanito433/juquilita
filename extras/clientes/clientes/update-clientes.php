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
$consulta = "SELECT * FROM cliente;";

$resultado = $conn->query($consulta);
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
                <form action="update-empleado-base.php" method="post">
                    <div class="formulario">
                        <center>
                            <h1>ACTUALIZAR CLIENTES</h1>
                        </center>
                        <label for="nombre">Cliente a actualizar:</label>
                        <select name="cliente" id="cliente" title="cliente" class="input-shadow" required>
                            <option selected>Identifica</option>
                            <?php
                            if ($resultado->num_rows > 0) {
                                while ($filas = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $filas['id_cliente'] . "'>" . $filas['nombre_cliente'] . " (ID: " . $filas['id_cliente'] . ")</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="nombre">Nombre nuevo:</label>
                        <input type="text" id="nombre" name="nombre" class="input-shadow">

                        <label for="apellido">Apellido Paterno:</label>
                        <input type="text" id="apellido-paterno" name="apellido-paterno" class="input-shadow" title="ap">

                        <label for="apellido">Apellido Materno:</label>
                        <input type="text" id="apellido-materno" name="apellido-materno" class="input-shadow" title="am">

                        <label for="cliente">Tipo de cliente:</label>
                        <select name="tipo" id="tipo" title="tipo" class="input-shadow">
                            <option value="Mayorista">Mayorista</option>
                            <option value="Minorista">Minorista</option>
                        </select>

                        <div class="btn-group">
                            <button type="submit" id="insertar" class="btn btn-success">Actualizar</button>

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