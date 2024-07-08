<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Core\Controller\UserController;
use App\Models\User;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $user = new User($pseudo, $password);

    if (empty($user)) {
        die('User is empty');
    } else {
        die($user->getPseudo());
    }
}
//$controller = new UserController();
//$controller->createUser($user);
