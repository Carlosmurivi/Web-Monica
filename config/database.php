<?php
require_once '../env.php';

try {
    global $host, $port, $nombre_bd, $usuario_bd, $pass_bd, $endpoint;
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$nombre_bd;sslmode=require;options=endpoint=$endpoint";
    $pdo = new PDO($dsn, $usuario_bd, $pass_bd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}