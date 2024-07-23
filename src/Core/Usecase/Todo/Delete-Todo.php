<?php
/**
 * This script handles the deletion of a 'Todo' item.
 *
 * It checks if the request method is POST, sanitizes the input data, validates the data,
 * creates a new 'TodoController' object, and sends a request to the server to delete the 'Todo'.
 * If the deletion is successful, it sends a JSON response with a success message.
 * If there is an error, it sends a JSON response with an error message.
 */

namespace App\Core\Usecase\Todo;

use App\Core\Controller\TodoController;
use Exception;

require_once __DIR__ . '/../../../../vendor/autoload.php';
session_start();

$todoId = filter_var(intval($_POST['idTodo']), FILTER_SANITIZE_NUMBER_INT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['idTodo'])) {
        echo json_encode(["success" => true, "message" => $todoId]);
    }
    if (isset($_POST['idTodo'])) {
        $deleteTodo = new TodoController();

        try {
            $deleteTodo->removeTodoById($todoId);
            echo json_encode(["success" => true, "message" => "Todo supprimé avec succès"]);
            exit();
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
            exit();
        }
    }
}
