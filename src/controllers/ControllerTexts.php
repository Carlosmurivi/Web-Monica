<?php
require_once __DIR__ . '/../../config/database.php';

class ControllerTexts
{
    protected static function secureSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function saveText($content)
    {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO text (content) VALUES (:content)");
        $stmt->bindParam(':content', $content);
        $stmt->execute();

        $text_id = $pdo->lastInsertId();

        return $text_id;
    }

    public static function getTextById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM text WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}