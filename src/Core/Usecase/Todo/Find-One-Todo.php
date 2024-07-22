<?php

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
