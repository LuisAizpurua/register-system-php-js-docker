<?php
// Parámetros de conexión
$host = 'localhost';
$db   = 'registro_rrhh';
$user = 'root';    // Cambiar en producción
$pass = '';        // Cambiar en producción

try {
    // Crear instancia PDO con charset utf8mb4 para soportar emojis y más
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

    // Configurar PDO para lanzar excepciones ante errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Evitar emulación de sentencias preparadas para mayor seguridad
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    // En caso de error detener la ejecución con mensaje
    die("Conexión fallida a la base de datos: " . $e->getMessage());
}
