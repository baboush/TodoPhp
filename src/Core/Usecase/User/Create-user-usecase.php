<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($login, $password);

        if (empty($user)) {
            die('User is empty');
        }

        $controller = new UserController();
        $user_exist = $controller->findOneUser($login);

        if (!empty($user_exist) && $user_exist->getLogin() == $login) {
            die('User already exist');
        }
        $controller->createUser($user);
        header('Location: ../../../index.php');
        exit();
    }
}
