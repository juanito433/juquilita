<?php
include('../../connection/conexion.php');
session_start(); // Siempre al inicio

if (!isset($_SESSION['id_store'])) {
    header("Location: ../../login/login_empresa.html");
    exit();
}
// Obtén el ID del usuario logueado
$id_store = $_SESSION['id_store'];
$consulta = "SELECT * FROM orders WHERE store_id = '$id_store' ";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="tabla.css">


    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../../images/logo.jpeg" alt="">
            </div>

            <span class="logo_name">Juquilita</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../panel.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Panel Principal</span>
                    </a></li>
                <li><a href="../productos/productos.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Productos</span>
                    </a></li>
                <li><a href="../ventas/ventas.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Ventas</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Ordenes</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Perfil</span>
                    </a></li>
                <!-- <li><a href="#">
                        <i class="uil uil-share"></i>
                        <span class="link-name">Share</span>
                    </a></li> -->
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
                <input type="text" id="searchBox" class="input-shadow input" placeholder="Buscar productos...">
                <!-- Contenedor donde aparecerán los resultados -->
                <div id="resultados" class="resultados-buscador" style="position: absolute;
    top: 50px; z-index: 1;"></div>
            </div>


            <img src="../../images/logo.jpeg" alt="">
        </div>

        <div class="dash-content" ; ">


            <div class=" activity">
            <div class="title">
                <i class="uil uil-clock-three"></i>
                <span class="text">Ordenes del día</span>
            </div>

            <div class="activity-data" id="carrito-container" style="flex-direction: column">
                <section class="table__body">
                    <table id="carrito">
                        <thead>
                            <tr>
                                <th class="data-title"> Folio</th>
                                <th class="data-title"> Dirección de entrega </th>
                                <th class="data-title"> Total </th>
                                <th class="data-title"> Fecha </th>
                                <th class="data-title"> Folio Cliente</th>
                                <th class="data-title"> Pago</th>
                                <th class="data-title"> Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($order = mysqli_fetch_row($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $order[0]; ?></td>
                                    <td><?php echo $order[1]; ?></td>
                                    <td><?php echo $order[3]; ?></td>
                                    <td><?php echo $order[4]; ?></td>
                                    <td><?php echo $order[5]; ?></td>
                                    <td><?php echo $order[6]; ?></td>
                                    <td><?php echo $order[2]; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </section>
            </div>
        </div>
        </div>
    </section>

    <script src="../script.js"></script>
    <script src="ventas.js"></script>

    <script>
        const button = document.querySelector(".button");
        button.addEventListener("click", (e) => {
            e.preventDefault;
            button.classList.add("animate");
            setTimeout(() => {
                button.classList.remove("animate");
            }, 600);
        });
    </script>

</body>

</html>