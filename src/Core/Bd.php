<?php

namespace App\Core;

require_once __DIR__ . '/../../vendor/autoload.php';
use PDO;
use PDOException;

class Bd
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $username = 'root';
        $password = 'root';
        $dbName = 'todo';
        $host = '127.0.0.1';
        $port = 3333;

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed" . $e->getMessage());
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
