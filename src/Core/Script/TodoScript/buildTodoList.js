import * as styles from "../Utils/Styles/todoListStyle.js";
import { successSnackbar } from "../Utils/snackBar.js";
import * as todo from "./deleteTodo.js";
import * as todoUpdate from "./updateTodo.js";

/**
 * Builds a list of 'Todo' items and appends them to the DOM.
 *
 * @param {Array} todos - An array of 'Todo' objects.
 */
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

/**
 * Creates a list item for a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A list item element representing the 'Todo' object.
 */
export const itemTodo = (todo) => {
  const el = document.createElement("li");
  el.id = `item-${todo.id}`;
  styles.itemTodoStyle(el);
  el.appendChild(fieldTodo(todo));

  return el;
};

/**
 * Creates a div for a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A div element representing the 'Todo' object.
 */
export const fieldTodo = (todo) => {
  const el = document.createElement("div");
  el.id = `field-${todo.id}`;
  styles.fieldTodoStyle(el);
  el.appendChild(headerTodo(todo));
  el.appendChild(infoTodo(todo.id, todo.message));
  el.appendChild(optionsTodo(todo.id));
  return el;
};

/**
 * Creates a header for a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A div element representing the header of the 'Todo' object.
 */
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

/**
 * Creates a title for a 'Todo' object and returns it.
 *
 * @param {string} title - The title of a 'Todo' object.
 * @returns {HTMLElement} A paragraph element representing the title of the 'Todo' object.
 */
export const titleTodo = (title) => {
  const el = document.createElement("p");
  el.textContent = title;
  el.classList.add("text-lg", "font-semibold", "break-all", "w-2/3");
  return el;
};

/**
 * Creates a form for updating the state of a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A form element for updating the state of the 'Todo' object.
 */
const formStateTodo = (todo) => {
  const el = document.createElement("form");
  el.method = "POST";
  el.action = "../../../Core/Usecase/Todo/Update-State-Todo.php";
  el.appendChild(labelStateTodo(todo));
  submitStateTodo(el, todo);
  return el;
};

/**
 * Creates a label for the state of a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A label element for the state of the 'Todo' object.
 */
const labelStateTodo = (todo) => {
  const el = document.createElement("label");
  el.htmlFor = `state-${todo.id}`;
  styles.labelStateTodoStyle(el);
  el.appendChild(inputStateTodo(todo));
  el.appendChild(blockToggleSlide(todo));
  el.appendChild(inputIdTodo(todo));
  return el;
};

/**
 * Creates a hidden input for the ID of a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A hidden input element for the ID of the 'Todo' object.
 */
const inputIdTodo = (todo) => {
  const el = document.createElement("input");
  el.type = "hidden";
  el.name = "id";
  el.value = todo.id;
  return el;
};

/**
 * Creates a checkbox input for the state of a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A checkbox input element for the state of the 'Todo' object.
 */
const inputStateTodo = (todo) => {
  const el = document.createElement("input");
  el.type = "checkbox";
  el.id = `state-${todo.id}`;
  el.name = "state";
  el.checked = !!todo.state;
  styles.inputStateTodo(el);
  return el;
};

/**
 * Creates a button for toggling the state of a 'Todo' object and returns it.
 *
 * @param {Object} todo - A 'Todo' object.
 * @returns {HTMLElement} A button element for toggling the state of the 'Todo' object.
 */
const blockToggleSlide = (todo) => {
  const el = document.createElement("button");
  el.type = "submit";
  styles.blockToggleSlideStyle(el);
  return el;
};

/**
 * Adds an event listener to a form for submitting the updated state of a 'Todo' object.
 *
 * @param {HTMLElement} el - A form element.
 * @param {Object} todo - A 'Todo' object.
 */
const submitStateTodo = (el, todo) => {
  el.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
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

/**
 * Creates an info paragraph for a 'Todo' object and returns it.
 *
 * @param {string} itemId - The ID of a 'Todo' object.
 * @param {string} content - The content of the info paragraph.
 * @returns {HTMLElement} A paragraph element representing the info of the 'Todo' object.
 */
const infoTodo = (itemId, content) => {
  const el = document.createElement("p");
  el.textContent = content;
  el.id = `info-${itemId}`;
  styles.infoTodoStyle(el);
  return el;
};

/**
 * Creates a button for showing the info of a 'Todo' object and returns it.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 * @returns {HTMLElement} A button element for showing the info of the 'Todo' object.
 */
const showInfoButton = (idItem) => {
  const el = document.createElement("button");
  el.id = `btn-show-${idItem}`;
  el.innerHTML = styles.infoIconStyle();
  el.title = "Afficher dètails";
  styles.showInfoButtonStyle(el);
  el.addEventListener("click", () => toggleShowInfo(idItem));
  return el;
};

/**
 * Toggles the visibility of the info of a 'Todo' object.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 */
const toggleShowInfo = (idItem) => {
  const el = document.querySelector(`#info-${idItem}`);
  if (!!el) {
    animeButtonInfoOption(el);
  }
};

/**
 * Animates the info of a 'Todo' object when it is shown or hidden.
 *
 * @param {HTMLElement} el - An element representing the info of a 'Todo' object.
 */
const animeButtonInfoOption = (el) => {
  if (el.classList.contains("hidden")) {
    el.classList.toggle("hidden");
    styles.animationOpenTodoStyle(el);
  } else {
    styles.animationCloseTodoStyle(el);
  }
};

/**
 * Creates a button for showing the options of a 'Todo' object and returns it.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 * @returns {HTMLElement} A button element for showing the options of the 'Todo' object.
 */
const showOptionsButton = (idItem) => {
  const el = document.createElement("button");
  el.id = `${idItem}-options`;
  el.innerHTML = styles.optionsIcon();
  el.title = "Afficher options";
  styles.btnEditOptionsStyle(el);
  el.addEventListener("click", () => toggleShowOptions(idItem));
  return el;
};

/**
 * Creates a div for the options of a 'Todo' object and returns it.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 * @returns {HTMLElement} A div element representing the options of the 'Todo' object.
 */
const optionsTodo = (idItem) => {
  const el = document.createElement("div");
  el.id = `options-${idItem}`;
  styles.optionsTodoStyle(el);
  el.appendChild(btnUpdateTodo(idItem));
  el.appendChild(btnRemoveTodo(idItem));
  return el;
};

/**
 * Creates a button for removing a 'Todo' object and returns it.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 * @returns {HTMLElement} A button element for removing the 'Todo' object.
 */
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

/**
 * Creates a button for updating a 'Todo' object and returns it.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 * @returns {HTMLElement} A button element for updating the 'Todo' object.
 */
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

/**
 * Toggles the visibility of the options of a 'Todo' object.
 *
 * @param {string} idItem - The ID of a 'Todo' object.
 */
const toggleShowOptions = (idItem) => {
  const el = document.querySelector(`#options-${idItem}`);
  if (!!el) {
    animeButtonInfoOption(el);
  }
};
