<?php
include_once '../../controllers/ControllerSummers.php';
header('Content-Type: application/json');
session_start();

$response["success"] = true;

$response["data"] = ControllerSummers::getSummers();

echo json_encode($response);