<?php

namespace App\Core\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Core\Bd;
use App\Models\User;
use PDO;
use PDOException;

class UserController
{
    public function createUser(?User $user)
    {
        $sql = "INSERT INTO user (login, passwd) VALUES (:login, :password)";
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':login', $user->getLogin());
        $stmt->bindParam(':password', $user->getPassword());

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function findOneUser(?string $user): User
    {
        $sql = "SELECT * FROM user WHERE login = :login";
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':login', $user);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($user['login'], $user['passwd']);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
