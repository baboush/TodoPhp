<?php

namespace App\Core\Usecase\Todo;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\Todo;
use App\Core\Controller\TodoController;
use Exception;

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    $checkValueEmpty = $_POST['title'] !== '' || $_POST['message'] !== ''  || $_POST['idTodoUpdate'] !== '';

    if (!$checkValueEmpty || $_POST['title'] == null) {
        echo json_encode(["success" => false, "message" => 'Les champs sont requis']);
        exit();
    }

    $id = intval(filter_var($_POST['idTodoUpdate'], FILTER_SANITIZE_NUMBER_INT));
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $dateFinish = !empty($_POST['dateFinish']) ? new DateTime(date('Y-m-d', strtotime($_POST['dateFinish']))) : null;

    if (strlen($title) < 10 || strlen($title) > 40) {
        echo json_encode(["success" => false, "message" => 'Le titre doit être compris entre 10 et 40 caractères.' . strlen($title)]);
        exit();
    }

    if (strlen($message) < 50 || strlen($message) > 400) {
        echo json_encode(["success" => false, "message" => 'Le message doit être compris entre 50 et 400 caractères.']);
        exit();
    }

    $controller = new TodoController();
    $todo = new Todo();

    $todo->setTitle($title)
        ->setMessage($message)
        ->setDateFinish($dateFinish);

    try {
        $controller->updateTodo($todo, $id);
        echo json_encode(["success" => true, "message" => "Todo mis à jour avec succès."]);
        exit();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
