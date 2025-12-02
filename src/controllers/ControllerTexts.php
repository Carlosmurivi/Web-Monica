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
}