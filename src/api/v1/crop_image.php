<?php
include_once '../../../config/cloudinary.php';
session_start();

$id = uniqid();
$img = $_POST['img'] ?? '';
$name = $_POST['name'] ?? '';
$date = $_POST['date'] ?? '';
$size = $_POST['size'] ?? '';

$url = ControllerCloudinary::saveImage($img);

$_SESSION['draftTrip'][] = ['id' => $id, 'type' => 'image', 'url' => $url, 'name' => $name, 'date' => $date, 'size' => $size];
echo json_encode(['status' => 'success', 'url' => $url, 'id' => $id]);
