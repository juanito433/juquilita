<?php
include('connection/conexion.php');
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_store'])) {
    header("Location: ../login/login_empresa.html");
    exit();
}

$id_store = $_SESSION['id_store'];

// Verificar si existe un inventario para la tienda
$consulta_inventario = "SELECT * FROM inventories WHERE store_id = '$id_store'";
$resultado_inventario = mysqli_query($conexion, $consulta_inventario) or die(mysqli_error($conexion));
$inventario_existe = (mysqli_num_rows($resultado_inventario) > 0);

// Pasar el estado del modal de inventario al cliente
$show_inventory_modal = !$inventario_existe;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tienda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Modal para crear inventario -->
    <div id="createInventoryModal" class="modal" style="display: none;">
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
