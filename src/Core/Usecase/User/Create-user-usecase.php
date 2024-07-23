<?php
/**
 * This script handles the creation of a user.
 *
 * It checks if the request method is POST, retrieves the login and password from the POST parameters,
 * sanitizes and validates the data, hashes the password, creates a new 'User' object,
 * and sends a request to the server to create the user. If the creation is successful,
 * it sends a JSON response with a success message and the login of the new user.
 * If there is an error, it sends a JSON response with an error message.
 */
require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\User;
use App\Core\Controller\UserController;
use Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {

        header('Content-Type: application/json');

        $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


        if (empty($login) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Les champs sont requis']);
            exit();
        }

        if (strlen($login) < 3 || strlen($login) > 40) {
            echo json_encode(['success' => false, 'message' => 'Le login doit contenir entre 3 et 40 caractères']);
            exit();
        }

        if (strlen($password) < 10) {
            echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins 10 caractères']);
            exit();
        }

        if (!preg_match('/[A-Z]/', $password)) {
            echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins une majuscule']);
            exit();
        }

        if (!preg_match('/[\W]/', $password)) {
            echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins un caractère spécial']);
            exit();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = new User();
        $user->setLogin($login)
             ->setPassword($password);


        $controller = new UserController();

        try {
            $isUserExist = $controller->userExists($login);

            if ($isUserExist) {
                echo json_encode(['success' => false, 'message' => "L'utilisateur " . $user->getLogin() . ' existe déjà']);
                exit();
            }
            $createUser = $controller->createUser($user);

            echo json_encode(['success' => true, 'message' => $createUser->getLogin()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit();
    }
}
