<?php

namespace App\config;

use PDO;
use PDOException;

class Database{
    private static $host = 'localhost';
    private static $dbname = 'superlist';
    private static $user = 'root';
    private static $pass = '';
    private static $pdo = null;

    public static function connect()
    {
        if (self::$pdo === null) { // Se ainda não há uma conexão, cria uma nova
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$user,
                    self::$pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>