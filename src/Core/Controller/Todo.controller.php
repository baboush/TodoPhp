<?php

namespace App\Core\Controller;

use App\Core\Bd;
use App\Models\Todo;

class TodoController
{
    public function createTodo(?Todo $todo)
    {
        $sql = "INSERT INTO todo (title, description, status) VALUES (:title, :content, :state)";
        $stmt = Bd::getInstance()->prepare($sql);
        $stmt->bindParam(':title', $todo->getTitle());
        $stmt->bindParam(':description', $todo->getDescription());
        $stmt->bindParam(':state', $todo->getState());
        $stmt->execute();
    }
}
