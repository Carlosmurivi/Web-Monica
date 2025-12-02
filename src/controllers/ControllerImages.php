<?php
require_once __DIR__ . '/../../config/database.php';

class ControllerImages
{
    protected static function secureSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function saveImage($place, $date, $url, $category)
    {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO image (place, date, url, category) VALUES (:place, :date, :url, :category)");
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':category', $category);
        $stmt->execute();

        $image_id = $pdo->lastInsertId();

        return $image_id;
    }
}