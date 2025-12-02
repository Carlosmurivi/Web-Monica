<?php
include_once '../src/controllers/ControllerUsers.php';
include_once '../src/controllers/ControllerTrips.php';

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
    <title>Viajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("../src/views/menu.php"); ?>

    <h1 class="titulo">NUESTROS VIAJES</h1>

    <p class="texto">"Todos estos lugares tendrán por siempre un trocito nuestro"</p>

    <div class="col-10 mx-auto p-4 bg-light-blue rounded-3 mb-5 d-flex flex-wrap">
        <?php
        $trips = ControllerTrips::getTrips();

        foreach ($trips as $trip) {
            include("../src/views/tripCard.php");
        }
        ?>
    </div>

    <p>Fin</p>
</body>
</html>