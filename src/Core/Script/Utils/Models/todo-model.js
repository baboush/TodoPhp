/**
 * Class representing a 'Todo' item.
 */
export default class Todo {
  /**
   * Create a 'Todo' item.
   *
   * @param {string} id - The ID of the 'Todo' item.
   * @param {string} title - The title of the 'Todo' item.
   * @param {boolean} state - The state of the 'Todo' item.
   * @param {string} message - The message of the 'Todo' item.
   */
  constructor(id, title, state, message) {
    this.id = id;
    this.title = title;
    this.state = state;
    this.message = message;
  }

  /**
   * Send a request to the server to create a 'Todo' item.
   *
   * @param {FormData} todo - The data of the 'Todo' item to create.
   * @returns {Promise<Object>} The response from the server.
   */
  createTodo = async (todo) => {
    const response = await fetch("../../../Core/Usecase/Todo/Create-todo.php", {
      method: "POST",
      body: todo,
    });
    return response.json();
  };

  /**
   * Send a request to the server to retrieve all 'Todo' items.
   *
   * @returns {Promise<Array>} An array of 'Todo' items.
   */
  findAllTodos = async () => {
    const response = await fetch(
      "../../../Core/Usecase/Todo/Find-All-Todos.php",
    );
    const todos = await response.json();
    return todos.map(
      (todo) => new Todo(todo.id, todo.title, todo.state, todo.message),
    );
  };

  /**
   * Send a request to the server to retrieve a 'Todo' item.
   *
   * @returns {Promise<Todo>} A 'Todo' item.
   */
  findOneTodo = async () => {
    const response = await fetch(
      `../../../Core/Usecase/Todo/Find-One-Todo.php`,
    );
    const todo = await response.json();
    return new Todo(todo.id, todo.title, todo.state, todo.message);
  };

  /**
   * Send a request to the server to update the state of a 'Todo' item.
   *
   * @param {FormData} data - The data of the 'Todo' item to update.
   * @returns {Promise<Object>} The response from the server.
   */
  updateStateTodo = async (data) => {
    const response = await fetch(
      "../../../Core/Usecase/Todo/Update-State-Todo.php",
      {
        method: "POST",
        body: data,
      },
    );
    return await response.json();
  };

  /**
   * Send a request to the server to update a 'Todo' item.
   *
   * @param {FormData} data - The data of the 'Todo' item to update.
   * @returns {Promise<Object>} The response from the server.
   */
  updateTodo = async (data) => {
    const response = await fetch("../../../Core/Usecase/Todo/Update-Todo.php", {
      method: "POST",
      body: data,
    });
    return await response.json();
  };

  /**
   * Send a request to the server to delete a 'Todo' item.
   *
   * @param {FormData} data - The data of the 'Todo' item to delete.
   * @returns {Promise<Object>} The response from the server.
   */
  deleteTodoById = async (data) => {
    const response = await fetch("../../../Core/Usecase/Todo/Delete-Todo.php", {
      method: "POST",
      body: data,
    });
    return await response.json();
  };
}
