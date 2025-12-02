<?php
include_once '../src/controllers/ControllerUsers.php';
include_once '../src/controllers/ControllerTrips.php';
include_once '../src/controllers/ControllerImages.php';
include_once '../src/controllers/ControllerTexts.php';

if (!ControllerUsers::checkLoggedInUser()) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $trip = ControllerTrips::getTripById($_GET['id']);
    $details_trips = ControllerTrips::getDetailsTripById($_GET['id']);
    if ($details_trips === null || empty($details_trips)) {
        header("Location: trips.php");
        exit();
    }
} else {
    header("Location: trips.php");
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

    <h1 class="titulo mb-0"><?php echo htmlspecialchars($trip["place"]); ?></h1>
    <p class="texto mt-0"><?php echo htmlspecialchars($trip["date"]); ?></p>

    <!-- <div class="col-4 mx-auto mb-4 px-2">
        <div class="card">
            <img src="<?php echo htmlspecialchars(ControllerImages::getImageById($trip['cover'])->url); ?>"
                class="card-img-top contenido-carrusel">
        </div>
    </div> -->

    <div id="tripContainer" class="col-8 mx-auto d-flex flex-wrap mb-5">
        <?php
        foreach ($details_trips as $item) {
            switch ($item['type']) {
                case 'image':
                    $image = ControllerImages::getImageById($trip['cover']);
                    echo <<<HTML
                        <div class="{$item['size']} mb-4 px-2">
                            <div class="card">
                                <img src="{$image->url}" class="card-img-top">
                                <p class="card-text text-end text-secondary py-1 pe-2">{$image->date}</p>
                            </div>
                        </div> 
                        HTML;
                    break;
                case 'title':
                    $title = ControllerTexts::getTextById($item['text_id']);
                    echo <<<HTML
                            <div class="{$item['size']} mb-3 mt-5 px-2">
                                <h2>{$title['content']}</h2>
                            </div>
                        HTML;
                    break;
                case 'story':
                    $story = ControllerTexts::getTextById($item['text_id']);
                    echo <<<HTML
                            <div class="{$item['size']} mt-2 mb-3 px-2">
                                <p>{$story['content']}</p>
                            </div>
                        HTML;
                    break;
            }
        }
        ?>
    </div>

    <?php include("../src/views/footer.php"); ?>

</body>

</html>