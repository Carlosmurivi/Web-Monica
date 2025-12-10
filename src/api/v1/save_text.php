<?php
header('Content-Type: application/json');
session_start();


$response["success"] = true;

if (isset($_GET['title']) && isset($_GET['context'])) {
    $id = uniqid();
    $_SESSION[$_GET['context']][] = ['id' => $id, 'type' => 'text', 'title' => $_GET["title"] ?? '', 'story' => '', 'size' => $_GET["size"] ?? ''];
    $response["data_title"] = ["id" => $id, "title" => $_GET["title"] ?? ''];
}

if (isset($_GET['story']) && isset($_GET['context'])) {
    $id = uniqid();
    $_SESSION[$_GET['context']][] = ['id' => $id, 'type' => 'text', 'title' => '', 'story' => $_GET["story"] ?? '', 'size' => $_GET["size"] ?? ''];
    $response["data_story"] = ["id" => $id, "story" => $_GET["story"] ?? ''];
}

echo json_encode($response);