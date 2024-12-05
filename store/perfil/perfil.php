<?php
include('../../connection/conexion.php');
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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../../images/logo.jpeg" alt="">
            </div>

            <span class="logo_name"><?php echo $store = $fila_store[1]; ?></span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../panel.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Panel Principal</span>
                    </a></li>
                <li><a href="../productos/productos.php">
                        <i class="uil uil-box"></i> <!-- Cambiado a "caja", representando productos o inventario -->
                        <span class="link-name">Productos</span>
                    </a></li>
                <li><a href="../ventas/ventas.php">
                        <i class="uil uil-shopping-cart"></i> <!-- Cambiado a "carrito de compras" para ventas -->
                        <span class="link-name">Ventas</span>
                    </a></li>
                <li><a href="../ordenes/ordenes.php">
                        <i class="uil uil-receipt"></i> <!-- Cambiado a "recibo" para representar órdenes -->
                        <span class="link-name">Ordenes</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-user"></i> <!-- Cambiado a "usuario" para representar perfil -->
                        <span class="link-name">Perfil</span>
                    </a></li>
                <li><a href="../historial.php">
                        <i class="uil uil-history"></i> <!-- Cambiado a "historial", que tiene sentido semántico -->
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

            <img src="../../images/logo.jpeg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">

                <div class="activity">
                    <div class="container light-style flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-4">
                            Actualiza tu perfil
                        </h4>
                        <form action="update.php" method="post" enctype="multipart/form-data">

                            <div class="card overflow-hidden">
                                <div class="row no-gutters row-bordered row-border-light">

                                    <div class="col-md-9">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="account-general">
                                                <div class="card-body media align-items-center">
                                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($store = $fila_store[3]); ?>"
                                                        class="d-block ui-w-80">
                                                    <div class="media-body ml-4">
                                                        <label class="btn btn-outline-primary">
                                                            Actualiza tu foto
                                                            <input type="file" name="foto" class="account-settings-fileinput">
                                                        </label> &nbsp;
                                                    </div>
                                                </div>
                                                <hr class="border-light m-0">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" class="form-control mb-1" name="nombre" value="<?php echo $store = $fila_store[1]; ?>" title="1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Ubicación</label>
                                                        <input name="ubicacion" type="text" class="form-control" value="<?php echo $store = $fila_store[2]; ?>" title="1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Correo</label>
                                                        <input name="correo" type="text" class="form-control mb-1" value="<?php echo $store = $fila_store[5]; ?>" title="1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input name="password" type="password" class="form-control" value="<?php echo $store = $fila_store[6]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Telefono</label>
                                                        <input name="telefono" type="text" class="form-control" value="<?php echo $store = $fila_store[7]; ?>">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>&nbsp;
                            </div>
                        </form>
                    </div>
                    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
                </div>
            </div>

        </div>
    </section>

    <script src="../script.js"></script>
</body>

</html>