<?php
include_once '../../controllers/ControllerImages.php';
header('Content-Type: application/json');
session_start();

$response["success"] = true;

$place = $_GET['place'] ?? null;
$maxDate = $_GET['maximum-date'] ?? null;
$minDate = $_GET['minimum-date'] ?? null;

if ($place || $maxDate || $minDate) {
    $response["data"] = ControllerImages::getAllImagesByPlaceMaximumDateMinimumDate($place, $maxDate, $minDate);
} else {
    $response["data"] = ControllerImages::getAllImages();
}

echo json_encode($response);
exit();
