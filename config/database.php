<?php

class Database{
    private static $host = 'localhost';
    private static $dbname = 'superlist';
    private static $user = 'root';
    private static $pass = '';
    private static $pdo = null;

    public static function connect()
    {
        try{
            return new PDO("mysql:host=".self::$host.";dbname=".self::$dbname, self::$user, self::$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }catch(PDOException $e){
            die("Erro de conexão(Meu pau na sua mão): ".$e->getMessage());
        }
        return self::$pdo;
    }
}
?>