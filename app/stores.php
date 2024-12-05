<?php
include('../connection/conexion.php');
session_start();
if (!isset($_SESSION['id_users'])) {
    header("Location: ../login/login.html");
    exit();
}
$consulta = "SELECT * FROM store";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juquilita</title>
    <!-- Linking Google fonts for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Linking SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="stores.css">
</head>

<body>
    <div class="container swiper">
        <div class="card-wrapper">
            <h1>Busca una Fruteria/Tienda</h1>
            <!-- Card slides container -->
            <ul class="card-list swiper-wrapper">
                <?php while($fila = mysqli_fetch_row($resultado)){?>
                <li class="card-item swiper-slide">
                    <a href="index.php?id=<?php echo urlencode($fila[0]); ?>" class="card-link">
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($fila[3])  ?>" alt="Card Image" class="card-image">
                        <p class="badge badge-designer"><?php echo $fila[1] ?></p>
                        <h2 class="card-title"><?php echo $fila[2] ?></h2>
                        <button class="card-button material-symbols-rounded">arrow_forward</button>
                    </a>
                </li>
                <?php } ?>
                <!-- <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="images/developer.jpg" alt="Card Image" class="card-image">
                        <p class="badge badge-developer">Developer</p>
                        <h2 class="card-title">Lorem ipsum dolor sit explicabo adipisicing elit</h2>
                        <button class="card-button material-symbols-rounded">arrow_forward</button>
                    </a>
                </li>
                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="images/marketer.jpg" alt="Card Image" class="card-image">
                        <p class="badge badge-marketer">Marketer</p>
                        <h2 class="card-title">Lorem ipsum dolor sit explicabo adipisicing elit</h2>
                        <button class="card-button material-symbols-rounded">arrow_forward</button>
                    </a>
                </li>
                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="images/gamer.jpg" alt="Card Image" class="card-image">
                        <p class="badge badge-gamer">Gamer</p>
                        <h2 class="card-title">Lorem ipsum dolor sit explicabo adipisicing elit</h2>
                        <button class="card-button material-symbols-rounded">arrow_forward</button>
                    </a>
                </li>
                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="images/editor.jpg" alt="Card Image" class="card-image">
                        <p class="badge badge-editor">Editor</p>
                        <h2 class="card-title">Lorem ipsum dolor sit explicabo adipisicing elit</h2>
                        <button class="card-button material-symbols-rounded">arrow_forward</button>
                    </a>
                </li> -->
            </ul>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Navigation Buttons -->
            <div class="swiper-slide-button swiper-button-prev"></div>
            <div class="swiper-slide-button swiper-button-next"></div>
        </div>
    </div>

    <!-- Linking SwiperJS script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Linking custom script -->
    <script>
        new Swiper('.card-wrapper', {
            loop: true,
            spaceBetween: 30,

            // Pagination bullets
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Responsive breakpoints
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
    </script>
</body>

</html>