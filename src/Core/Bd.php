<?php

namespace App\Core;

use PDO;
use PDOException;

class Bd extends PDO
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $username = 'root';
        $password = 'root';
        $dbName = 'todo';
        $host = '127.0.1.0:3333';

        try {
            $this->conn = new PDO("mysql:host=$host;dbName=$dbName", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed" . $e->getMessage();
        }
    }


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Bd();
        }

        return self::$instance;
    }

    public function connectionDb()
    {
        return $this->conn;
    }
}
