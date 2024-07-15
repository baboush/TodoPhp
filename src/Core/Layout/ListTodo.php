<?php

namespace App\Core\Layout;

?>

<div class="block p-4">
  <h2>Todo List</h2>
  <div class="flex flex-row gap-5 m-4" id="list-todo-action">
    <button id="toggle-five-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-4 w-full
      rounded focus:shadow-outline">
      Default
    </button>
    <button id="toggle-all-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-4 w-full
      rounded focus:shadow-outline">
      List
    </button>
    <button id="toggle-pending-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-4 w-full
      rounded focus:shadow-outline">
      En cours
    </button>
    <button id="toggle-done-todo"
      class="bg-blue-400 hover:bg-blue-700
      text-white font-bold p-4 w-full
      rounded focus:shadow-outline">
      Fini</button>
  </div>

  <h2 class="text-center p-4 m-2 text-base font-black md:text-2xl" id="title-todo-list"></h2>
  <ul class="flex flex-col" id="list-todo">
  </ul>
</div>
