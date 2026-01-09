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

    <h1 class="text-center my-5 py-5 text-danger">🚧🚧 ESTE APARTADO ESTÁ EN PROCESO 🚧🚧</h1>

    <?php include("../src/views/footer.php"); ?>
</body>

<script src="js/index.js"></script>

</html>