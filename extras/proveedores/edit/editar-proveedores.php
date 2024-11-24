<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "SELECT * FROM proveedores WHERE id_empresa=$id";
$resultado = mysqli_query($conexion, $consulta);
$proveedor = mysqli_fetch_assoc($resultado);
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
    <title>Editar Proveedores</title>
</head>
<body>
    <div class="container">
        <h2>Editar Proveedores</h2>
        <form action="../update/update-proveedores.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($proveedor['id_empresa']); ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control input-shadow" id="nombre" name="nombre" value="<?php echo htmlspecialchars($proveedor['empresa']); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control input-shadow" id="direccion" name="direccion" value="<?php echo htmlspecialchars($proveedor['direccion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="tel" class="form-control input-shadow" id="telefono" name="telefono" value="<?php echo htmlspecialchars($proveedor['telefono']); ?>" required>
            </div>
            <div class="form-group">
                <label for="rfc">RFC:</label>
                <input type="text" class="form-control input-shadow" id="rfc" name="rfc" value="<?php echo htmlspecialchars($proveedor['rfc']); ?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control input-shadow" id="correo" name="correo" value="<?php echo htmlspecialchars($proveedor['correo']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
