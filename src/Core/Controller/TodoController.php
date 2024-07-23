<?php

namespace App\Core\Controller;

use App\Core\Bd;
use App\Models\Todo;
use Exception;
use PDO;
use PDOException;

/**
 * Class TodoController
 *
 * This class is responsible for handling operations related to 'Todo' entities.
 * It provides methods to create, read, update, and delete 'Todo' entities.
 */
class TodoController
{
    /**
     * Creates a new 'Todo' entity.
     *
     * @param Todo|null $todo The 'Todo' entity to create.
     * @throws Exception If the user associated with the 'Todo' does not exist or if there is a database error.
     * @return string A JSON string representing the created 'Todo' entity.
     */
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

    /**
     * Retrieves all 'Todo' entities associated with a specific user.
     *
     * @param int $userId The ID of the user.
     * @throws Exception If there is a database error.
     * @return array An array of 'Todo' entities.
     */
    public function findAllTodos(int $userId): array
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "SELECT * FROM todo WHERE user_id = :userId ORDER By createAt DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieves a specific 'Todo' entity associated with a specific user.
     *
     * @param int $id The ID of the 'Todo' entity.
     * @param int $userId The ID of the user.
     * @throws Exception If there is a database error.
     * @return mixed The 'Todo' entity, or false if not found.
     */
    public function findOne(int $id, int $userId)
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "SELECT * FROM todo WHERE id = :id AND user_id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('userId', $userId);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Updates the state of a specific 'Todo' entity.
     *
     * @param int $id The ID of the 'Todo' entity.
     * @param int $state The new state of the 'Todo' entity.
     * @throws Exception If there is a database error.
     * @return string A JSON string indicating the success of the operation.
     */
    public function updateStateTodo(int $id, int $state)
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "UPDATE todo SET state = :state WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':state', $state);
        try {
            $stmt->execute();
            return json_encode(["success" => true, "message" => "Todo Mise à jour"]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
    * Deletes a specific 'Todo' entity.
    *
    * @param int $id The ID of the 'Todo' entity.
    * @throws Exception If there is a database error.
    * @return string A JSON string indicating the success of the operation.
    */
    public function removeTodoById(int $id)
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "DELETE FROM todo WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);


        try {
            $stmt->execute(['id' => $id]);
            return json_encode(["success" => true, "message" => "Todo supprimé"]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
    * Updates a specific 'Todo' entity.
    *
    * @param Todo|null $todo The new data for the 'Todo' entity.
    * @param int $id The ID of the 'Todo' entity to update.
    * @throws Exception If there is a database error.
    * @return Todo|null The updated 'Todo' entity, or null if not found.
    */
    public function updateTodo(?Todo $todo, int $id): ?Todo
    {
        $bd = Bd::getInstance();
        $conn = $bd->connectionDb();
        $sql = "UPDATE todo SET ";
        $params = array();

        if ($todo->getTitle() !== null && $todo->getTitle() !== '') {
            $sql .= "title = :title, ";
            $params[':title'] = $todo->getTitle();
        }

        if ($todo->getMessage() !== null && $todo->getMessage() !== '') {
            $sql .= "message = :message, ";
            $params[':message'] = $todo->getMessage();
        }


        if ($todo->getDateFinish() !== null && $todo->getDateFinish() !== '') {
            $sql .= "dateFinish = :dateFinish, ";
            $params[':dateFinish'] =  $todo->getDateFinish();
        }

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
