<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "SELECT * FROM inventario WHERE id_inventario=$id";
$resultado = mysqli_query($conexion, $consulta);
$inventario = mysqli_fetch_assoc($resultado);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="formulario.css">
    <title>Editar Empleado</title>
</head>
<body>
    <div class="container">
        <h2>Editar Empleado</h2>
        <form action="../update/update-inventario.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($inventario['id_inventario']); ?>">
            <div class="form-group">
                <label for="Codigo">Codigo:</label>
                <input type="text" class="form-control input-shadow" id="codigo" name="codigo" value="<?php echo htmlspecialchars($inventario['codigo_id']); ?>" required>
            </div>
            <div class="form-group">
                <label for="Existencia">Existencia:</label>
                <input type="text" class="form-control input-shadow" id="existencia" name="existencia" value="<?php echo htmlspecialchars($inventario['existencia']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de entrada:</label>
                <input type="date" class="form-control input-shadow" id="fecha" name="fecha" value="<?php echo htmlspecialchars($inventario['fecha_entrada']); ?>" required>
            </div>
            <div class="form-group">
                <label for="empresa">Empresa:</label>
                <input type="text" class="form-control input-shadow" id="empresa" name="empresa" value="<?php echo htmlspecialchars($inventario['id_empresa']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
