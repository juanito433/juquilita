<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css"
        type="text/css" rel="stylesheet">
    <link href="css/bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css" real="stylesheet" 
        crossorigin="anonymous">
    <title>Eliminacion de Angeles</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <h2>Eliminacion de Angeles</h2>
                <?php
                $Id=$_POST['empleado'];

                $conexion=mysqli_connect("localhost","root","","frutitasjuquilitadb");
                #or die ("Error en la B.D");
                $consulta="DELETE empleado FROM empleado WHERE id_empleado='$Id'";
                $resultado=mysqli_query($conexion, $consulta);
                if ($resultado==1)
                {
                    echo "<h3>Datos Borrados</h3>";
                }
                else{
                    echo "<h3>Datos NO Borrados</h3>";}   
                ?>
            <a href="ConsultaAngeles.php" class="btn btn-outline-primary">Consulta ala BD de Angeles</a> 
            </div>
            <div class="col"></div>
        </div>
    </div>
    
</body>
</html>