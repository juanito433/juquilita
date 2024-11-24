<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <title>ALTA DE MARCAS</title>
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col">

            </div>
            <div class="col-6">
                <h2>
                    ALTA DE EMPLEADOS </h2>
                <?php
                $id=$_POST['cliente'];
                $nombre = $_POST['nombre'];
                $apellidoPaterno= $_POST['apellido-paterno'];
                $apellidoMaterno= $_POST['apellido-materno'];
                $tipo= $_POST['tipo'];


                $conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb");
                $consulta = "UPDATE cliente SET nombre_cliente='$nombre',apellido_paterno='$apellidoPaterno', apellido_materno='$apellidoMaterno',tipo_cliente='$tipo' WHERE id_cliente='$id'";
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado == 1) {
                    echo "<h3>datos insertados</h3>";
                    header('Location: consultas/consultasClientes.php');

                } else {
                    echo "<h3>datos no insertados</h3>";
                }

                ?>

            </div>
            <div class="col">

            </div>

        </div>
    </div>
</body>

</html>