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
                $id="";
                $nombre = $_POST['nombre'];
                $apellidoPaterno= $_POST['apellido-paterno'];
                $apellidoMaterno= $_POST['apellido-materno'];
                $edad= $_POST['edad'];
                $direccion= $_POST['direccion'];
                $correo= $_POST['correo'];
                $rfc= $_POST['rfc'];
                $departamento= $_POST['departamento'];

                $conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb");
                $consulta = "INSERT INTO empleado values ('$id','$nombre','$apellidoPaterno', '$apellidoMaterno', '$edad', '$direccion','$correo','$rfc', '$departamento')";
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado == 1) {
                    header('Location: ../tabla-empleados.php');

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