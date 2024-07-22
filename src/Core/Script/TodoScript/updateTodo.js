import Todo from "../../../Core/Script/Utils/Models/todo-model.js";
import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../../../Core/Script/Utils/snackBar.js";
import { bulidTodoList } from "../../../Core/Script/TodoScript/buildTodoList.js";

export const showUpdateTodoModal = (idTodo) => {
  const el = document.querySelector("#container-update-todo");
  const input = document.querySelector("#id-todo-update");
  input.value = idTodo;
  el.classList.toggle("invisible");
};

export const closeUpdateTodoModal = () => {
  const cancel = document.querySelector("#cancel-update-todo");

  cancel.addEventListener("click", () => {
    const el = document.querySelector("#container-update-todo");
    if (!el.classList.contains("invisible")) {
      el.classList.toggle("invisible");
    }
  });
};

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

export const updateTodo = () => {
  const el = document.querySelector("#form-update-todo");
  el.addEventListener("submit", handleUpdateTodo);
};
