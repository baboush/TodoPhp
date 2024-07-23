import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../Utils/snackBar.js";
import { isNotValid, isValid } from "../Utils/checkInput.js";
import Todo from "../../../Core/Script/Utils/Models/todo-model.js";
import * as buildItemTodo from "../../../Core/Script/TodoScript/buildTodoList.js";
import { animationNewTodoStyle } from "../../../Core/Script/Utils/Styles/todoListStyle.js";

/**
 * Handles the submission of the 'Todo' creation form.
 *
 * This function prevents the default form submission, creates a new 'Todo' object,
 * and sends a request to the server to create the 'Todo'. If the creation is successful,
 * it adds the new 'Todo' to the DOM and shows a success message. If there is an error,
 * it shows an error message.
 *
 * @param {Event} event - The form submission event.
 * @returns {Promise<boolean>} A promise that resolves to true if the 'Todo' was created successfully.
 */
const handleSubmit = async (event) => {
  event.preventDefault();

  const todo = new Todo();
  const formData = new FormData(event.target);

  const newTodo = await todo.createTodo(formData);

  if (newTodo.success) {
    openSnackbar();
    successSnackbar(newTodo.message);
    closeForm();
    addTodo(newTodo.data);
    return true;
  } else {
    errorSnackbar(newTodo.message);
    closeForm();
  }
};

/**
 * Creates a 'Todo' item and adds it to the DOM.
 *
 * This function parses the 'Todo' data from JSON, creates a new 'Todo' object,
 * builds a 'Todo' item element, and adds it to the DOM with an animation.
 *
 * @param {string} todo - The JSON string of a 'Todo' object.
 * @returns {HTMLElement} The 'Todo' item element.
 */
const itemTodoAdd = (todo) => {
  const todoJson = JSON.parse(todo);
  const createTodo = new Todo(
    todoJson.id,
    todoJson.title,
    todoJson.state,
    todoJson.message,
  );

  const item = buildItemTodo.itemTodo(createTodo);
  animationNewTodoStyle(item);

  return item;
};

/**
 * Adds a 'Todo' item to the DOM.
 *
 * This function sends a request to the server to get all 'Todo' items, creates a new 'Todo' item,
 * and adds it to the DOM. If there are more than 5 'Todo' items, it removes the last one.
 *
 * @param {Object} todoItem - The 'Todo' object to add.
 * @returns {Promise<HTMLElement>} A promise that resolves to the 'Todo' list element.
 */
const addTodo = async (todoItem) => {
  const todo = new Todo();
  const todoList = await todo.findAllTodos();

  const el = document.querySelector("#list-todo");
  const newTodo = itemTodoAdd(todoItem);
  if (todoList.length > 5) {
    el.removeChild(el.lastChild);
    el.prepend(newTodo);
  } else {
    el.prepend(newTodo);
  }
  return el;
};

/**
 * Shows the 'Todo' creation form.
 *
 * This function toggles the visibility of the 'Todo' creation form and animates it.
 */
const showForm = () => {
  const form = document.querySelector("#container-create-todo");
  form.classList.toggle("invisible");
  form.classList.toggle("opacity-1");
  form.classList.toggle("z-50");
  anime({
    targets: form,
    keyframes: [
      { opacity: 0, zoom: 0 },
      { opacity: 1, zoom: 1, zIndex: 10 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
  });
};

/**
 * Closes the 'Todo' creation form.
 *
 * This function animates the 'Todo' creation form and then hides it.
 */
const closeForm = () => {
  const form = document.querySelector("#container-create-todo");
  anime({
    targets: form,
    keyframes: [
      { opacity: 1, zoom: 1 },
      { opacity: 0, zoom: 0, zIndex: -10 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
  });
  setTimeout(() => {
    form.classList.toggle("invisible");
  }, 200);
};

document.querySelector("#input-todo-title").addEventListener("input", (e) => {
  if (e.target.value.length < 10 || e.target.value.length > 40)
    isNotValid(e.target, document.querySelector("#hint-todo-title"));
  else isValid(e.target, document.querySelector("#hint-todo-title"));
});

document.querySelector("#input-todo-message").addEventListener("input", (e) => {
  if (e.target.value.length < 50 || e.target.value.length > 400)
    isNotValid(e.target, document.querySelector("#hint-todo-message"));
  else isValid(e.target, document.querySelector("#hint-todo-message"));
});

document
  .querySelector("#form-create-todo")
  .addEventListener("submit", handleSubmit);

document
  .querySelector("#toggle-create-todo")
  .addEventListener("click", showForm);

document
  .querySelector("#cancel-create-todo")
  .addEventListener("click", closeForm);
