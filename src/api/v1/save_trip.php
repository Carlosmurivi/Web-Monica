<?php
include_once '../../../config/cloudinary.php';
header('Content-Type: application/json');
session_start();

$response["success"] = true;

$url = ControllerCloudinary::saveImage($_POST["img"] ?? '');

$response["data"] = ["img" => $url, "place" => $_POST["place"] ?? '', "date" => $_POST["date"] ?? ''];

echo json_encode($response);