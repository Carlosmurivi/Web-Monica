<?php
include_once '../src/controllers/ControllerUsers.php';

if (!ControllerUsers::checkLoggedInUser()) {
    header("Location: login.php");
    exit();
}

$_SESSION['draftTrip'] = $_SESSION['draftTrip'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viajes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../croppie/croppie.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <script src="../croppie/croppie.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include("../src/views/menu.php"); ?>

    <h1 class="titulo">CREAR VIAJE</h1>

    <div id="tripContainer" class="col-8 mx-auto d-flex flex-wrap mb-5">
        <div class="d-flex flex-wrap col-12 px-5">
            <div class="col-4 pe-2">
                <input type="text" class="form-control border-blue blue" id="place" name="place" placeholder="Lugar"
                    required>
            </div>
            <div class="col-4 pe-2">
                <input class="form-control h-100" type="date" name="date" id="date" required>
            </div>
            <div class="col-4 ps-2">
                <input class="form-control h-100" type="file" name="front-page" accept="image/jpeg, image/png"
                    id="front-page" required>
            </div>
        </div>
        <div id="croppie-editor" class="col-12 mx-auto mt-4">
            <div>
                <div id="croppie-field"></div>
            </div>
        </div>

        <?php
        foreach ($_SESSION['draftTrip'] as $item) {
            switch ($item['type']) {
                case 'image':
                    echo <<<HTML
                        <div class="{$item['size']} mb-4 px-2 position-relative item-carrusel">
                            <div class="card">
                                <img src="{$item['url']}" class="card-img-top contenido-carrusel">
                                <p class="card-text text-end text-secondary py-1 pe-2 contenido-carrusel">{$item['date']}</p>
                            </div>
                            <div class="overlay-carrusel">
                                <button class="btn btn-danger btn-sm eliminar-item" id-item="{$item['id']}">Eliminar</button>
                            </div>
                        </div> 
                        HTML;
                    break;

                case 'text':
                    if (!empty($item['title'])) {
                        echo <<<HTML
                            <div class="{$item['size']} mb-3 mt-5 px-2 position-relative item-carrusel">
                                <h2 class="contenido-carrusel">{$item['title']}</h2>
                                <div class="overlay-carrusel">
                                    <button class="btn btn-danger btn-sm eliminar-item" id-item="{$item['id']}">Eliminar</button>
                                </div>
                            </div>
                        HTML;
                    }

                    if (!empty($item['story'])) {
                        echo <<<HTML
                            <div class="{$item['size']} mt-2 mb-3 px-2 position-relative item-carrusel">
                                <p class="contenido-carrusel">{$item['story']}</p>
                                <div class="overlay-carrusel">
                                    <button class="btn btn-danger btn-sm eliminar-item" id-item="{$item['id']}">Eliminar</button>
                                </div>
                            </div>
                        HTML;
                    }
                    break;
            }
        }
        ?>

    </div>

    <div class="col-8 mx-auto text-center">
        <!-- Botones para añadir contenido -->
        <div class="d-inline-flex gap-2 mb-3">
            <!-- Botón Imagen -->
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseImage" role="button"
                aria-expanded="false" aria-controls="collapseImage">
                Añadir Imagen
            </a>

            <!-- Botón Texto -->
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseText" role="button"
                aria-expanded="false" aria-controls="collapseText">
                Añadir Texto
            </a>
        </div>

        <!-- Contenedor padre para que se cierren entre sí -->
        <div id="formularios">
            <!-- Collapse Imagen -->
            <div class="collapse" id="collapseImage" data-bs-parent="#formularios">
                <div class="card card-body">
                    <div class="d-flex flex-wrap">
                        <div class="col-9 mb-3 ps-2">
                            <input type="text" class="form-control border-blue blue" id="name" name="name"
                                placeholder="Nombre" required>
                        </div>
                        <div class="col-3 mb-3 ps-2">
                            <select class="form-select border-blue blue" id="size-image" required>
                                <option value="col-12" selected>100%</option>
                                <option value="col-6">50%</option>
                                <option value="col-4">33%</option>
                                <option value="col-3">25%</option>
                            </select>
                        </div>
                        <div class="col-6 ps-2">
                            <input class="form-control h-100" type="file" name="input-image"
                                accept="image/jpeg, image/png" id="input-image" required>
                        </div>
                        <div class="col-6 ps-2">
                            <input class="form-control h-100" type="date" name="date-image" id="date-image" required>
                        </div>
                        <div id="croppie-editor-image" class="d-none mt-4 mb-3 col-12">
                            <div>
                                <div id="croppie-field-image"></div>
                            </div>
                            <div class="mx-0 text-center">
                                <button class="btn btn-sm btn-light border border-dark rounded-0" id="rotate-left-image"
                                    type="button">Girar a la Izquierda</button>
                                <button class="btn btn-sm btn-light border border-dark rounded-0"
                                    id="rotate-right-image" type="button">Girar a la Derecha</button>
                            </div>
                        </div>
                        <p id="error-add-image" class="text-danger col-12 text-center"></p>
                        <button type="submit" id="add-image" class="btn btn-primary mt-4 col-12">Añadir</button>
                        <div class="col-12 mx-auto d-none mt-4" id="spinner-image">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Collapse Texto -->
            <div class="collapse" id="collapseText" data-bs-parent="#formularios">
                <div class="card card-body d-flex flex-wrap">
                    <div class="d-flex flex-wrap">
                        <div class="col-9 mb-3 ps-2">
                            <input type="text" class="form-control border-blue blue" id="title" name="title"
                                placeholder="Titulo" required>
                        </div>
                        <div class="col-3 mb-3 ps-2">
                            <select class="form-select border-blue blue" id="size-text" required>
                                <option value="col-12" selected>100%</option>
                                <option value="col-6">50%</option>
                                <option value="col-4">33%</option>
                                <option value="col-3">25%</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3 ps-2">
                            <textarea class="form-control border-blue blue" placeholder="Cuenta tu historia..."
                                id="story" style="height: 100px"></textarea>
                        </div>
                        <p id="error-add-text" class="text-danger col-12 text-center"></p>
                        <button type="submit" id="add-text" class="btn btn-success mt-4 col-12">Añadir</button>
                        <div class="col-12 mx-auto d-none mt-4" id="spinner-text">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-8 mx-auto mt-4 p-5">
        <p id="error" class="text-danger col-12 text-center"></p>
        <button class="col-12 btn btn-primary fs-3" id="save-trip">Guardar Viaje</button>
        <div class="col-12 text-center d-none mt-4" id="spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</body>

<script src="js/createTrips.js"></script>

</html>