<?php
/**
 * This script handles the updating of a 'Todo' item.
 *
 * It checks if the request method is POST, retrieves the user ID from the session and the 'Todo' ID, title, message, and finish date from the POST parameters,
 * sanitizes and validates the data, creates a new 'TodoController' object, and sends a request to the server to update the 'Todo'.
 * If the update is successful, it sends a JSON response with a success message.
 * If there is an error, it sends a JSON response with an error message.
 */

namespace App\Core\Usecase\Todo;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\Todo;
use App\Core\Controller\TodoController;
use Exception;
use Safe\DateTime;

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    if ($_POST['title'] == null && $_POST['message'] == null) {
        echo json_encode(["success" => false, "message" => 'Les champs sont requis']);
        exit();
    }

    $id = intval(filter_var($_POST['idTodoUpdate'], FILTER_SANITIZE_NUMBER_INT));
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $dateFinish = !empty($_POST['dateFinish']) ? new DateTime(date('Y-m-d', strtotime($_POST['dateFinish']))) : null;

    if (strlen($title) < 10 || strlen($title) > 40 && !empty($title)) {
        echo json_encode(["success" => false, "message" => 'Le titre doit être compris entre 10 et 40 caractères.']);
        exit();
    }

    if ((strlen($message) < 50 || strlen($message) > 400) && !empty($message)) {
        echo json_encode(["success" => false, "message" => 'Le message doit être compris entre 50 et 400 caractères.']);
        exit();
    }

    $controller = new TodoController();
    $todo = new Todo();

    if (!empty($title)) {
        $todo->setTitle($title);
    }

    if (!empty($message)) {
        $todo->setMessage($message);
    }

    $todo->setDateFinish($dateFinish);

    try {
        $controller->updateTodo($todo, $id);
        echo json_encode(["success" => true, "message" => "Todo mis à jour avec succès."]);
        exit();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
