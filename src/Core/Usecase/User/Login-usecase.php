<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {

        header('Content-Type: application/json');

        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $controller = new UserController();
        $user = $controller->login($login);
        if ($user && password_verify($password, $user->getPassword())) {
            session_start();
            $_SESSION['userId'] = $user->getId();


            echo json_encode(['success' => true, 'message' => 'Connexion réussie']);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Mauvais identifiant']);
            exit();
        }
    }
}
