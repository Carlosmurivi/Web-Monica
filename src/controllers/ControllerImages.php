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

    public static function getImageById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM image WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function getAllImages()
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM image ORDER BY date DESC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getAllImagesByPlaceMaximumDateMinimumDate($place, $maximumDate, $minimumDate)
    {
        global $pdo;

        if ($place != null && $maximumDate != null && $minimumDate != null) {
            $place = "%" . $place . "%";
            $stmt = $pdo->prepare("SELECT * FROM image WHERE place ILIKE :place AND date < :maximumDate AND date > :minimumDate ORDER BY date DESC");
            $stmt->bindParam(':place', $place);
            $stmt->bindParam(':maximumDate', $maximumDate);
            $stmt->bindParam(':minimumDate', $minimumDate);
        } elseif ($place != null && $maximumDate != null) {
            $place = "%" . $place . "%";
            $stmt = $pdo->prepare("SELECT * FROM image WHERE place ILIKE :place AND date < :maximumDate ORDER BY date DESC");
            $stmt->bindParam(':place', $place);
            $stmt->bindParam(':maximumDate', $maximumDate);
        } elseif ($place != null && $minimumDate != null) {
            $place = "%" . $place . "%";
            $stmt = $pdo->prepare("SELECT * FROM image WHERE place ILIKE :place AND date > :minimumDate ORDER BY date DESC");
            $stmt->bindParam(':place', $place);
            $stmt->bindParam(':minimumDate', $minimumDate);
        } elseif ($maximumDate != null && $minimumDate != null) {
            $stmt = $pdo->prepare("SELECT * FROM image WHERE date < :maximumDate AND date > :minimumDate ORDER BY date DESC");
            $stmt->bindParam(':maximumDate', $maximumDate);
            $stmt->bindParam(':minimumDate', $minimumDate);
        } elseif ($place != null) {
            $place = "%" . $place . "%";
            $stmt = $pdo->prepare("SELECT * FROM image WHERE place ILIKE :place ORDER BY date DESC");
            $stmt->bindParam(':place', $place);
        } elseif ($maximumDate != null) {
            $stmt = $pdo->prepare("SELECT * FROM image WHERE date < :maximumDate ORDER BY date DESC");
            $stmt->bindParam(':maximumDate', $maximumDate);
        } elseif ($minimumDate != null) {
            $stmt = $pdo->prepare("SELECT * FROM image WHERE date > :minimumDate ORDER BY date DESC");
            $stmt->bindParam(':minimumDate', $minimumDate);
        } else {
            return self::getAllImages();
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}