<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "SELECT * FROM cliente WHERE id_cliente=$id";
$resultado = mysqli_query($conexion, $consulta);
$cliente = mysqli_fetch_assoc($resultado);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../formularios.css">
    <title>Editar Cliente</title>
</head>

<body>
    <div class="container">
        <h2>Editar Cliente</h2>
        <form action="update/update-cliente.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control input-shadow" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre_cliente']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" class="form-control input-shadow" id="apellido_paterno" name="apellido_paterno" value="<?php echo htmlspecialchars($cliente['apellido_paterno']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" class="form-control input-shadow" id="apellido_materno" name="apellido_materno" value="<?php echo htmlspecialchars($cliente['apellido_materno']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de cliente:</label>
                <input type="text" class="form-control input-shadow" id="tipo" name="tipo" value="<?php echo htmlspecialchars($cliente['tipo_cliente']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>

</html>