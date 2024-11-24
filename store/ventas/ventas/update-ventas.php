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
$consulta = "SELECT * FROM ventas;";

$resultado = $conn->query($consulta);
$conn->close();
?>
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
$query1 = "SELECT id_cliente, nombre_cliente FROM cliente;";
$query2 = "SELECT id_empleado, nombre FROM empleado";
$query3 = "SELECT codigo_id, nombre_producto FROM productos";
$result2 = $conn->query($query2);
$result1 = $conn->query($query1);
$result3 = $conn->query($query3);
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
                <form action="delete-empleado-base.php" method="post">
                    <div class="formulario">
                        <center>
                            <h1>ACTUALIZAR VENTAS</h1>
                        </center>
                        <label for="nombre">Escoge una marca:</label>
                        <select name="empleado" id="empleado" title="empleado" class="input-shadow" required>
                            <option selected>identifica</option>
                            <?php
                            if ($resultado->num_rows > 0) {
                                while ($filas = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $filas['folio_venta'] . "'>" . " Folio de venta: " . $filas['folio_venta'] . ")</option>";
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

                        <label for="cantidad">Cantidad:</label>
                        <input id="cantidad" name="cantidad" type="text" class="input-shadow" placeholder="Ingresa la cantidad">

                        <label for="total">Total a pagar:</label>
                        <input id="total" name="total" type="text" class="input-shadow" placeholder="Total">

                        <label for="fecha">Fecha:</label>
                        <input id="Fecha" name="Fecha" type="date" class="input-shadow" placeholder="aaaa/mm/dd">

                        <label for="cliente">Cliente:</label>
                        <select name="IDCliente" id="IDCliente" title="IDCliente" class="input-shadow" required>
                            <option selected>Escoge un cliente</option>
                            <?php
                            if ($result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    echo "<option value='" . $row['id_cliente'] . "'>" . $row['nombre_cliente'] . " (ID: " . $row['id_cliente'] . ")</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="empleado">Empleado:</label>
                        <select name="IDEmpleado" id="IDEmpleado" title="IDEmpleado" class="input-shadow" required>
                            <option selected>Escoge un empleado</option>
                            <?php
                            if ($result2->num_rows > 0) {
                                while ($row = $result2->fetch_assoc()) {
                                    echo "<option value='" . $row['id_empleado'] . "'>" . $row['nombre'] . " (ID: " . $row['id_empleado'] . ")</option>";
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