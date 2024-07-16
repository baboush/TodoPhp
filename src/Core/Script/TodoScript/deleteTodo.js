import Todo from "../../../Core/Script/Utils/Models/todo-model.js";
import {
  successSnackbar,
  errorSnackbar,
} from "../../../Core/Script/Utils/snackBar.js";
import * as todoList from "../../../Core/Script/TodoScript/buildTodoList.js";

export const handledeleteTodo = async (e) => {
  const todo = new Todo();
  const formData = new FormData(e.target);

  const popup = document.querySelector("#container-delete-todo");
  e.preventDefault();
  const isDeleted = await todo.deleteTodoById(formData);
  if (!!isDeleted.success) {
    successSnackbar(isDeleted.message);
    popup.classList.toggle("invisible", "z-50");
    window.location.reload();
  } else {
    errorSnackbar(isDeleted.message);
    popup.classList.toggle("invisible", "z-50");
  }
};

export const deleteTodo = () => {
  document
    .querySelector("#form-delete-todo")
    .addEventListener("submit", handledeleteTodo);
};

export const cancelDeleteTodo = () => {
  const el = document.querySelector("#cancel-delete-todo");
  el.addEventListener("click", () => {
    const popup = document.querySelector("#form-delete-todo");
    popup.classList.toggle("invisible", "z-50");
  });
};
