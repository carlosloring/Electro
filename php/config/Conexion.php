<?php

class Conexion{
    
    private static $_DB_HOST = "192.168.64.2";
    private static $_DB_USER = "root";
    private static $_DB_PWD = "";
    private static $_DB_NAME ="tienda";
    
    
    public static function getConnection() {
        $dbh = null;
        
        try {
            $dsn = "mysql:host=".self::$_DB_HOST.";dbname=".self::$_DB_NAME.";charset=utf8";
            $dbh = new PDO($dsn, self::$_DB_USER, self::$_DB_PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        } catch (PDOException $e){
            echo $e->getMessage();
            $dbh = null;
        }
        return $dbh;
    }
    } 