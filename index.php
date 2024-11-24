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
	<link href="landing/css/templatemo-style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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
							<li><a href="landing/about.html">Sobre</a></li>
							<li><a href="landing/tours.html">Registro</a></li>
							<li><a href="landing/contact.html">Contacto</a></li>
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
						<h1 class="tm-banner-title">ENCUENTRA <span class="tm-yellow-text">TU FURTERIA</span> MÁS CERCANA</h1>
						<p class="tm-banner-subtitle">PARA COMPRAR</p>
						<a href="#more" class="tm-banner-link">Inicia Sesión</a>
					</div>
					<img src="landing/img/banner-1.jpg" alt="Image"  />
				</li>
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">ESTAS EN <span class="tm-yellow-text">BUSCA DE</span> UNA FRUTERIA</h1>
						<p class="tm-banner-subtitle">BUSCALA AHORA</p>
						<a href="#more" class="tm-banner-link">Inicia Sesión</a>
					</div>
					<img src="landing/img/banner-2.jpg" alt="Image" />
				</li>
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">QUIERES CREAR <span class="tm-yellow-text">UN NEGOCIO</span> PARA TI</h1>
						<p class="tm-banner-subtitle">QUE ESPERAS</p>
						<a href="#more" class="tm-banner-link">REGISTRATE</a>
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
						<h2 class="tm-section-title">Encunatra productos de todo tipo</h2>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<hr>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">
						<img src="landing/img/index-03.jpg" alt="image" class="img-responsive" >
						<h3>FRUSTAS FRESCAS</h3>
						<p class="tm-date">PODUCTOS DE ALTA CALIDAD</p>
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
						<img src="landing/img/index-04.jpg" alt="image" class="img-responsive">
						<h3>Proin Gravida Nibhvel Lorem Quis Bind</h3>
						<p class="tm-date">26 March 2016</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">Travel</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2">
						<img src="landing/img/index-05.jpg" alt="image" class="img-responsive">
						<h3>Proin Gravida Nibhvel Lorem Quis Bind</h3>
						<p class="tm-date">24 March 2016</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">Travel</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-home-box-2 tm-home-box-2-right">
						<img src="landing/img/index-06.jpg" alt="image" class="img-responsive">
						<h3>Proin Gravida Nibhvel Lorem Quis Bind</h3>
						<p class="tm-date">22 March 2016</p>
						<div class="tm-home-box-2-container">
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
							<a href="#" class="tm-home-box-2-link"><span
									class="tm-home-box-2-description">Travel</span></a>
							<a href="#" class="tm-home-box-2-link"><i
									class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p class="home-description">Holiday is free Bootstrap v3.3.5 responsive template for tour and travel
						websites. You can download and use this layout for any purpose. You do not need to provide a
						credit link to us. If you have any question, feel free to <a
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
						<h2 class="tm-section-title">Popular Packages</h2>
					</div>
					<div class="col-lg-4 col-md-3 col-sm-3">
						<hr>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/index-07.jpg" alt="image" class="img-responsive">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Proin gravida nibhvell velit auctor aliquet. Aenean
								sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum</p>
							<div class="tm-home-box-2-container">
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
								<a href="#" class="tm-home-box-2-link"><span
										class="tm-home-box-2-description box-3">Travel</span></a>
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/index-08.jpg" alt="image" class="img-responsive">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Proin gravida nibhvell velit auctor aliquet. Aenean
								sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum</p>
							<div class="tm-home-box-2-container">
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
								<a href="#" class="tm-home-box-2-link"><span
										class="tm-home-box-2-description box-3">Travel</span></a>
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/index-09.jpg" alt="image" class="img-responsive">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Proin gravida nibhvell velit auctor aliquet. Aenean
								sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum</p>
							<div class="tm-home-box-2-container">
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
								<a href="#" class="tm-home-box-2-link"><span
										class="tm-home-box-2-description box-3">Travel</span></a>
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tm-home-box-3">
						<div class="tm-home-box-3-img-container">
							<img src="landing/img/index-10.jpg" alt="image" class="img-responsive">
						</div>
						<div class="tm-home-box-3-info">
							<p class="tm-home-box-3-description">Proin gravida nibhvell velit auctor aliquet. Aenean
								sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum</p>
							<div class="tm-home-box-2-container">
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-heart tm-home-box-2-icon border-right"></i></a>
								<a href="#" class="tm-home-box-2-link"><span
										class="tm-home-box-2-description box-3">Travel</span></a>
								<a href="#" class="tm-home-box-2-link"><i
										class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
							</div>
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
		$(function () {

			$('#hotelCarTabs a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			})

			$('.date').datetimepicker({
				format: 'MM/DD/YYYY'
			});
			$('.date-time').datetimepicker();

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
			$('a[href*=#]:not([href=#])').click(function () {
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
		$(window).load(function () {
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