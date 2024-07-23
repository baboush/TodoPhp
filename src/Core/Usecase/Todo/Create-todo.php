<?php
/**
 * This script handles the creation of a 'Todo' item.
 *
 * It checks if the request method is POST, sanitizes the input data, validates the data,
 * creates a new 'Todo' object, and sends a request to the server to create the 'Todo'.
 * If the creation is successful, it sends a JSON response with the new 'Todo' item.
 * If there is an error, it sends a JSON response with an error message.
 */

namespace App\Core\Usecase\Todo;

require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Core\Controller\TodoController;
use App\Models\Todo;
use DateTime;
use Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    $checkValueEmpty = $_POST['title'] !== '' || $_POST['message'] !== ''  || $_POST['id'] !== '';

    if (!$checkValueEmpty || $_POST['title'] == null) {
        echo json_encode(["success" => false, "message" => 'Les champs sont requis']);
        exit();
    }

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $createAt = $_POST['createAt'];
    $userId = intval(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $dateFinish = !empty($_POST['dateFinish']) ? new DateTime(date('Y-m-d', strtotime($_POST['dateFinish']))) : null;

    if (strlen($title) < 10 || strlen($title) > 40) {
        echo json_encode(["success" => false, "message" => 'Le titre doit être compris entre 10 et 40 caractères.' . strlen($title)]);
        exit();
    }

    if (strlen($message) < 50 || strlen($message) > 400) {
        echo json_encode(["success" => false, "message" => 'Le message doit être compris entre 50 et 400 caractères.']);
        exit();
    }

    $todo = new Todo();
    $todo->setUserId($userId)
        ->setTitle($title)
        ->setMessage($message)
        ->setDateFinish($dateFinish);

    $controller = new TodoController();
    try {
        $newTodo = $controller->createTodo($todo);
        echo json_encode(["success" => true, "message" => $todo->getTitle() . ' a èté ajouté a votre liste.', "data" => $newTodo]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
        exit();
    }
}
