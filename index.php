<?php
include('connection/conexion.php');
$consulta = "SELECT * FROM store LIMIT 4";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
$baner = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home App</title>

	<link href="landing/css/font-awesome.min.css" rel="stylesheet">
	<link href="landing/css/bootstrap.min.css" rel="stylesheet">
	<link href="landing/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="landing/css/flexsliders.css" rel="stylesheet">
	<link href="landing/css/stemplatemo-style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<style>
	.imagen {
		width: 250px;
		height: 225px;
		object-fit: cover;
	}

	.tipo {
		height: 186px;
		width: 255px;
		object-fit: cover;
	}

	@media (max-width: 768px) {
		.adap {
			display: flex;
			flex-direction: column;
			flex-wrap: nowrap;
			align-items: center;
		}
	}
</style>

<body class="tm-gray-bg">
	<!-- Header -->
	<div class="tm-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-4 col-sm-3 tm-site-name-container">
					<a href="#" class="tm-site-name">JUQUILITA</a>
				</div>
				<div class="col-lg-6 col-md-8 col-sm-9">
					<div class="mobile-menu-icon">
						<i class="fa fa-bars"></i>
					</div>
					<nav class="tm-nav">
						<ul>
							<li><a href="index.html" class="active">Inicio</a></li>
							<li><a href="landing/sobre.html">Sobre</a></li>
							<li><a href="landing/stores.php">Tiendas</a></li>
							<li><a href="login/login.html">Sesión</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<!-- Banner -->
	<section class="tm-banner">
		<!-- Flexslider -->
		<div class="flexslider flexslider-banner">
			<ul class="slides">
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">ENCUENTRA <span class="tm-yellow-text">TU FRUTERIA</span> MÁS CERCANA</h1>
						<p class="tm-banner-subtitle">PARA COMPRAR</p>
						<a href="login/login.html" class="tm-banner-link">Inicia Sesión</a>
					</div>
					<img src="landing/img/b1.jpg" alt="Image" />
				</li>
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">ESTAS EN <span class="tm-yellow-text">BUSCA DE</span> UNA FRUTERIA</h1>
						<p class="tm-banner-subtitle">BUSCALA AHORA</p>
						<a href="login/login.html" class="tm-banner-link">Inicia Sesión</a>
					</div>
					<img src="landing/img/banner-2.jpg" alt="Image" />
				</li>
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">QUIERES CREAR <span class="tm-yellow-text">UN NEGOCIO</span> PARA TI</h1>
						<p class="tm-banner-subtitle">QUE ESPERAS</p>
						<a href="login/login_empresa.html" class="tm-banner-link">REGISTRATE</a>
					</div>
					<img src="landing/img/banner-3.jpg" alt="Image" />
				</li>
			</ul>
		</div>
	</section>

	<!-- Primeras 3 fruterias -->
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<?php
			if ($resultado->num_rows > 0) {
				while ($baner = $resultado->fetch_assoc()) {
					// Obtener los datos de la fila actual
					$nombre = $baner['nombre'];
					$telefono = $baner['telefono'];

					// Generar el bloque HTML dinámicamente
					echo '<div class="col-lg-4 col-md-4 col-sm-6">';
					echo '    <div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">';
					echo '		<img src="data:image/jpeg;base64,' . base64_encode($baner['foto']) . '" alt="image" class="baner">';
					echo '        <a href="#">';
					echo '            <div class="tm-green-gradient-bg tm-city-price-container">';
					echo "                <span>$nombre</span>";
					echo "                <span>$telefono</span>";
					echo '            </div>';
					echo '        </a>';
					echo '    </div>';
					echo '</div>';
				}
			}
			?>
			<!-- <div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
					<img src="landing/img/index-01.jpg" alt="image" class="img-responsive">
					<a href="#">
						<div class="tm-green-gradient-bg tm-city-price-container">
							<span>Juquilita</span>
							<span>Teapa, Tabasco</span>
						</div>
					</a>
				</div>
			</div> -->
		</div>

		<div class="section-margin-top">
			<div class="row">
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<hr>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h2 class="tm-section-title">Encuentra buen servicio y productos de todo tipo</h2>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<hr>
					</div>
				</div>
			</div>
			<div class="row adap">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">
						<img src="landing/img/3.jpg" alt="image" class="img-responsive tipo">
						<h3>FRUSTAS FRESCAS</h3>
						<p class="tm-date">PRODUCTOS DE ALTA CALIDAD</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">FRUTAS</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">
						<img src="landing/img/44.jpg" alt="image" class="img-responsive tipo">
						<h3>VERDURAS FRESCAS</h3>
						<p class="tm-date">PRODUCTOS CONFIABLES</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">VERDURAS</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">
						<img src="landing/img/5.webp" alt="image" class="img-responsive tipo">
						<h3>ABARROTES</h3>
						<p class="tm-date">Productos de abarrotera</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">Abarrotes</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2 tm-home-box-2-right">
						<img src="landing/img/6.webp" alt="image" class="img-responsive tipo">
						<h3>Buenos servicios</h3>
						<p class="tm-date">Atencion de calidad</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">Servicio</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p class="home-description">Buscamos que neustra aplicación impulse a los negocios y que ayude a personas a conseguir productos de calidad a solo un clic <a
							href="http://www.facebook.com/templatemo" target="_parent">contact us</a>. Credit goes to <a
							rel="nofollow" href="http://unsplash.com" target="_parent">Unspash</a> for images used in
						this template.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- white bg -->
	<section class="tm-white-bg section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3">
						<hr>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<h2 class="tm-section-title">Que saber</h2>
					</div>
					<div class="col-lg-4 col-md-3 col-sm-3">
						<hr>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/78.jpg" alt="image" class="img-responsive imagen">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Gestión de Empresas y Negocios</p>

							<ul class="tm-home-box-3-description">
								<li>Crear y gestionar su inventario: Agregar, editar y eliminar productos fácilmente.</li>
								<li>Monitorear sus ventas: Llevar un registro actualizado de las ventas realizadas.</li>
								<li>Mantener control personalizado: Ajustar precios y cantidades según sus necesidades.</li>
							</ul>


						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/8.jpg" alt="image" class="img-responsive imagen">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Compra en Línea para Clientes</p>
							<ul class="tm-home-box-3-description">
								<li>Agregar productos a un carrito de compras: Elegir frutas y otros productos con la cantidad deseada.</li>
								<li>Realizar pedidos personalizados: Especificar la dirección de entrega para recibir los productos en casa.</li>
								<li>Pagos sencillos: Completar sus compras rápidamente y sin complicaciones.</li>
							</ul>

						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/9.jpg" alt="image" class="img-responsive imagen">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Conexión entre Empresas y Clientes</p>
							<ul class="tm-home-box-3-description">
								<li>Las empresas pueden ofrecer sus productos directamente a los consumidores.</li>
								<li>Los clientes pueden buscar empresas cercanas, conocer sus ofertas y realizar pedidos fácilmente.</li>
								<li>Promueve un comercio local eficiente y una comunidad conectada.</li>
							</ul>

						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/10.jpg" alt="image" class="img-responsive imagen">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Facilidad para Actualizar y Gestionar el Inventario</p>
							<ul class="tm-home-box-3-description">
								<li>Agregar nuevos productos al catálogo: Por ejemplo, frutas de temporada o promociones especiales.</li>
								<li>Actualizar inventarios en tiempo real: Modificar la disponibilidad de productos según las ventas o nuevas llegadas.</li>
								<li>Organizar su sistema de ventas</li>
							</ul>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2084 Your Company Name</p>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="landing/js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="landing/js/moment.js"></script> <!-- moment.js -->
	<script type="text/javascript" src="landing/js/bootstrap.min.js"></script> <!-- bootstrap js -->
	<script type="text/javascript" src="landing/js/bootstrap-datetimepicker.min.js"></script>
	<!-- bootstrap date time picker js, landing/http://eonasdan.github.io/bootstrap-datetimepicker/ -->
	<script type="text/javascript" src="landing/js/jquery.flexslider-min.js"></script>
	<!--
	<script src="js/froogaloop.js"></script>
	<script src="js/jquery.fitvid.js"></script>
-->
	<script type="text/javascript" src="landing/js/templatemo-script.js"></script> <!-- Templatemo Script -->
	<script>
		// HTML document is loaded. DOM is ready.
		$(function() {

			$('#hotelCarTabs a').click(function(e) {
				e.preventDefault()
				$(this).tab('show')
			})

			$('.date').datetimepicker({
				format: 'MM/DD/YYYY'
			});
			$('.date-time').datetimepicker();

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});
		});

		// Load Flexslider when everything is loaded.
		$(window).load(function() {
			// Vimeo API nonsense

			/*
						  var player = document.getElementById('player_1');
						  $f(player).addEvent('ready', ready);
						 
						  function addEvent(element, eventName, callback) {
							if (element.addEventListener) {
							  element.addEventListener(eventName, callback, false)
							} else {
							  element.attachEvent(eventName, callback, false);
							}
						  }
						 
						  function ready(player_id) {
							var froogaloop = $f(player_id);
							froogaloop.addEvent('play', function(data) {
							  $('.flexslider').flexslider("pause");
							});
							froogaloop.addEvent('pause', function(data) {
							  $('.flexslider').flexslider("play");
							});
						  }
			*/



			// Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
			/*
			
						  $(".flexslider")
							.fitVids()
							.flexslider({
							  animation: "slide",
							  useCSS: false,
							  animationLoop: false,
							  smoothHeight: true,
							  controlNav: false,
							  before: function(slider){
								$f(player).api('pause');
							  }
						  });
			*/




			//	For images only
			$('.flexslider').flexslider({
				controlNav: false
			});


		});
	</script>
</body>

</html>