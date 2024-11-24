<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="tabla.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .d-none {
            display: none;
        }
    </style>
    <title>Menú de la barra lateral del tablero</title>
</head>

<body>
    <nav class="sidebar ">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../images/logofinal.png" alt="logo">
                </span>
                <div class="text logo-text">
                    <span class="name">Usuario</span>
                    <span class="profession">Administración</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Buscar...">
                </li>
                <ul class="menu-links" id="lista">
                    <li class="nav-link">
                        <a href="../empleados/tabla-empleados.php" id="empleados1">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Empleados</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../inventario/tabla-inventario.php" id="inventario1">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Inventario</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../productos/tabla-productos.php" id="productos1">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Productos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../ventas/tabla-ventas.php" id="ventas1">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Ventas</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../clientes/tabla-clientes.php" id="clientes1">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../proveedores/tabla-proveedores.php" id="proveedores1">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Proveedores</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li>
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Cerrar Sesión</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Modo oscuro</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <section class="home">
        <article class="table-widget">
            <div class="caption">
                <h2>Tabla de proveedores</h2>
                <button class="export-btn" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" />
                    </svg>
                    EXPORTAR
                </button>
                <a href="" class="btn btn-primary">Agregar</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>
                            Id de empresa
                        </th>
                        <th>
                            Empresa
                        </th>
                        <th>
                            DirecciÓn
                        </th>
                        <th>
                            Teléfono
                        </th>
                        <th>
                            RFC
                        </th>
                        <th>
                            Correo
                        </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="team-member-rows">
                    <?php
                    $conexion = mysqli_connect("localhost", "root", "", "frutitasjuquilitadb")
                        or die("Error de conexión en la base de datos");
                    $consulta = "SELECT * FROM proveedores";
                    $resultado = mysqli_query($conexion, $consulta);
                    while ($row = mysqli_fetch_row($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $row[0] . "</td>";
                        echo "<td>" . $row[1] . "</td>";
                        echo "<td>" . $row[2] . "</td>";
                        echo "<td>" . $row[3] . "</td>";
                        echo "<td>" . $row[4] . "</td>";
                        echo "<td>" . $row[5] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-warning' onclick='editarEmpleado(" . $row[0] . ")'>Editar</button> ";
                        echo "<button class='btn btn-danger' onclick='eliminarEmpleado(" . $row[0] . ")'>Eliminar</button>";
                        echo "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <ul class="pagination"></ul>
        </article>
    </section>
    <script src="script.js"></script>
    <script src="tabla.js"></script>
</body>

</html>