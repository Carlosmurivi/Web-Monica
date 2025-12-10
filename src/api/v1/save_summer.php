<?php
include_once '../../../config/cloudinary.php';
include_once '../../controllers/ControllerSummers.php';
header('Content-Type: application/json');
session_start();

$response["success"] = true;

$img = $_POST["img"] ?? '';
$date = $_POST["date"] ?? '';

$url = ControllerCloudinary::saveImage($img);

ControllerSummers::saveSummer($date, $url);

$response["success"] = "Summer saved successfully";

echo json_encode($response);