import {
  successSnackbar,
  errorSnackbar,
  openSnackbar,
} from "../Utils/snackBar.js";
import { isNotValid, isValid } from "../Utils/checkInput.js";
import Todo from "../../../Core/Script/Utils/Models/todo-model.js";
import * as buildItemTodo from "../../../Core/Script/TodoScript/findAllTodos.js";
import { animationNewTodoStyle } from "../../../Core/Script/Utils/Styles/todoListStyle.js";
const todo = new Todo();

const handleSubmit = async (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  const newTodo = await todo.createTodo(formData);

  if (newTodo.success) {
    openSnackbar();
    successSnackbar(newTodo.message);
    closeForm();
    addTodo(newTodo.data);
  } else {
    errorSnackbar(newTodo.message);
    closeForm();
  }
};

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

const addTodo = (todo) => {
  const el = document.querySelector("#list-todo");
  const newTodo = itemTodoAdd(todo);
  el.prepend(newTodo);
  return el;
};

const showForm = () => {
  const form = document.querySelector("#container-create-todo");
  form.classList.toggle("invisible");
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
