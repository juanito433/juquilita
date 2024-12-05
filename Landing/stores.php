<?php
include('../connection/conexion.php');
$consulta = "SELECT * FROM store LIMIT 4";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
$baner = $resultado->fetch_assoc();
$consult = "SELECT * FROM store";
$result = mysqli_query($conexion, $consult) or die(mysqli_error($conexion));

$row = $result->fetch_assoc()
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Holiday - Tours</title>

	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="css/flexsliders.css" rel="stylesheet">
	<link href="css/stemplatemo-style.css" rel="stylesheet">

	<style>
		.store {
			width: 532px;
			height: 247px;
			object-fit: cover;
		}
	</style>
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
							<li><a href="../index.php">INICIO</a></li>
							<li><a href="sobre.html">SOBRE</a></li>
							<li><a href="#" class="active">Tiendas</a></li>
							<li><a href="../login/login.html">SESIÓN</a></li>
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
					<img src="img/b1.jpg" alt="Image" />
				</li>
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">ESTAS EN <span class="tm-yellow-text">BUSCA DE</span> UNA FRUTERIA</h1>
						<p class="tm-banner-subtitle">BUSCALA AHORA</p>
						<a href="#more" class="tm-banner-link">Inicia Sesión</a>
					</div>
					<img src="img/banner-2.jpg" alt="Image" />
				</li>
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">QUIERES CREAR <span class="tm-yellow-text">UN NEGOCIO</span> PARA TI</h1>
						<p class="tm-banner-subtitle">QUE ESPERAS</p>
						<a href="#more" class="tm-banner-link">REGISTRATE</a>
					</div>
					<img src="img/banner-3.jpg" alt="Image" />
				</li>
			</ul>
		</div>
	</section>

	<!-- gray bg -->
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<?php
			if ($result->num_rows > 0) {
				while ($baner = $result->fetch_assoc()) {
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
		</div>

		<div class="section-margin-top">
			<div class="row">
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<hr>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h2 class="tm-section-title">Futerias Disponibles</h2>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<hr>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				// Verificar si hay resultados
				if ($resultado->num_rows > 0) {
					// Recorrer los resultados y generar HTML
					while ($row = $resultado->fetch_assoc()) {
						$nombre = $row['nombre']; // Nombre de la frutería
						$telefono = $row['telefono']; // Teléfono de la frutería
						$direccion = $row['ubicacion']; // Dirección de la frutería
						$foto = $row['foto']; // Foto de la frutería
						$id = $row['id'];
				?>
						<!-- Estructura HTML que quieres mostrar por cada tienda -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="tm-tours-box-1">

								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" alt="image" class="store">' ?>

								<div class="tm-tours-box-1-info">
									<div class="tm-tours-box-1-info-left">
										<p class="text-uppercase margin-bottom-20"><?php echo $nombre; ?></p>
										<p class="gray-text"><?php echo $telefono; ?></p>
									</div>
									<div class="tm-tours-box-1-info-right">
										<p class="gray-text tours-1-description"><?php echo $direccion; ?></p>
									</div>
								</div>
								<div class="tm-tours-box-1-link">
									<div class="tm-tours-box-1-link-left">
										Compra en <?php echo $nombre; ?>
									</div>
									<a href="../app/index.php?id=<?php echo urlencode($row['id']); ?>" class="tm-tours-box-1-link-right">
										ir a la fruteria
									</a>

								</div>
							</div>
						</div>
				<?php
					}
				} else {
					echo "No hay tiendas disponibles.";
				}
				?>
			</div>
		</div>
	</section>

	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2024 JUQUILITA</p>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="js/moment.js"></script> <!-- moment.js -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script> <!-- bootstrap js -->
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<!-- bootstrap date time picker js, http://eonasdan.github.io/bootstrap-datetimepicker/ -->
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
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
			$('.flexslider').flexslider({
				controlNav: false
			});
		});
	</script>
</body>

</html>