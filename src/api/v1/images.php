<?php
include_once '../../../config/cloudinary.php';
include_once '../../controllers/ControllerImages.php';
session_start();



// GUARDAR IMAGEN

if (isset($_POST['context'])) {
    $id = uniqid();
    $img = $_POST['img'] ?? '';
    $name = $_POST['name'] ?? '';
    $date = $_POST['date'] ?? '';
    $size = $_POST['size'] ?? '';
    $context = $_POST['context'] ?? '';
    $url = ControllerCloudinary::saveImage($img);

    if ($context == "") {
        ControllerImages::saveImage($name, $date, $url, "image");
        echo json_encode(['status' => 'success', 'url' => $url, 'id' => $id]);
        exit();
    }

    $_SESSION[$context][] = ['id' => $id, 'type' => 'image', 'url' => $url, 'name' => $name, 'date' => $date, 'size' => $size];
    echo json_encode(['status' => 'success', 'url' => $url, 'id' => $id]);
}





// OBTENER IMAGENES

$response["success"] = true;
$place = $_GET['place'] ?? null;
$maxDate = $_GET['maximum-date'] ?? null;
$minDate = $_GET['minimum-date'] ?? null;
$category = $_GET['category'] ?? null;

if ($place || $maxDate || $minDate) {
    $response["data"] = ControllerImages::getAllImagesByPlaceMaximumDateMinimumDate($place, $maxDate, $minDate);
} elseif ($category) {
    $response["data"] = ControllerImages::getAllImagesByCategory($category);
} else {
    $response["data"] = ControllerImages::getAllImages();
}

echo json_encode($response);
exit();