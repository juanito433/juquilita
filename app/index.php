<?php
session_start();

if (!isset($_SESSION['id_users'])) {
    header("Location: ../login/login.html");
    exit();
}
// Obtén el ID del usuario logueado
$id = $_SESSION['id_users'];
$id_store = $_GET['id']; // ID de la tienda

include('../connection/conexion.php');

// Obtener el inventario de la tienda específica
$consulta_inventario = "SELECT * FROM inventories WHERE store_id = '$id_store' ";
$resultado_inventario = mysqli_query($conexion, $consulta_inventario) or die(mysqli_error($conexion));
$fila_inventario = mysqli_fetch_row($resultado_inventario);
$id_inventario = $fila_inventario[0]; // Suponiendo que el id del inventario está en la primera columna


// Obtener los productos del inventario de esa tienda
$consulta_productos = "SELECT * FROM products WHERE inventories_id = '$id_inventario'";
$resultado_productos = mysqli_query($conexion, $consulta_productos) or die(mysqli_error($conexion));

// Obtener los datos del usuario
$consulta_user = "SELECT * FROM users WHERE id = '$id'";
$resultado_user = mysqli_query($conexion, $consulta_user) or die(mysqli_error($conexion));
$fila_user = mysqli_fetch_assoc($resultado_user);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="/style.css"> -->
    <title>App fruteria</title>
    <!-- favicon -->
    <link rel="icon" href="../images/logo.jpeg" type="image/gif" sizes="16x16">
    <!-- header links -->
    <script src="https://kit.fontawesome.com/4a3b1f73a2.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <!-- slider links -->
    <!-- <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
    <script src="js/jQuery3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="css/content.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://kit.fontawesome.com/4a3b1f73a2.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: rgb(249, 246, 243);
        }

        .resultados-buscador {
            position: absolute;
            top: 100%;
            /* Justo debajo del campo de búsqueda */
            left: 0;
            width: 100%;
            border: 1px solid #ccc;
            background-color: #fff;
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
        }

        .resultado-item {
            padding: 10px;
            cursor: pointer;
        }

        .resultado-item:hover {
            background-color: #f0f0f0;
        }
    </style>

</head>

<body>
    <!-- HEADER -->
    <header>
        <section>
            <!-- MAIN CONTAINER -->
            <div id="container">
                <!-- SHOP NAME -->
                <div id="shopName"><a href="index.html"> <b>Frut</b>eria</a> <?php echo $id_inventario ?></div>


                <!-- SEARCH SECTION -->
                <input type="text" id="searchBox" class="input-shadow" placeholder="Buscar productos...">

                <!-- Contenedor donde aparecerán los resultados -->
                <div id="resultados" class="resultados-buscador"></div>

                <!-- USER SECTION (CART AND USER ICON) -->
                <div id="user">
                    <button onclick="openModal()" style="background-color: #ffffff00;">
                        <div id="badge">0</div>
                        <img src="img/carrito.png" width="40px" alt="">
                    </button>
                    <?php if (isset($_SESSION['id_users'])): ?>
                        <button id="profileBtn" style="background-color: #ffffff00;"> <img src="img/usuario.png" alt="Usario" width="40px"> </button>
                        <div id="profileDropdown" class="dropdown hidden">
                            <p><strong>Nombre:</strong> <span id="userName"><?php echo $fila_user['nombre']; ?></span></p>
                            <p><strong>Direccion:</strong> <span id="userEmail"><?php echo $fila_user['direccion']; ?></span></p>
                            <p><strong>Teléfono:</strong> <span id="userPhone"><?php echo $fila_user['telefono']; ?></span></p>
                            <form action="../login/cerrar_sesion.php">
                                <button id="logoutBtn" style="background-color: red; color: white; border: none; padding: 10px; cursor: pointer;">Cerrar Sesión</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <a href="../login/login.html">Inicia sesiòn </a>
                    <?php endif; ?>
                </div>
            </div>

        </section>
    </header>

    <!-- SLIDER -->
    <div id="2"></div>
    <script>
        load("slider.html");

        function load(url) {
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            document.getElementById(2).innerHTML = req.responseText;
        }
    </script>

    <!-- Cards de productos traidos de la base de datos -->
    <div id="mainContainer">
        <h1>Productos disponibles en la tienda</h1>
        <div id="containerClothing">
            <?php if (mysqli_num_rows($resultado_productos) > 0): ?>
                <?php while ($producto = mysqli_fetch_assoc($resultado_productos)) { ?>
                    <div id="box">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['foto']); ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div id="details">
                            <h3><?php echo $producto['nombre']; ?></h3>
                            <h4><?php echo $producto['description']; ?></h4>
                            <h2>$ <?php echo $producto['precio']; ?></h2>
                        </div>
                        <div class="extra-options" style="padding: 10px;">
                            <center>
                                <label for="quantity">Cantidad (gramos):</label>
                                <input type="number" id="quantity-<?php echo $producto['nombre']; ?>" class="quantity-input" placeholder="En gramos" min="1">
                                <button onclick="addToCart(<?php echo $producto['id']; ?>, '<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>, 'quantity-<?php echo $producto['nombre']; ?>')">Añadir al Carrito</button>
                            </center>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <h3>No hay productos disponibles en esta tienda.</h3>
            <?php endif; ?>
        </div>
    </div>

    <!-- Estilo de modal/carrito -->
    <style>
        #cartModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
        }

        #cartModal.hidden {
            display: none;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.active {
            display: block;
        }
    </style>

    <!--Modal del carrito  -->
    <div id="modal" style="display: none; 
    position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);  
    padding: 20px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5); z-index: 1000; 
    overflow-y: auto;">
        <div id="cartModal" style="display: block;     border-radius: 8px; width: 600px;">
            <button id="closeCart" onclick="closeModal()" style="float: right;">Cerrar</button>
            <h2>Carrito de Compra</h2>
            <form id="checkoutForm" method="POST" action="process_payment.php?id=<?php echo $id_store ?>" ">
            
                <input type=" hidden" name="cart_data" id="cartData" style="display: none;">
                <ul id="cartItems"></ul>
                <p>Total: $<span id="totalPrice">0.00</span></p>

            </form>
            <button onclick="checkout()">Pagar</button>

        </div>

    </div>

    <!-- FOOTER -->
    <div id="4"></div>
    <script>
        load("footer.html");

        function load(url) {
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            document.getElementById(4).innerHTML = req.responseText;
        }
    </script>

    <!-- buscador -->
    <script>
        // Obtener referencias
        const searchBox = document.getElementById('searchBox');
        const resultados = document.getElementById('resultados');

        // Escuchar el evento input
        searchBox.addEventListener('input', function() {
            const searchText = searchBox.value.trim().toLowerCase();
            resultados.innerHTML = ''; // Limpiar resultados anteriores

            if (searchText.length > 0) {
                // Realizar la consulta al servidor
                fetch(`buscar_productos.php?query=${searchText}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Verificar la respuesta del servidor

                        if (data.length > 0) {
                            data.forEach(producto => {
                                // 'producto' es el parámetro de la función que recibe el valor de cada elemento en 'data'
                                const div = document.createElement('div');
                                div.classList.add('resultado-item');

                                // Aquí 'producto' tiene las propiedades del producto actual en cada iteración

                                div.innerHTML = `<span><strong>${producto.nombre}</strong> - $${producto.precio} por kilo
                                <input type="number" id="quantity-${producto.nombre}" class="quantity-input" placeholder="En gramos" min="1">
                            <button onclick="addToCart('${producto.nombre}', ${producto.precio}, 'quantity-${producto.nombre}')">Añadir al Carrito</button>
                                </span>`;

                                // Añadimos el elemento creado al DOM
                                resultados.appendChild(div);
                            });
                        } else {
                            resultados.innerHTML = '<p>No se encontraron productos</p>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });


        // Función para agregar productos al carrito
        function agregarProductoAlCarrito(id, nombre, precioPorKilo) {
            const cantidadInput = document.getElementById(`cantidad_${id}`);
            const cantidadGramos = parseFloat(cantidadInput.value) || 1;
            const precio = (precioPorKilo / 1000) * cantidadGramos;

            addToCart(nombre, precioPorKilo, cantidadGramos); // Llamar la función de carrito existente
            resultados.innerHTML = ''; // Limpiar los resultados después de agregar
            searchBox.value = ''; // Limpiar el buscador
        }
    </script>

</body>
<!-- carrito -->
<script>
    /* modal */
    function openModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'block'; // Muestra el modal
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }

    // Para cerrar al hacer clic fuera del modal
    window.onclick = function(event) {
        const modal = document.getElementById('modal');
        if (event.target === modal) {
            closeModal();
        }
    };


    // Variables para el carrito
    let cart = [];
    let totalPrice = 0;

    // Función para agregar producto al carrito
    // Función para agregar producto al carrito
    function addToCart(productId, productName, pricePerKilo, quantityInputId) {
        const quantityInGrams = parseFloat(document.getElementById(quantityInputId).value);

        if (isNaN(quantityInGrams) || quantityInGrams <= 0) {
            alert("Por favor, introduce una cantidad válida mayor a 0.");
            return;
        }

        const pricePerUnit = pricePerKilo / 1000; // Calcula el precio por gramo
        const subtotal = pricePerUnit * quantityInGrams;

        // Comprueba si el producto ya existe en el carrito
        const existingProduct = cart.find(item => item.products_id === productId);
        if (existingProduct) {
            existingProduct.cantidad += quantityInGrams;
            existingProduct.subtotal += subtotal;
        } else {
            cart.push({
                products_id: productId, // Guardar el ID del producto
                nombre: productName, // Guardar el nombre del producto
                cantidad: quantityInGrams,
                precio_unitario: pricePerUnit,
                subtotal: subtotal
            });
        }

        updateCartWindow();
        updateBadgeCount();
        saveCart();
    }





    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }


    function loadCart() {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart);
            updateCartWindow();
            updateBadgeCount();
        }
    }
    window.onload = loadCart;


    // Función para actualizar la ventana del carrito
    function updateCartWindow() {
        const cartItems = document.getElementById('cartItems');
        cartItems.innerHTML = ''; // Limpia los productos anteriores

        // Actualizar los productos en el carrito
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.innerHTML = `
            <strong>Producto: ${item.nombre}</strong> - 
            ${item.cantidad}g = $${item.subtotal.toFixed(2)}
            <button onclick="removeItem(${index})">Eliminar</button>
        `;
            cartItems.appendChild(li);
        });

        // Actualizar el precio total
        const totalPriceElement = document.getElementById('totalPrice');
        totalPriceElement.innerText = cart.reduce((total, item) => total + item.subtotal, 0).toFixed(2);
    }


    // Función para actualizar la cantidad de un producto dentro del carrito
    function updateQuantity(index, newQuantityInGrams) {
        const product = cart[index];
        const newQuantity = parseFloat(newQuantityInGrams);

        // Validar entrada
        if (isNaN(newQuantity) || newQuantity <= 0) {
            alert("Por favor, introduce una cantidad válida mayor a 0.");
            return;
        }

        // Actualizar la cantidad y el precio del producto
        product.quantityInGrams = newQuantity;
        product.price = (product.pricePerKilo / 1000) * product.quantityInGrams;

        // Actualizar la ventana del carrito
        updateCartWindow();
        updateBadgeCount();
    }

    // Función para eliminar un producto del carrito
    function removeItem(index) {
        cart.splice(index, 1); // Eliminar el producto del carrito
        updateCartWindow(); // Actualizar la vista del carrito
        updateBadgeCount(); // Actualizar el contador del carrito
        saveCart(); // Guardar el carrito actualizado
    }


    // Función para actualizar el contador de productos en el ícono del carrito
    function updateBadgeCount() {
        const badge = document.getElementById('badge');
        badge.innerText = cart.length;
    }


    function loadCart() {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart); // Carga el carrito guardado
            updateCartWindow(); // Actualiza la interfaz
            updateBadgeCount(); // Actualiza el badge
        }
    }
    window.onload = loadCart;


    // Función para actualizar la cantidad de productos en el badge

    function updateBadgeCount() {
        const badge = document.getElementById('badge');
        badge.textContent = cart.length; // Muestra el número de productos distintos
    }


    // Función para proceder al pago
    function checkout() {
        if (cart.length === 0) {
            alert('Tu carrito está vacío. Añade productos antes de proceder.');
            return;
        }

        // Guardar el carrito en un campo oculto para enviarlo al servidor
        const cartDataField = document.getElementById('cartData');
        cartDataField.value = JSON.stringify(cart);

        // Enviar el formulario de pago
        document.getElementById('checkoutForm').submit();
    }
</script>

<!-- slider JS START -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('#containerSlider').slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
        });
    });
</script>

<!-- Inicio de sesion usuarios -->
<script>
    // Obtener elementos
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    // Mostrar/Ocultar el dropdown al hacer clic en el botón
    profileBtn.addEventListener('click', () => {
        profileDropdown.classList.toggle('visible');
    });

    // Cerrar el dropdown al hacer clic fuera de él
    document.addEventListener('click', (event) => {
        if (!profileDropdown.contains(event.target) && event.target !== profileBtn) {
            profileDropdown.classList.remove('hidden');
        }
    });

    // Lógica para cerrar sesión (redirige a logout.php)
    const logoutBtn = document.getElementById('logoutBtn');
    logoutBtn.addEventListener('click', () => {
        window.location.href = 'logout.php';
    });
</script>

</html>