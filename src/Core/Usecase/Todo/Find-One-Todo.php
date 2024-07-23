<?php
/**
 * This script handles the retrieval of a specific 'Todo' item for a user.
 *
 * It checks if the request method is GET, retrieves the user ID from the session and the 'Todo' ID from the GET parameters,
 * creates a new 'TodoController' object, and sends a request to the server to retrieve the 'Todo' item.
 * If the retrieval is successful, it sends a JSON response with the 'Todo' item.
 * If there is an error, it sends a JSON response with an error message.
 */

namespace App\Core\Usecase\Todo;

require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Core\Controller\TodoController;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json');
    session_start();
    $id = $_GET['id'];
    $userId = $_SESSION['userId'];
    $controller = new TodoController();
    $todo = $controller->findOne($id, $userId);
    if ($todo) {
        echo json_encode(["success" => true, "data" => $todo]);
    } else {
        echo json_encode(["success" => false, "message" => 'Aucun todo trouvé']);
    }
}
