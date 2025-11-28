<?php
require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../vendor/autoload.php';
use Cloudinary\Cloudinary;

class ControllerCloudinary
{
    protected static $cloudinary;

    public static function initialize()
    {
        global $cloud_name, $api_key, $api_secret;

        self::$cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $cloud_name,
                'api_key' => $api_key,
                'api_secret' => $api_secret,
            ],
        ]);
    }

    public static function saveImage($imageDataUri)
    {
        self::initialize();
        try {
            $result = self::$cloudinary->uploadApi()->upload($imageDataUri, [
                'folder' => 'Web Monica'
            ]);
            return $result['secure_url'];
        } catch (Exception $e) {
            return "Error al subir la imagen: " . $e->getMessage();
        }
    }
}