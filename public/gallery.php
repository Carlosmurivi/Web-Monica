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
    <title>Galería</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../croppie/croppie.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="../croppie/croppie.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include("../src/views/menu.php"); ?>

    <h1 class="titulo">NUESTROS MOMENTOS</h1>

    <div class="col-6 mx-auto mb-3 d-flex flex-wrap">
        <div class="col-9 pe-1">
            <input type="text" class="form-control border-blue blue" id="searchInput" placeholder="Buscar por lugar...">
        </div>
        <div class="col-1 px-1">
            <a class="btn btn-primary w-100" data-bs-toggle="collapse" href="#collapseFilters" role="button"
                aria-expanded="false" aria-controls="collapseFilters">
                V
            </a>
        </div>
        <div class="col-2 ps-1">
            <a class="btn btn-primary w-100" data-bs-toggle="collapse" href="#collapseImage" role="button"
                aria-expanded="false" aria-controls="collapseFilters">
                Añadir
            </a>
        </div>
    </div>

    <div id="formularios">
        <!-- Filtros fecha -->
        <div class="collapse" id="collapseFilters" data-bs-parent="#formularios">
            <div class="d-flex flex-wrap col-6 mx-auto mb-5">
                <div class="col-6 pe-1 d-flex flex-wrap">
                    <label for="maximum-date" class="form-label col-4 my-auto">Fecha máxima</label>
                    <div class="col-8">
                        <input class="form-control w-100" type="date" name="maximum-date" id="maximum-date">
                    </div>
                </div>
                <div class="col-6 ps-1 d-flex flex-wrap">
                    <label for="minimum-date" class="form-label col-4 my-auto">Fecha mínima</label>
                    <div class="col-8">
                        <input class="form-control w-100" type="date" name="minimum-date" id="minimum-date">
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario añadir imagen -->
        <div class="collapse col-6 mx-auto mb-5" id="collapseImage" data-bs-parent="#formularios">
            <div class="card card-body">
                <div class="d-flex flex-wrap">
                    <div class="col-12 mb-3">
                        <input type="text" class="form-control border-blue blue" id="name" name="name"
                            placeholder="Nombre" required>
                    </div>
                    <div class="col-6 pe-1">
                        <input class="form-control h-100" type="file" name="input-image" accept="image/jpeg, image/png"
                            id="input-image" required>
                    </div>
                    <div class="col-6 ps-1">
                        <input class="form-control h-100" type="date" name="date-image" id="date-image" required>
                    </div>
                    <div id="croppie-editor-image" class="d-none mt-4 mb-3 col-12">
                        <div>
                            <div id="croppie-field-image"></div>
                        </div>
                        <div class="mx-0 text-center">
                            <button class="btn btn-sm btn-light border border-dark rounded-0" id="rotate-left-image"
                                type="button">Girar a la Izquierda</button>
                            <button class="btn btn-sm btn-light border border-dark rounded-0" id="rotate-right-image"
                                type="button">Girar a la Derecha</button>
                        </div>
                    </div>
                    <p id="error-add-image" class="text-danger col-12 text-center"></p>
                    <button type="submit" id="add-image" class="btn btn-primary mt-4 col-12">Añadir</button>
                    <div class="col-12 text-center mx-auto d-none mt-4" id="spinner-image">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="container mb-4">
        <div class="masonry" id="masonry">

        </div>
    </main>

    <?php include("../src/views/footer.php"); ?>
</body>
<script src="js/gallery.js"></script>

</html>