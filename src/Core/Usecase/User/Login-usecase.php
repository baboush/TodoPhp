<?php
/**
 * This script handles the login of a user.
 *
 * It checks if the request method is POST, retrieves the login and password from the POST parameters,
 * sanitizes the data, creates a new 'UserController' object, and sends a request to the server to authenticate the user.
 * If the authentication is successful, it starts a new session, sets the user ID session variable,
 * and sends a JSON response with a success message. If the authentication fails,
 * it sends a JSON response with an error message.
 */

require_once __DIR__ . '/../../../../vendor/autoload.php';

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
