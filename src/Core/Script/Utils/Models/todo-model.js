export default class Todo {
  constructor(id, title, state, message) {
    this.id = id;
    this.title = title;
    this.state = state;
    this.message = message;
  }

  createTodo = async (todo) => {
    const response = await fetch("../../../Core/Usecase/Todo/Create-todo.php", {
      method: "POST",
      body: todo,
    });
    return response.json();
  };

  findAllTodos = async () => {
    const response = await fetch(
      "../../../Core/Usecase/Todo/Find-All-Todos.php",
    );
    const todos = await response.json();
    return todos.map(
      (todo) => new Todo(todo.id, todo.title, todo.state, todo.message),
    );
  };

  findOneTodo = async (id) => {
    const response = await fetch(
      `../../../Core/Usecase/Todo/Find-One-Todo.php`,
    );
    const todo = await response.json();
    return new Todo(todo.id, todo.title, todo.state, todo.message);
  };

  updateStateTodo = async (data) => {
    const response = await fetch(
      "../../../Core/Usecase/Todo/Update-State-Todo.php",
      {
        method: "POST",
        body: data,
      },
    );
    return response.json();
  };
}
