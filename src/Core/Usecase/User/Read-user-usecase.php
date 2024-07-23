<?php
/**
 * This script handles the retrieval of a user.
 *
 * It checks if the request method is GET, retrieves the login and password from the GET parameters,
 * sanitizes the data, creates a new 'User' object, and sends a request to the server to retrieve the user.
 * If the retrieval is successful, it starts a new session, sets the user ID session variable,
 * and sends a JSON response with the user data. If the retrieval fails,
 * it sends a JSON response with an error message.
 */
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
