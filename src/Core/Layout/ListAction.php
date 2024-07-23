<?php
/**
 * This file represents the list of actions that can be performed on the application.
 * It contains links to create, update, and delete a user, as well as to create a todo.
 *
 */

namespace App\Core\Layout;

?>
<div id="list-action" class="list-action flex flex-col md:visible hidden md:block md:z-index-10 -z-index-50">
  <div class="w-full">
    <p class="item-action opacity-0 -translateX-40 md:text-4xl font-bold">Todo</p>
    <ul id="list-action" class="flex flex-col items-center w-full">
      <li class="opacity-0 -translateX-40 item-action inline-row p-4 w-full">
        <button id="toggle-create-todo"
          class="bg-green-700 hover:bg-green-500
          text-white font-bold p-4 w-full
          rounded focus:shadow-outline"
        >
          Ajoutè un Todo
        </button>

      </li>
    </ul>
  </div>
  <div class=" w-full">
    <p class="item-action opacity-0 -translateX-40 md:text-4xl font-bold w-full">Profil</p>
    <ul class="flex flex-col items-center w-full">
      <li class="item-action opacity-0 -translateX-40 inline-row p-4 w-full">
        <button id="toggle-update-user"
          class="bg-yellow-700 hover:bg-yellow-500
          text-white font-bold p-4 w-full
          rounded focus:shadow-outline"
        >
          Mettre à jour son profil
        </button>
      </li>
      <li class="item-action -translateX-40 opacity-0 inline-row p-4 w-full">
        <button id="toggle-delete-user"
          class="w-full bg-red-600 text-white
          rounded-sm p-4"
        >
          Supprimer compte
        </button>
      </li>
    </ul>
  </div>
</div>
