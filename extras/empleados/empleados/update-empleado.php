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
$consulta = "SELECT * FROM empleado;";

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
                            <h1>ALTA CLIENTES</h1>
                        </center>
                        <label for="nombre">Persona a actualizar:</label>
                        <select name="empleado" id="empleado" title="empleado" class="input-shadow" required>
                            <option selected>Identifica</option>
                            <?php
                            if ($resultado->num_rows > 0) {
                                while ($filas = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $filas['id_empleado'] . "'>" . $filas['nombre'] . " (ID: " . $filas['id_empleado'] . ")</option>";
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

                        <label for="email">Edad:</label>
                        <input type="number" max="65" min="18" id="edad" name="edad" class="input-shadow" title="edad">

                        <label for="telefono">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="input-shadow" title="direc">

                        <label for="telefono">Correo:</label>
                        <input type="email" id="correo" name="correo" class="input-shadow" title="email">

                        <label for="telefono">RFC:</label>
                        <input type="text" id="rfc" name="rfc" class="input-shadow" title="rfc">

                        <label for="telefono">Departamento:</label>
                        <select name="departamento" id="departamento" title="depa" class="input-shadow">
                            <option value="Anaquelero">Anaquelero</option>
                            <option value="Bodeguero">Bodeguero</option>
                            <option value="Cajero">Cajero</option>
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