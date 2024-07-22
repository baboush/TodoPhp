<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['id'])) {

        header('Content-Type: application/json');

        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $id = intval(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));

        $user = new User($id, $login, $password);
        if (empty($password) && empty($login)) {
            echo json_encode(['success' => false, 'message' => 'Veuillez renseigner un champ']);
            exit();
        }


        if (strlen($login) < 3 || strlen($login) > 40 && !empty($login)) {
            echo json_encode(['success' => false, 'message' => 'Le login doit contenir entre 3 et 40 caractères']);
            exit();
        }

        if (!empty($password) && strlen($password) < 10) {
            echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins 10 caractères']);
            exit();
        }

        if (!preg_match('/[A-Z]/', $password) && !empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins une majuscule']);
            exit();
        }

        if (!preg_match('/[\W]/', $password) && !empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins un caractère spécial']);
            exit();
        }

        $controller = new UserController();

        if (!empty($user)) {
            $controller->updateUser($user);
            echo json_encode(['success' => true, 'message' => 'Le profil a bien été mis à jour']);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "L'utitisateur n'existe pas"]);
        }
    }
}
