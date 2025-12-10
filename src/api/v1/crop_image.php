<?php
include_once '../../../config/cloudinary.php';
include_once '../../controllers/ControllerImages.php';
session_start();

$id = uniqid();
$img = $_POST['img'] ?? '';
$name = $_POST['name'] ?? '';
$date = $_POST['date'] ?? '';
$size = $_POST['size'] ?? '';
$context = $_POST['context'] ?? '';

$url = ControllerCloudinary::saveImage($img);

if($context == "") {
    ControllerImages::saveImage($name, $date, $url, "image");
    echo json_encode(['status' => 'success', 'url' => $url, 'id' => $id]);
    exit();
}

$_SESSION[$context][] = ['id' => $id, 'type' => 'image', 'url' => $url, 'name' => $name, 'date' => $date, 'size' => $size];
echo json_encode(['status' => 'success', 'url' => $url, 'id' => $id]);
