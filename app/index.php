<?php
session_start();

if (!isset($_SESSION['id_users'])) {
    header("Location: ../login/login.html");
    exit();
}
// Ahora puedes acceder al ID del usuario logueado
$id = $_SESSION['id_users'];

include('../connection/conexion.php');
$consulta = "SELECT * FROM products";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

$consulta_users = "SELECT * FROM users WHERE id = '$id'";
$resultado_users = mysqli_query($conexion, $consulta_users) or die(mysqli_error($conexion));
$fila_user = mysqli_fetch_assoc($resultado_users);

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
                <div id="shopName"><a href="index.html"> <b>Frut</b>eria</a></div>


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
                            <p><strong>Nombre:</strong> <span id="userName"><?php echo $fila_user['nombre'];?></span></p>
                            <p><strong>Direccion:</strong> <span id="userEmail"><?php echo $fila_user['direccion'];?></span></p>
                            <p><strong>Teléfono:</strong> <span id="userPhone"><?php echo $fila_user['telefono'];?></span></p>
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
        <h1>Productos disponibles en local</h1>
        <div id="containerClothing">
            <?php while ($products = mysqli_fetch_assoc($resultado)) { ?>
                <div id="box">
                    <?php
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($products['foto']) . '" class="card-img-top" style="height: 250px; object-fit: cover;">';
                    ?>
                    <div id="details">
                        <h3><?php echo $products['nombre']; ?></h3>
                        <h4><?php echo $products['description']; ?></h4>
                        <h2>$ <?php echo $products['precio']; ?></h2>
                    </div>
                    <div class="extra-options" style="padding: 10px;">
                        <center>
                            <label for="quantity">Cantidad (gramos):</label>
                            <!-- Usamos el nombre del producto como parte del id para hacer el input único -->
                            <input type="number" id="quantity-<?php echo $products['nombre']; ?>" class="quantity-input" placeholder="En gramos" min="1">
                            <button onclick="addToCart('<?php echo $products['nombre']; ?>', <?php echo $products['precio']; ?>, 'quantity-<?php echo $products['nombre']; ?>')">Añadir al Carrito</button>
                        </center>
                    </div>
                </div>
            <?php } ?>
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
            <ul id="cartItems"></ul>
            <p>Total: $<span id="totalPrice">0</span></p>
            <button id="checkoutButton" style="display: none;" onclick="checkout()">Pagar</button>
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

    //Para cerrar al hacer clic fuera del modal
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
    function addToCart(name, pricePerKilo, quantityInputId) {
        const quantityInGrams = parseFloat(document.getElementById(quantityInputId).value);

        if (isNaN(quantityInGrams) || quantityInGrams <= 0) {
            alert("Por favor, introduce una cantidad válida mayor a 0.");
            return;
        }

        const price = (pricePerKilo / 1000) * quantityInGrams;

        const existingProduct = cart.find(item => item.name === name);
        if (existingProduct) {
            existingProduct.quantityInGrams += quantityInGrams;
            existingProduct.price += price;
        } else {
            cart.push({
                name,
                pricePerKilo,
                quantityInGrams,
                price
            });
        }

        updateCartWindow();
        updateBadgeCount();
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
        cartItems.innerHTML = '';

        // Iterar sobre el carrito y agregar elementos al DOM
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.innerHTML = `
            ${item.name} - 
            <input type="number" class="input-shadow" value="${item.quantityInGrams}" min="1" 
                onchange="updateQuantity(${index}, this.value)"> g = $${item.price.toFixed(2)}
            <button onclick="removeItem(${index})">Eliminar</button>
        `;
            cartItems.appendChild(li);
        });

        // Actualizar el precio total
        totalPrice = cart.reduce((total, item) => total + item.price, 0);
        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);

        // Mostrar u ocultar el botón de pago según el estado del carrito
        const checkoutButton = document.getElementById('checkoutButton');
        if (cart.length > 0) {
            checkoutButton.style.display = 'block'; // Mostrar el botón
        } else {
            checkoutButton.style.display = 'none'; // Ocultar el botón
        }
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
        cart.splice(index, 1); // Eliminar el producto del array
        updateCartWindow();
        updateBadgeCount();
    }

    // Función para actualizar la cantidad de productos en el badge
    function updateBadgeCount() {
        document.getElementById('badge').textContent = cart.length;
    }

    // Función para pagar
    function checkout() {
        if (cart.length === 0) {
            alert("El carrito está vacío. Agrega productos antes de pagar.");
            return;
        }

        alert(`Compra realizada con éxito. Total: $${totalPrice.toFixed(2)}`);
        cart = []; // Vaciar el carrito después de pagar
        updateCartWindow();
        closeModal(); // Cerrar el modal
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
