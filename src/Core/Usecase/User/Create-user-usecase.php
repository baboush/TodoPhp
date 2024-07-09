<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $id = intval($_POST['id']);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($id, $login, $password);


        if (empty($login) || empty($password)) {
            die('User is empty');
        }

        $controller = new UserController();

        $isUserExist = $controller->userExists($login);

        if ($isUserExist) {
            die('User already exists');
        }
        $controller->createUser($user);
        header('Location: ../../../index.php');
        exit();
    }
}
