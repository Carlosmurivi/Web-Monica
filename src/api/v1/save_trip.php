<?php
include_once '../../../config/cloudinary.php';
include_once '../../controllers/ControllerTrips.php';
header('Content-Type: application/json');
session_start();

$response["success"] = true;

$img = $_POST["img"] ?? '';
$place = $_POST["place"] ?? '';
$date = $_POST["date"] ?? '';

$url = ControllerCloudinary::saveImage($img);

ControllerTrips::saveTrip($place, $date, $url);

$response["sucess"] = "Trip saved successfully";

echo json_encode($response);