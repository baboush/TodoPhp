<?php

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
