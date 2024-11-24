<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "SELECT * FROM ventas WHERE folio_venta=$id";
$resultado = mysqli_query($conexion, $consulta);
$ventas = mysqli_fetch_assoc($resultado);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="formularios.css">
    <title>Editar Empleado</title>
</head>
<body>
    <div class="container">
        <h2>Editar Empleado</h2>
        <form action="../update/update-ventas.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($ventas['folio_venta']); ?>">
            <div class="form-group">
                <label for="codigo">Codigo del producto:</label>
                <input type="text" class="form-control input-shadow" id="codigo" name="codigo" value="<?php echo htmlspecialchars($ventas['codigo_id']); ?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control input-shadow" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($ventas['cantidad']); ?>" required>
            </div>
            <div class="form-group">
                <label for="total">Total $:</label>
                <input type="number" class="form-control input-shadow" id="total" name="total" value="<?php echo htmlspecialchars($ventas['total']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control input-shadow" id="fecha" name="fecha" value="<?php echo htmlspecialchars($ventas['fecha_salida']); ?>" required>
            </div>
            <div class="form-group">
                <label for="cliente">Id del cliente:</label>
                <input type="text" class="form-control input-shadow" id="cliente" name="cliente" value="<?php echo htmlspecialchars($ventas['id_cliente']); ?>" required>
            </div>
            <div class="form-group">
                <label for="empleado">Id del empleado:</label>
                <input type="text" class="form-control input-shadow" id="empleado" name="empleado" value="<?php echo htmlspecialchars($ventas['id_empeado']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
