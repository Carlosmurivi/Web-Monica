<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

$id = $_GET['id'] ?? '';

foreach ($_SESSION['draftTrip'] as $key => $item) {
    if ($item['id'] === $id) {
        unset($_SESSION['draftTrip'][$key]);
        $response = ["success" => true];
        echo json_encode($response);
        exit; // detener aquí para no imprimir más
    }
}

foreach ($_SESSION['draftSummer'] as $key => $item) {
    if ($item['id'] === $id) {
        unset($_SESSION['draftSummer'][$key]);
        $response = ["success" => true];
        echo json_encode($response);
        exit; // detener aquí para no imprimir más
    }
}

// Si no se encontró nada
$response = [
    "success" => false,
    "message" => "Item not found"
];
echo json_encode($response);
exit;
