<?php

namespace App\Core\Controller;

use App\Core\Bd;
use App\Models\Todo;
use Exception;
use PDO;
use PDOException;

class TodoController
{
    public function createTodo(?Todo $todo)
    {

        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $userSql = "SELECT * FROM user WHERE id = :userId";

        $userStmt = $conn->prepare($userSql);
        $userStmt->bindParam(':userId', $todo->getUserId());
        $userStmt->execute();

        if ($userStmt->rowCount() == 0) {
            throw new Exception("User avec l' ID $todo->getUserId() n'existe pas.");
        }

        $sql = "INSERT INTO todo (title, message, state, createAt, dateFinish, user_id) VALUES (:title, :message, :state, :createAt, :dateFinish, :userId)";

        $stmt = $conn->prepare($sql);

        try {
            $stmt->execute(
                [
                'title' => $todo->getTitle(),
                'message' => $todo->getMessage(),
                'state' => $todo->getState(),
                'createAt' => $todo->getCreateAt()->format('Y-m-d H:i:s'),
                'dateFinish' => $todo->getDateFinish() ? $todo->getDateFinish()->format('Y-m-d H:i:s') : null,
                'userId' => $todo->getUserId(),
                ]
            );
            $todoId = $conn->lastInsertId();

            $sql = "SELECT * FROM todo WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $todoId]);

            $createdTodo = $stmt->fetch(PDO::FETCH_ASSOC);

            return json_encode($createdTodo);


        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
            throw new Exception($e->getMessage());
        }
    }

    public function findAllTodos(int $userId): array
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "SELECT * FROM todo WHERE user_id = :userId ORDER By createAt DESC";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute(['userId' => $userId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function findOne(int $id, int $userId)
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "SELECT * FROM todo WHERE id = :id AND user_id = :userId";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id, 'userId' => $userId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateStateTodo(int $id, int $state)
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "UPDATE todo SET state = :state WHERE id = :id";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute(['id' => $id, 'state' => $state]);
            return json_encode(["success" => true, "message" => "Todo Mise à jour"]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function removeTodoById(int $id)
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "DELETE FROM todo WHERE id = :id";
        $stmt = $conn->prepare($sql);

        try {
            $stmt->execute(['id' => $id]);
            return json_encode(["success" => true, "message" => "Todo supprimé"]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateTodo(?Todo $todo, int $id): ?Todo
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "UPDATE todo SET ";
        $params = array();
        $sql .= "title = :title, ";
        $params[':title'] = $todo->getTitle();
        $sql .= "message = :message, ";
        $params[':message'] = $todo->getMessage();
        $sql .= "dateFinish = :dateFinish, ";
        $params[':dateFinish'] =  $todo->getDateFinish();

        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id = :id";
        $params[':id'] = $id;

        $stmt = $conn->prepare($sql);
        foreach ($params as $key => &$val) {
            $stmt->bindValue($key, $val);
        }
        try {
            $stmt->execute();
            return $todo;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
