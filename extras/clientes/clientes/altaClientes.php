<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <title>Alta de productos de mascotas</title>
</head>
<body>
    <div class="container text-center">
        <div class="row" >
            <div class="col">

            </div>
            <div class="col-6">
                <h2>
                    Alata de Prdoductos de Mascotas
                </h2>
                <?php
                $idCliente="";
                $nombre=$_POST['nombre'];
                $apellidoPaterno=$_POST['apellido-paterno'];
                $apellidoMaterno=$_POST['apellido-materno'];
                $tipoCliente=$_POST['TipoCliente'];
                $conexion = mysqli_connect("localhost","root","","frutitasjuquilitadb");
                $consulta = "Insert into cliente values('$idCliente','$nombre', '$apellidoPaterno', '$apellidoMaterno', '$tipoCliente')";
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado==1)
                {
                    header("Location: ../tabla-clientes.php");
                }
                else{
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