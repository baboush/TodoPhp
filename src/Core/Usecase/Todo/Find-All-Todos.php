<?php
/**
 * This script handles the retrieval of all 'Todo' items for a user.
 *
 * It checks if the request method is GET, retrieves the user ID from the session,
 * creates a new 'TodoController' object, and sends a request to the server to retrieve all 'Todo' items for the user.
 * If the retrieval is successful, it sends a JSON response with the 'Todo' items.
 * If there is an error, it sends a JSON response with an error message.
 */

namespace App\Core\Usecase\Todo;

require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Core\Controller\TodoController;
use Exception;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();

    header('Content-Type: application/json');
    $userId = intval($_SESSION['userId']);
    $controller = new TodoController();
    try {
        $todos = $controller->findAllTodos($userId);
        echo json_encode($todos);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
