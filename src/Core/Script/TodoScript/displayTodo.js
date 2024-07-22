import Todo from "../Utils/Models/todo-model.js";
import * as build from "./buildTodoList.js";

const todo = new Todo();

const action = document.querySelectorAll("#list-todo-action>button");

action.forEach((el) => {
  el.addEventListener("click", (e) => {
    e.preventDefault();
    displayTodo(e.target.id);
  });
});

const titleList = (title) => {
  const el = document.querySelector("#title-todo-list");
  el.innerHTML = title;
  return el;
};

const handleDefaultList = async () => {
  const todoList = await todo.findAllTodos();
  if (todoList.length > 5) {
    todoList.length = 5;
  }
  titleList(`Vos ${todoList.length} dernières tâches`);
  todoList.length = 5;
  build.bulidTodoList(todoList);
  return true;
};

const handleAll = async () => {
  const todoList = await todo.findAllTodos();
  titleList(`Vos ${todoList.length} tâches`);
  build.bulidTodoList(todoList);
  return true;
};

const handlePendingList = async () => {
  const todoList = await todo.findAllTodos();
  const pendingList = todoList.filter((todo) => !todo.state);
  titleList(`Vos ${pendingList.length} tâches en attente`);
  build.bulidTodoList(pendingList);
  return true;
};

const handleCompletedList = async () => {
  const todoList = await todo.findAllTodos();
  const completedList = todoList.filter((todo) => todo.state);
  titleList(`Vos ${completedList.length} tâches terminées`);
  build.bulidTodoList(completedList);
  return true;
};

const displayTodo = (action) => {
  switch (action) {
    case "toggle-five-todo":
      handleDefaultList();
      break;
    case "toggle-all-todo":
      handleAll();
      break;
    case "toggle-pending-todo":
      handlePendingList();
      break;
    case "toggle-done-todo":
      handleCompletedList();
      break;
    default:
      handleDefaultList();
      break;
  }
};

displayTodo("toggle-five-todo");
