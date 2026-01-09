<?php
include_once '../src/controllers/ControllerUsers.php';
include_once '../src/controllers/ControllerImages.php';

if (!ControllerUsers::checkLoggedInUser()) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include("../src/views/menu.php"); ?>

    <div class="container my-5">
        <h2 class="titulo">VIAJES</h2>

        <div id="tripCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" id="carousel-trips"></div>

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#tripCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#tripCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <div class="container my-5 pt-4">
        <h2 class="titulo">VERANOS</h2>

        <div id="summerCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" id="carousel-summers"></div>

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#summerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#summerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <div class="container my-5 pt-4">
        <h2 class="titulo">OTROS MOMENTOS</h2>

        <main class="container mb-4">
            <div class="masonry" id="masonry">

            </div>
        </main>
    </div>

    <?php include("../src/views/footer.php"); ?>
</body>

<script src="js/index.js"></script>

</html>