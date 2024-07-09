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

    public function findOneUser(?int $id): ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user === false) {
                return null;
            }
            return new User($user['id'], $user['login'], $user['passwd']);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUser(?string $user)
    {
        $sql = "DELETE FROM user WHERE login = :login";
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':login', $user);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUser(?User $user): ?User
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();

        $sql = "UPDATE user SET ";
        $params = array();

        if ($user->getLogin() !== null && strlen($user->getLogin()) > 4 && $user->getLogin() !== '') {
            $sql .= "login = :login, ";
            $params[':login'] = $user->getLogin();
        } else {
            echo "Login must be at least 4 characters long";
        }

        if ($user->getPassword() !== null && $user->getPassword() != '') {
            if (strlen($user->getPassword()) > 10) {
                $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $sql .= "passwd = :password, ";
                $params[':password'] = $hashedPassword;
            } else {
                die('error: password must be at least 10 characters long');
            }
        }

        $sql = rtrim($sql, ', ');

        $sql .= " WHERE id = :id";
        $params[':id'] = $user->getId();

        $stmt = $conn->prepare($sql);

        foreach ($params as $key => &$val) {
            $stmt->bindValue($key, $val);
        }

        try {
            $stmt->execute();
            if ($user->getLogin() !== null) {
                $_SESSION['user'] = $user->getLogin();
            }

            return $user;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function login(?string $login)
    {

        $sql = "SELECT * FROM user WHERE login = :login";
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':login', $login);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user === false) {
                return null;
            }
            return new User($user['id'], $user['login'], $user['passwd']);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage;
        }
    }
}
