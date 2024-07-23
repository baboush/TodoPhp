import Todo from "../../../Core/Script/Utils/Models/todo-model.js";
import {
  successSnackbar,
  errorSnackbar,
} from "../../../Core/Script/Utils/snackBar.js";
import { bulidTodoList } from "../../../Core/Script/TodoScript/buildTodoList.js";

/**
 * Handles the submission of the 'Todo' deletion form.
 *
 * This function prevents the default form submission, creates a new 'Todo' object,
 * and sends a request to the server to delete the 'Todo'. If the deletion is successful,
 * it removes the 'Todo' from the DOM and shows a success message. If there is an error,
 * it shows an error message.
 *
 * @param {Event} e - The form submission event.
 * @returns {Promise<void>} A promise that resolves when the operation is complete.
 */
export const handledeleteTodo = async (e) => {
  const todo = new Todo();
  const formData = new FormData(e.target);

  const popup = document.querySelector("#container-delete-todo");
  e.preventDefault();
  const isDeleted = await todo.deleteTodoById(formData);

  const todoList = await todo.findAllTodos();
  if (!!isDeleted.success) {
    successSnackbar(isDeleted.message);
    popup.classList.toggle("invisible", "z-50");
    bulidTodoList(todoList);
  } else {
    errorSnackbar(isDeleted.message);
    popup.classList.toggle("invisible", "z-50");
  }
};

/**
 * Adds an event listener to the 'Todo' deletion form.
 *
 * This function adds a 'submit' event listener to the 'Todo' deletion form,
 * which calls the `handledeleteTodo` function when the form is submitted.
 */
export const deleteTodo = () => {
  document
    .querySelector("#form-delete-todo")
    .addEventListener("submit", handledeleteTodo);
};

/**
 * Adds an event listener to the 'Cancel' button of the 'Todo' deletion form.
 *
 * This function adds a 'click' event listener to the 'Cancel' button of the 'Todo' deletion form,
 * which hides the form when the button is clicked.
 */
export const cancelDeleteTodo = () => {
  const el = document.querySelector("#cancel-delete-todo");
  el.addEventListener("click", () => {
    const popup = document.querySelector("#container-delete-todo");
    if (!popup.classList.contains("invisible")) {
      popup.classList.toggle("invisible");
    }
  });
};
