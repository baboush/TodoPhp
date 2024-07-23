<?php
/**
 * This script handles the deletion of a user account.
 *
 * It checks if the request method is POST, retrieves the user ID from the POST parameters,
 * sanitizes and validates the data, creates a new 'UserController' object, and sends a request to the server to delete the user.
 * If the deletion is successful, it destroys the session, unsets the user ID session variable,
 * and sends a JSON response with a success message and the ID of the deleted user.
 * If there is an error, it sends a JSON response with an error message.
 */

namespace App\Core\Usecase\User;

use App\Core\Controller\UserController;
use Exception;

require_once __DIR__ . '/../../../../vendor/autoload.php';

session_start();


$controller = new UserController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        header('Content-Type: application/json');
        try {
            $user = intval(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
            $controller->deleteUser($user);
            session_destroy();
            unset($_SESSION['userId']);
            echo json_encode(["success" => true, "message" => "Votre compte a bien été supprimé", "id" => $user]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit();
    }
}
