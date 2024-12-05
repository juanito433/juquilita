<?php
include('../../../connection/conexion.php');
$id = intval($_GET['id']);
$consulta = "SELECT * FROM products WHERE id=$id";
$resultado = mysqli_query($conexion, $consulta);
$productos = mysqli_fetch_assoc($resultado);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Editar Productos</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-2 col-md-1"></div>
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form action="../update/update-productos.php" method="post">
                    <div class="formulario">
                        <h2>Editar Productos</h2>

                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($productos['id']); ?>">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control input-shadow" id="nombre" name="nombre" value="<?php echo htmlspecialchars($productos['nombre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" class="form-control input-shadow" id="precio" name="precio" value="<?php echo htmlspecialchars($productos['precio']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="empresa">Descripción:</label>
                            <input type="text" class="form-control input-shadow" id="description" name="description" value="<?php echo htmlspecialchars($productos['description']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Stock:</label>
                            <input type="text" class="form-control input-shadow" id="stock" name="stock" value="<?php echo htmlspecialchars($productos['stock']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Fecha de caducidad:</label>
                            <input type="text" class="form-control input-shadow" id="fecha_caducidad" name="fecha_caducidad" value="<?php echo htmlspecialchars($productos['fecha_caducidad']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="marca">Categoria:</label>
                            <input type="text" class="form-control input-shadow" id="categoria" name="categoria" value="<?php echo htmlspecialchars($productos['categoria']); ?>" required>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-md-1"></div>
        </div>
    </div>
</body>

</html>