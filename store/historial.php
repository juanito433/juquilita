<?php
include('../connection/conexion.php');
session_start(); // Siempre al inicio

if (!isset($_SESSION['id_store'])) {
    header("Location: ../../login/login_empresa.html");
    exit();
}
// Obtén el ID del usuario logueado
$id_store = $_SESSION['id_store'];
$consulta = "SELECT * FROM store WHERE id = '$id_store' ";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
$fila_store = mysqli_fetch_row($resultado);

$consulta = "SELECT * FROM sales WHERE store_id = '$id_store' ";
$resultado1 = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
$resultado2 = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
$resultado3 = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
$resultado4 = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));


?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../images/logo.jpeg" alt="">
            </div>

            <span class="logo_name"><?php echo $store = $fila_store[1];?></span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="panel.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Panel Principal</span>
                    </a></li>
                <li><a href="productos/productos.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Productos</span>
                    </a></li>
                <li><a href="ventas/ventas.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Ventas</span>
                    </a></li>
                <li><a href="ordenes/ordenes.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Ordenes</span>
                    </a></li>
                <li><a href="perfil/perfil.php">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Perfil</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-share"></i>
                        <span class="link-name">Historial</span>
                    </a></li>
            </ul>


            <ul class="logout-mode">
                <li><a href="#">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Cerrar Sesión</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Modo oscuro</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" class="input" placeholder="Search here...">
            </div>

            <img src="../images/logo.jpeg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Historial de ventas</span>
                </div>

                <div class="activity">

                    <div class="activity-data">
                        <div class="data names">
                        <table>
                            <tr>
                                <span class="data-title">Folio</span>
                                <?php while ($fila = mysqli_fetch_row($resultado1)) { ?>
                                    <span class="data-list"><?php echo $fila[0] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                        </div>
                        <div class="data email">
                        <table>
                            <tr>
                                <span class="data-title">Fecha</span>
                                <?php while ($fila = mysqli_fetch_row($resultado2)) { ?>
                                    <span class="data-list"><?php echo $fila[1] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                        </div>
                        <div class="data type">
                        <table>
                            <tr>
                                <span class="data-title">Total</span>
                                <?php while ($fila = mysqli_fetch_row($resultado3)) { ?>
                                    <span class="data-list"><?php echo $fila[2] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
    </section>

    <script src="script.js"></script>
</body>

</html>