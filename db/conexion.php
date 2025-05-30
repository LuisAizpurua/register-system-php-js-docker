<?php
class Conexion
{

    public function __construct() {}

    public static function Conector()
    {
        $host = 'localhost';
        $port = 3308;
        $db   = 'registro_rrhh';
        $user = 'root';    
        $pass = 'sasa';        

        try {
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $pdo;
        } catch (PDOException $e) {
            die("Conexión fallida a la base de datos: " . $e->getMessage());
        }
    }
}
