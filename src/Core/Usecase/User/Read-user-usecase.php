<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Core\Controller\UserController;
use App\Models\User;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pseudo = filter_var($_GET['pseudo'], FILTER_SANITIZE_STRING);
    $password = filter_var($_GET['password'], FILTER_SANITIZE_STRING);
    $user = new User($pseudo, $password);

    $controller = new UserController();
    $controller->findOneUser($user);

    $userId = $user->getId();
    $_SESSION['userId'] = $userId;
}
