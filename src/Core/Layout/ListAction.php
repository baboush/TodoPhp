<?php

namespace App\Core\Layout;

?>
<div class="list-action flex flex-col">
  <div class="w-full">
    <p class="item-action opacity-0 -translateX-40 md:text-4xl font-bold">Todo</p>
    <ul id="list-action" class="flex flex-col items-center w-full">
      <li class="opacity-0 -translateX-40 item-action inline-row p-4 w-full">
        <?php require_once './Core/Layout/CreateTodo.php';?>
      </li>
      <li class="inline-row p-4 w-full">
      </li>
    </ul>
  </div>
  <div class=" w-full">
    <p class="item-action opacity-0 -translateX-40 md:text-4xl font-bold w-full">Profil</p>
    <ul class="flex flex-col items-center w-full">
      <li class="item-action opacity-0 -translateX-40 inline-row p-4 w-full">
        <?php require_once './Core/Layout/UpdateUser.php';?>
      </li>
      <li class="item-action -translateX-40 opacity-0 inline-row p-4 w-full">
        <?php require_once './Core/Layout/DeleteAccount.php';?>
      </li>
    </ul>
  </div>
</div>
