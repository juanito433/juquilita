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
                    ALTA INVENTARIO </h2>
                <?php
                $id="";
                $codigo = $_POST['producto'];
                $existancia = $_POST['existenCia'];
                $fecha = $_POST['Fecha'];
                $empresa = $_POST['empresa'];
                


                $conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb");
                $consulta = "INSERT INTO inventario values ('$id','$codigo','$existancia','$fecha', '$empresa')";
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado == 1) {
                    echo "<h3>datos insertados</h3>";
                    header('Location: consultas/consultaVentas.php');
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