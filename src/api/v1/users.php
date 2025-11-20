<?php
// require_once("../../controllers/ControllerUsers.php");
// header('Content-Type: application/json');

// $response = [];

// if(isset($_POST["name"]) && isset($_POST["password"])) {
//     $consulta = ControllerUsers::verifyUser($_POST["name"], $_POST["password"]);
// }


// if (!$consulta) {
//     $response["sucess"] = false;
//     $response["data"] = null;
//     $response["message"] = "Not found 404";
// } else {
//     $response["sucess"] = true;
//     $response["data"] = $consulta;
//     $response["message"] = "Datos obtenidos exitosamente";
// }

// echo json_encode($response);