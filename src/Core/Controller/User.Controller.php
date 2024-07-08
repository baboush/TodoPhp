<?php

namespace App\Core\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Core\Bd;
use App\Models\User;

class UserController
{
    public function createUser(?User $user)
    {
        $sql = "INSERT INTO user (pseudo, password) VALUES (:pseudo, :password)";
        $stmt = Bd::getInstance()->prepare($sql);
        $stmt->bindParam(':pseudo', $user->getPseudo());
        $stmt->bindParam(':password', $user->getPassword());
        $stmt->execute();
    }
}
