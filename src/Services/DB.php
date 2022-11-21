<?php

namespace App\Services;

use PDO;

class DB
{
    public static function pdo(): PDO
    {
        try {
            $dbConnectionDsnString = "mysql:host=" . MYSQL_SERVER_NAME . ";dbname=" . MYSQL_DATABASE;
            $dbConnection = new PDO($dbConnectionDsnString, MYSQL_USER, MYSQL_PASSWORD);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        } catch (\Throwable $e) {
            throw new \PDOException("Connection failed. Throwable name: '" . $e::class . "'. Message : " . $e->getMessage());
        }
    }
}