import * as styles from "../Utils/Styles/todoListStyle.js";
import { successSnackbar } from "../Utils/snackBar.js";
import * as todo from "./deleteTodo.js";
import * as todoUpdate from "./updateTodo.js";

export const bulidTodoList = (todos) => {
  const todoList = document.querySelector("#list-todo");
  todoList.innerHTML = "";
  todos.forEach((todo) => {
    const li = itemTodo(todo);
    if (todo.state) {
      li.classList.toggle("bg-green-100");
    }
    todoList.appendChild(li);
    styles.animationEntranceTodoListStyle();
  });
};

export const itemTodo = (todo) => {
  const el = document.createElement("li");
  el.id = `item-${todo.id}`;
  styles.itemTodoStyle(el);
  el.appendChild(fieldTodo(todo));

  return el;
};

export const fieldTodo = (todo) => {
  const el = document.createElement("div");
  el.id = `field-${todo.id}`;
  styles.fieldTodoStyle(el);
  el.appendChild(headerTodo(todo));
  el.appendChild(infoTodo(todo.id, todo.message));
  el.appendChild(optionsTodo(todo.id));
  return el;
};

export const headerTodo = (todo) => {
  const el = document.createElement("div");
  styles.headerTodoStyle(el);
  el.appendChild(titleTodo(todo.title)).after(
    showInfoButton(todo.id),
    showOptionsButton(todo.id),
    formStateTodo(todo),
  );
  return el;
};

export const titleTodo = (title) => {
  const el = document.createElement("p");
  el.textContent = title;
  el.classList.add("text-lg", "font-semibold", "w-2/3");
  return el;
};

const formStateTodo = (todo) => {
  const el = document.createElement("form");
  el.method = "POST";
  el.action = "../../../Core/Usecase/Todo/Update-State-Todo.php";
  el.appendChild(labelStateTodo(todo));
  submitStateTodo(el, todo);
  return el;
};

const labelStateTodo = (todo) => {
  const el = document.createElement("label");
  el.htmlFor = `state-${todo.id}`;
  styles.labelStateTodoStyle(el);
  el.appendChild(inputStateTodo(todo));
  el.appendChild(blockToggleSlide(todo));
  el.appendChild(inputIdTodo(todo));
  return el;
};

const inputIdTodo = (todo) => {
  const el = document.createElement("input");
  el.type = "hidden";
  el.name = "id";
  el.value = todo.id;
  return el;
};

const inputStateTodo = (todo) => {
  const el = document.createElement("input");
  el.type = "checkbox";
  el.id = `state-${todo.id}`;
  el.name = "state";
  el.checked = !!todo.state;
  styles.inputStateTodo(el);
  return el;
};

const blockToggleSlide = (todo) => {
  const el = document.createElement("button");
  el.type = "submit";
  styles.blockToggleSlideStyle(el);
  return el;
};

const submitStateTodo = (el, todo) => {
  el.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const id = formData.get("id");
    const state = formData.get("state") ? 1 : 0;
    formData.set("state", !state);
    const isChecked = await todo.updateStateTodo(formData);

    if (!!isChecked.success) {
      const checkbox = document.querySelector(`#state-${todo.id}`);
      const item = document.querySelector(`#item-${todo.id}`);
      checkbox.checked = !state;
      item.classList.toggle("bg-green-100");
    }
    successSnackbar(isChecked.message);
  });
};

const infoTodo = (itemId, content) => {
  const el = document.createElement("p");
  el.textContent = content;
  el.id = `info-${itemId}`;
  styles.infoTodoStyle(el);
  return el;
};

const showInfoButton = (idItem) => {
  const el = document.createElement("button");
  el.id = `btn-show-${idItem}`;
  el.innerHTML = styles.infoIconStyle();
  el.title = "Afficher dètails";
  styles.showInfoButtonStyle(el);
  el.addEventListener("click", () => toggleShowInfo(idItem));
  return el;
};

const toggleShowInfo = (idItem) => {
  const el = document.querySelector(`#info-${idItem}`);
  if (!!el) {
    animeButtonInfoOption(el);
  }
};

const animeButtonInfoOption = (el) => {
  if (el.classList.contains("hidden")) {
    el.classList.toggle("hidden");
    styles.animationOpenTodoStyle(el);
  } else {
    styles.animationCloseTodoStyle(el);
  }
};
const showOptionsButton = (idItem) => {
  const el = document.createElement("button");
  el.id = `${idItem}-options`;
  el.innerHTML = styles.optionsIcon();
  el.title = "Afficher options";
  styles.btnEditOptionsStyle(el);
  el.addEventListener("click", () => toggleShowOptions(idItem));
  return el;
};

const optionsTodo = (idItem) => {
  const el = document.createElement("div");
  el.id = `options-${idItem}`;
  styles.optionsTodoStyle(el);
  el.appendChild(btnUpdateTodo(idItem));
  el.appendChild(btnRemoveTodo(idItem));
  return el;
};

const btnRemoveTodo = (idItem) => {
  const el = document.createElement("button");
  el.id = `${idItem}-remove`;
  el.type = "submit";
  el.textContent = "Supprimer";
  styles.btnRemoveOptionsStyle(el);
  el.addEventListener("click", () => {
    const popup = document.querySelector("#container-delete-todo");
    const id = document.querySelector("#todo-id");
    id.value = idItem;
    console.info("id", id);
    todo.deleteTodo();
    todo.cancelDeleteTodo();
    popup.classList.toggle("invisible");
  });
  return el;
};

const btnUpdateTodo = (idItem) => {
  const el = document.createElement("button");
  el.textContent = "Modifier";
  el.id = `${idItem}-update`;
  styles.btnEditOptionsStyle(el);
  el.addEventListener("click", () => {
    todoUpdate.showUpdateTodoModal(idItem);
    todoUpdate.updateTodo();
    todoUpdate.closeUpdateTodoModal();
  });
  return el;
};

const toggleShowOptions = (idItem) => {
  const el = document.querySelector(`#options-${idItem}`);
  if (!!el) {
    animeButtonInfoOption(el);
  }
};
