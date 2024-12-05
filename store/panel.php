<?php
include('../connection/conexion.php');
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_store'])) {
    header("Location: ../login/login_empresa.html");
    exit();
}

$id_store = $_SESSION['id_store'];

// Verificar si la tienda existe
$consulta_store = "SELECT * FROM store WHERE id = '$id_store'";
$resultado_store = mysqli_query($conexion, $consulta_store) or die(mysqli_error($conexion));
$fila_store = mysqli_fetch_assoc($resultado_store);

if (!$fila_store) {
    die("Error: Tienda no encontrada.");
}

// Verificar si existe un inventario
$consulta_inventario = "SELECT * FROM inventories WHERE store_id = '$id_store'";
$resultado_inventario = mysqli_query($conexion, $consulta_inventario) or die(mysqli_error($conexion));
$inventario_existe = (mysqli_num_rows($resultado_inventario) > 0);

// Pasar el estado del inventario y del modal de productos al cliente
$show_inventory_modal = !$inventario_existe;

// Obtener los nombres de los inventarios
$inventarios = [];
while ($row = mysqli_fetch_assoc($resultado_inventario)) {
    $inventarios[] = $row['nombre']; // Asumiendo que la columna de nombre del inventario se llama 'nombre'
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../images/logo.jpeg" alt="">
            </div>
            <span class="logo_name"><?php echo $store = $fila_store['nombre']; ?></span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#"><i class="uil uil-estate"></i><span class="link-name">Panel Principal</span></a></li>
                <li><a href="productos/productos.php"><i class="uil uil-box"></i><span class="link-name">Productos</span></a></li>
                <li><a href="ventas/ventas.php"><i class="uil uil-shopping-cart"></i><span class="link-name">Ventas</span></a></li>
                <li><a href="ordenes/ordenes.php"><i class="uil uil-receipt"></i><span class="link-name">Ordenes</span></a></li>
                <li><a href="perfil/perfil.php"><i class="uil uil-user"></i><span class="link-name">Perfil</span></a></li>
                <li><a href="historial.php"><i class="uil uil-history"></i><span class="link-name">Historial</span></a></li>
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
                    <span class="text">Bienvenido</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Ventas del Día</span>
                        <span class="number">35</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-clock"></i>
                        <span class="text">Órdenes Pendientes</span>
                        <span class="number">8</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-dollar-sign"></i>
                        <span class="text">Dinero Hecho</span>
                        <span class="number">$2,450.00</span>
                    </div>
                </div>

                <div class="activity">
                    <div class="title">
                        <i class="uil uil-clock-three"></i>
                        <span class="text">Inventario</span>
                    </div>

                    <div class="activity-data">
                        <?php if ($show_inventory_modal): ?>
                            <div id="createInventoryModal" class="modal" style="display: block;">
                                <div class="modal-content">
                                    <h2>Crear Inventario</h2>
                                    <form id="createInventoryForm" action="crear_inventario.php" method="POST">
                                        <label for="nombre">Nombre del Inventario:</label>
                                        <input type="text" id="nombre" name="nombre" required>
                                        <input type="hidden" name="store_id" value="<?php echo $id_store; ?>">
                                        <button type="submit">Crear</button>
                                        <button type="button" id="closeInventoryModal">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Mostrar los nombres de los inventarios -->
                        <div>
                            <h3>Inventarios existentes:</h3>
                            <ul style="margin-left: 20px;">
                                <?php if (count($inventarios) > 0): ?>
                                    <?php foreach ($inventarios as $inventario): ?>
                                        <li><?php echo $inventario; ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>No hay inventarios registrados.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Mostrar el modal de creación de inventario si no existe
            const showInventoryModal = <?php echo json_encode($show_inventory_modal); ?>;
            if (showInventoryModal) {
                document.getElementById('createInventoryModal').style.display = 'block';
            }

            // Manejar el cierre del modal
            document.getElementById('closeInventoryModal').addEventListener('click', () => {
                document.getElementById('createInventoryModal').style.display = 'none';
            });
        });
    </script>
</body>

</html>
