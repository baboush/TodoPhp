<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $controller = new UserController();
        $user = $controller->findOneUser($login);

        if ($user && password_verify($password, $user->getPassword())) {
            // Start the session and store user information
            session_start();
            $_SESSION['user'] = $user->getLogin();
            header('Location: ../../../index.php');
            exit();
        } else {
            echo 'Invalid login or password';
        }
    }
}
