<?php
/**
 * This file represents the list of todos that can be performed on the application.
 * It contains a list of todos, and links to delete and update a todo.
 *
 */

namespace App\Core\Layout;

?>

<div class="block p-4">
<?php require_once './Core/Layout/DeleteTodo.php' ?>
<?php require_once './Core/Layout/UpdateTodo.php' ?>
  <h2>Todo List</h2>
  <div class="flex md:flex-row md:flex-nowrap flex-wrap gap-5 m-4" id="list-todo-action">
    <button id="toggle-five-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-2 w-full
      opacity-0 -translate-Y-40
      rounded focus:shadow-outline">
      Default
    </button>
    <button id="toggle-all-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-2 w-full
      opacity-0 translate-Y-40
      rounded focus:shadow-outline">
      List
    </button>
    <button id="toggle-pending-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-2 w-full
      opacity-0 -translate-Y-40
      rounded focus:shadow-outline">
      En cours
    </button>
    <button id="toggle-done-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-2 w-full
      opacity-0 translate-Y-40
      rounded focus:shadow-outline">
      Fini</button>
  </div>

  <h2 class="text-center p-4 m-2 text-base font-black md:text-2xl" id="title-todo-list"></h2>
  <ul class="flex flex-col" id="list-todo">
  </ul>
</div>
