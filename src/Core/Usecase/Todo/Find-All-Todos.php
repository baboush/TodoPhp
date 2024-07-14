<?php

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
