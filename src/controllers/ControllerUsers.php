<?php
require_once __DIR__ . '/../../config/database.php';

class ControllerUsers
{
    protected static function secureSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function verifyUser($name, $password)
    {
        global $pdo;
        $password_hash = md5($password);

        $stmt = $pdo->prepare("SELECT id, name, creation_date FROM users WHERE name = :name AND password = :password");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password_hash);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : false;
    }

    public static function saveUser($user)
    {
        self::secureSession();

        $_SESSION['user'] = $user;
    }

    public static function checkLoggedInUser()
    {
        self::secureSession();

        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

    public static function logOut()
    {
        self::secureSession();

        unset($_SESSION['user']);
    }
}