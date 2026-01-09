<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ControllerImages.php';
require_once __DIR__ . '/ControllerTexts.php';

class ControllerTrips
{
    protected static function secureSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function saveTrip($place, $date, $url)
    {
        $cover_id = ControllerImages::saveImage("", $date, $url, "trip");

        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO trip (cover, place, date) VALUES (:cover, :place, :date)");
        $stmt->bindParam(':cover', $cover_id);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        $trip_id = $pdo->lastInsertId();

        foreach ($_SESSION['draftTrip'] as $detailTrip) {
            if ($detailTrip['type'] === 'image') {
                $image_id = ControllerImages::saveImage($detailTrip['name'], $detailTrip['date'], $detailTrip['url'], "trip");

                global $pdo;

                $stmt = $pdo->prepare("INSERT INTO detail_trip (trip_id, type, image_id, size) VALUES (:trip_id, :type, :image_id, :size)");
                $stmt->bindParam(':trip_id', $trip_id);
                $stmt->bindParam(':type', $detailTrip['type']);
                $stmt->bindParam(':image_id', $image_id);
                $stmt->bindParam(':size', $detailTrip['size']);
                $stmt->execute();
            } elseif ($detailTrip['type'] === 'text') {
                if (!empty($detailTrip['title'])) {
                    $text_id = ControllerTexts::saveText($detailTrip['title']);
                    $type = 'title';

                    global $pdo;

                    $stmt = $pdo->prepare("INSERT INTO detail_trip (trip_id, type, text_id, size) VALUES (:trip_id, :type, :text_id, :size)");
                    $stmt->bindParam(':trip_id', $trip_id);
                    $stmt->bindParam(':type', $type);
                    $stmt->bindParam(':text_id', $text_id);
                    $stmt->bindParam(':size', $detailTrip['size']);
                    $stmt->execute();
                }

                if (!empty($detailTrip['story'])) {
                    $text_id = ControllerTexts::saveText($detailTrip['story']);
                    $type = 'story';

                    global $pdo;

                    $stmt = $pdo->prepare("INSERT INTO detail_trip (trip_id, type, text_id, size) VALUES (:trip_id, :type, :text_id, :size)");
                    $stmt->bindParam(':trip_id', $trip_id);
                    $stmt->bindParam(':type', $type);
                    $stmt->bindParam(':text_id', $text_id);
                    $stmt->bindParam(':size', $detailTrip['size']);
                    $stmt->execute();
                }
            }
        }

        $_SESSION['draftTrip'] = [];
    }

    public static function getTrips()
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM trip");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getTripById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM trip WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getDetailsTripById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM detail_trip WHERE trip_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}