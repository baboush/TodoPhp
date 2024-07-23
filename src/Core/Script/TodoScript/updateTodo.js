import Todo from "../../../Core/Script/Utils/Models/todo-model.js";
import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../../../Core/Script/Utils/snackBar.js";
import { bulidTodoList } from "../../../Core/Script/TodoScript/buildTodoList.js";

/**
 * Shows the 'Todo' update modal.
 *
 * This function takes the ID of a 'Todo' item, sets the value of the hidden input in the update form,
 * and toggles the visibility of the update modal.
 *
 * @param {string} idTodo - The ID of the 'Todo' item.
 */
export const showUpdateTodoModal = (idTodo) => {
  const el = document.querySelector("#container-update-todo");
  const input = document.querySelector("#id-todo-update");
  input.value = idTodo;
  el.classList.toggle("invisible");
};

/**
 * Closes the 'Todo' update modal.
 *
 * This function adds a 'click' event listener to the 'Cancel' button of the update modal,
 * which hides the modal when the button is clicked.
 */
export const closeUpdateTodoModal = () => {
  const cancel = document.querySelector("#cancel-update-todo");

  cancel.addEventListener("click", () => {
    const el = document.querySelector("#container-update-todo");
    if (!el.classList.contains("invisible")) {
      el.classList.toggle("invisible");
    }
  });
};

/**
 * Handles the submission of the 'Todo' update form.
 *
 * This function prevents the default form submission, creates a new 'Todo' object,
 * sends a request to the server to update the 'Todo', and handles the response.
 * If the update is successful, it hides the update modal, rebuilds the 'Todo' list in the DOM,
 * and shows a success message. If there is an error, it hides the update modal and shows an error message.
 *
 * @param {Event} e - The form submission event.
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
export const handleUpdateTodo = async (e) => {
  e.preventDefault();
  const data = new FormData(e.target);
  const todo = new Todo();
  const response = await todo.updateTodo(data);
  const el = document.querySelector("#container-update-todo");
  openSnackbar();
  const todoList = await todo.findAllTodos();
  if (!!response.success) {
    el.classList.toggle("invisible");
    bulidTodoList(todoList);
    successSnackbar(response.message);
  } else {
    el.classList.toggle("invisible");
    errorSnackbar(response.message);
  }
};

/**
 * Adds an event listener to the 'Todo' update form.
 *
 * This function adds a 'submit' event listener to the 'Todo' update form,
 * which calls the `handleUpdateTodo` function when the form is submitted.
 */
export const updateTodo = () => {
  const el = document.querySelector("#form-update-todo");
  el.addEventListener("submit", handleUpdateTodo);
};
