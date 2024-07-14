<?php

namespace App\Core\Layout;

?>
<div class="flex flex-col">
  <div class="w-full">
    <p class="md:text-4xl font-bold">Todo</p>
    <ul class="flex flex-col items-center w-full">
      <li class="inline-row p-4 w-full">
        <?php require_once './Core/Layout/CreateTodo.php';?>
      </li>
      <li class="inline-row p-4 w-full">
      </li>
    </ul>
  </div>
  <div class="w-full">
    <p class="md:text-4xl font-bold w-full">Profil</p>
    <ul class="flex flex-col items-center w-full">
      <li class="inline-row p-4 w-full">
        <?php require_once './Core/Layout/UpdateUser.php';?>
      </li>
      <li class="inline-row p-4 w-full">
        <?php require_once './Core/Layout/DeleteAccount.php';?>
      </li>
    </ul>
  </div>
</div>
