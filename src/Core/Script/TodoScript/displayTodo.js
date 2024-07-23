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

/**
 * Displays the last five 'Todo' items.
 *
 * This function retrieves all 'Todo' items, limits the list to the last five items,
 * sets the title of the 'Todo' list, and builds the 'Todo' list in the DOM.
 *
 * @returns {Promise<boolean>} A promise that resolves to true when the operation is complete.
 */
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

/**
 * Displays all 'Todo' items.
 *
 * This function retrieves all 'Todo' items, sets the title of the 'Todo' list,
 * and builds the 'Todo' list in the DOM.
 *
 * @returns {Promise<boolean>} A promise that resolves to true when the operation is complete.
 */
const handleAll = async () => {
  const todoList = await todo.findAllTodos();
  titleList(`Vos ${todoList.length} tâches`);
  build.bulidTodoList(todoList);
  return true;
};

/**
 * Displays all pending 'Todo' items.
 *
 * This function retrieves all 'Todo' items, filters the list to include only pending items,
 * sets the title of the 'Todo' list, and builds the 'Todo' list in the DOM.
 *
 * @returns {Promise<boolean>} A promise that resolves to true when the operation is complete.
 */
const handlePendingList = async () => {
  const todoList = await todo.findAllTodos();
  const pendingList = todoList.filter((todo) => !todo.state);
  titleList(`Vos ${pendingList.length} tâches en attente`);
  build.bulidTodoList(pendingList);
  return true;
};

/**
 * Displays all completed 'Todo' items.
 *
 * This function retrieves all 'Todo' items, filters the list to include only completed items,
 * sets the title of the 'Todo' list, and builds the 'Todo' list in the DOM.
 *
 * @returns {Promise<boolean>} A promise that resolves to true when the operation is complete.
 */
const handleCompletedList = async () => {
  const todoList = await todo.findAllTodos();
  const completedList = todoList.filter((todo) => todo.state);
  titleList(`Vos ${completedList.length} tâches terminées`);
  build.bulidTodoList(completedList);
  return true;
};

/**
 * Sets the title of the 'Todo' list.
 *
 * @param {string} title - The title to set.
 * @returns {HTMLElement} The title element.
 */
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
