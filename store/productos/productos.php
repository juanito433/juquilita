<?php
$conexion = mysqli_connect("localhost", "root", "", "fruteria")
    or die("Error de conexión en la base de datos");
$consulta = "SELECT * FROM products";
$resultado = mysqli_query($conexion, $consulta);
$resultado2 = mysqli_query($conexion, $consulta);
$resultado3 = mysqli_query($conexion, $consulta);
$resultado4 = mysqli_query($conexion, $consulta);
$resultado5 = mysqli_query($conexion, $consulta);
$resultado6 = mysqli_query($conexion, $consulta);
$resultado7 = mysqli_query($conexion, $consulta);


?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../style.css">

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
                <li><a href="#">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Productos</span>
                    </a></li>
                <li><a href="../ventas/ventas.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Ventas</span>
                    </a></li>
                <li><a href="../ordenes/ordenes.php">
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
                <input type="text" class="input" placeholder="Search here...">
            </div>

            <img src="../../images/logo.jpeg" alt="">
        </div>

        <div class="dash-content">

            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Productos</span>
                </div>

                <!-- <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Likes</span>
                        <span class="number">50,120</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comments</span>
                        <span class="number">20,120</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Share</span>
                        <span class="number">10,120</span>
                    </div>
                </div> -->

            </div>

            <div class="activity">
                

                <div class="activity-data">
                    <div class="data nombre">
                        <table>
                            <tr>
                                <span class="data-title">Nombre</span>
                                <?php while ($fila = mysqli_fetch_row($resultado)) { ?>
                                    <span class="data-list"><?php echo $fila[1] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="data descripcion">
                        <table>
                            <tr>
                                <span class="data-title">Descripción</span>
                                <?php while ($fila = mysqli_fetch_row($resultado2)) { ?>
                                    <span class="data-list"><?php echo $fila[2] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="data precio">
                        <table>
                            <tr>
                                <span class="data-title">Precio</span>
                            </tr>
                            <tr>

                                <?php while ($fila = mysqli_fetch_row($resultado3)) { ?>
                                    <span class="data-list"><?php echo '$' . $fila[3] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="data stock">
                        <table>
                            <tr>
                                <span class="data-title">Stock</span>
                                <?php while ($fila = mysqli_fetch_row($resultado4)) { ?>
                                    <span class="data-list"><?php echo  $fila[4] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="data caducidad">
                        <table>
                            <tr>
                                <span class="data-title">Caducidad</span>
                                <?php while ($fila = mysqli_fetch_row($resultado5)) { ?>
                                    <span class="data-list"><?php echo  $fila[6] ?></span>

                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="data imagen">
                        <table>
                            <tr>
                                <span class="data-title">Imagen</span>
                                <?php while ($fila = mysqli_fetch_row($resultado6)) { ?>
                                    <span class="data-list"><img width="100" height="80" src="data:image/jpeg;base64,<?php echo base64_encode($fila[5]) ?> " /></span>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="data acciones">
                        <table>
                            <tr>
                                <span class="data-title">Acciones</span>
                                <?php while ($fila = mysqli_fetch_row($resultado7)) { ?>
                                    <span class="data-list">
                                        <?php
                                        echo "<button class='button' onclick='editarEmpleado(" . $fila[0] . ")'>Editar</button> ";
                                        echo "<button class='button'  onclick='eliminarEmpleado(" . $fila[0] . ")'>Eliminar</button>";
                                        ?>
                                    </span>

                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../script.js"></script>
    <script>
        const button = document.querySelector(".button");
        button.addEventListener("click", (e) => {
            e.preventDefault;
            button.classList.add("animate");
            setTimeout(() => {
                button.classList.remove("animate");
            }, 600);
        });

        /* Botones de acciones */
        function editarEmpleado(id) {
            // Aquí puedes redirigir a una página de edición o abrir un modal con el formulario de edición
            window.location.href = `edit/editar-productos.php?id=${id}`;
        }

        function eliminarEmpleado(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este empleado?')) {
                window.location.href = `delete/delete-productos.php?id=${id}`;
            }
        }
    </script>
</body>

</html>