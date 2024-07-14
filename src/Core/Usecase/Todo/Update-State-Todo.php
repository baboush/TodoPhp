<?php

namespace App\Core\Usecase\Todo;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\Todo;
use App\Core\Controller\TodoController;
use Exception;

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $userId = $_SESSION['userId'];

    if (isset($_POST['id']) && isset($_POST['state'])) {
        $id = intval(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
        $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);

        if ($state == 'true') {
            $state = 1;
            $message = json_encode(["success" => true, "message" => "Félicitation vous avez fini un todo !!!", "state" => $state]);
        } else {
            $state = 0;
            $message = json_encode(["success" => true, "message" => "Vous avez remis un todo en attente !!!", "state" => $state]);
        }

        $controller = new TodoController();
        try {
            $controller->updateStateTodo($id, $state);
            echo $message;
            exit();
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}
