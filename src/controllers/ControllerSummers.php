<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ControllerImages.php';
require_once __DIR__ . '/ControllerTexts.php';

class ControllerSummers
{
    protected static function secureSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function saveSummer($date, $url)
    {
        $cover_id = ControllerImages::saveImage("", $date, $url, "summer");

        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO summer (cover, date) VALUES (:cover, :date)");
        $stmt->bindParam(':cover', $cover_id);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        $summer_id = $pdo->lastInsertId();

        foreach ($_SESSION['draftSummer'] as $detailSummer) {
            if ($detailSummer['type'] === 'image') {
                $image_id = ControllerImages::saveImage($detailSummer['name'], $detailSummer['date'], $detailSummer['url'], "summer");

                global $pdo;

                $stmt = $pdo->prepare("INSERT INTO detail_summer (summer_id, type, image_id, size) VALUES (:summer_id, :type, :image_id, :size)");
                $stmt->bindParam(':summer_id', $summer_id);
                $stmt->bindParam(':type', $detailSummer['type']);
                $stmt->bindParam(':image_id', $image_id);
                $stmt->bindParam(':size', $detailSummer['size']);
                $stmt->execute();
            } elseif ($detailSummer['type'] === 'text') {
                if (!empty($detailSummer['title'])) {
                    $text_id = ControllerTexts::saveText($detailSummer['title']);
                    $type = 'title';

                    global $pdo;

                    $stmt = $pdo->prepare("INSERT INTO detail_summer (summer_id, type, text_id, size) VALUES (:summer_id, :type, :text_id, :size)");
                    $stmt->bindParam(':summer_id', $summer_id);
                    $stmt->bindParam(':type', $type);
                    $stmt->bindParam(':text_id', $text_id);
                    $stmt->bindParam(':size', $detailSummer['size']);
                    $stmt->execute();
                }

                if (!empty($detailSummer['story'])) {
                    $text_id = ControllerTexts::saveText($detailSummer['story']);
                    $type = 'story';

                    global $pdo;

                    $stmt = $pdo->prepare("INSERT INTO detail_summer (summer_id, type, text_id, size) VALUES (:summer_id, :type, :text_id, :size)");
                    $stmt->bindParam(':summer_id', $summer_id);
                    $stmt->bindParam(':type', $type);
                    $stmt->bindParam(':text_id', $text_id);
                    $stmt->bindParam(':size', $detailSummer['size']);
                    $stmt->execute();
                }
            }
        }

        $_SESSION['draftSummer'] = [];
    }

    public static function getSummers()
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM summer");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getSummerById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM summer WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getDetailsSummerById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM detail_summer WHERE summer_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}