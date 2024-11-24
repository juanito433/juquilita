<?php
$conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb") or die("Error de conexión en la base de datos");
$id = intval($_GET['id']);
$consulta = "SELECT * FROM Empleado WHERE id_empleado=$id";
$resultado = mysqli_query($conexion, $consulta);
$empleado = mysqli_fetch_assoc($resultado);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet"> -->
    <link rel="stylesheet" href="formulario.css">
    <title>Editar Empleado</title>
</head>

<body>
    <div class="container">
        <form action="update/update-empleado.php" method="post">
            <div class="formulario">
                <h2>Editar Empleado</h2>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($empleado['id_empleado']); ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control input-shadow" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apellido Paterno:</label>
                    <input type="text" class="form-control input-shadow" id="apellido_paterno" name="apellido_paterno" value="<?php echo htmlspecialchars($empleado['apellido_paterno']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno:</label>
                    <input type="text" class="form-control input-shadow" id="apellido_materno" name="apellido_materno" value="<?php echo htmlspecialchars($empleado['apellido_materno']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" class="form-control input-shadow" id="edad" name="edad" value="<?php echo htmlspecialchars($empleado['edad']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control input-shadow" id="direccion" name="direccion" value="<?php echo htmlspecialchars($empleado['direccion']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" class="form-control input-shadow" id="correo" name="correo" value="<?php echo htmlspecialchars($empleado['correo']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="rfc">RFC:</label>
                    <input type="text" class="form-control input-shadow" id="rfc" name="rfc" value="<?php echo htmlspecialchars($empleado['rfc']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="departamento">Departamento:</label>
                    <input type="text" class="form-control input-shadow" id="departamento" name="departamento" value="<?php echo htmlspecialchars($empleado['departamento']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</body>

</html>