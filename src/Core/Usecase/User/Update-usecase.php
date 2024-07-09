<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['id'])) {
        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $id = intval(filter_var($_POST['id']));

        $user = new User($id, $login, $password);

        if (empty($user)) {
            die('User is empty');
        }
        $controller = new UserController();

        if (!empty($user)) {
            $controller->updateUser($user);
        } else {
            die('User does not exist');
        }
        header('Location: ../../../index.php');
        exit();
    }
}
