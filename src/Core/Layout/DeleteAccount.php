<?php

namespace App\Core\Layout;

$sessionUser = $_SESSION['userId'];
?>

<button id="toggle-delete-user" class="bg-red-600 text-white rounded-sm p-4">Supprimer compte</button>
<div class="flex flex-row bg-white p-4 invisible min-w-96 max-w-screen-sm top-[20vh] h-screen md:translate-x-[-50%] md:left-[50%] md:min-h-48 md:max-h-72 w-screen flex-wrap items-center justify-center p-4 shadow-md absolute" id="form-delete-user">
  <p class="md:text-2xl p-4 font-bold">Confirmer la suppression</p>
  <div class="flex flex-row gap-10 flex-nowrap items-center  w-full justify-between">
    <form class="w-full"  action="../../Core/Usecase/User/Delete-account-usecase.php" method="post">
      <input type="hidden" name="id" value="<?php echo $sessionUser?>">
      <button type="submit" id="delete-user"  class="w-full m-auto bg-white shadow-2xl rounded-md ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-32 m-auto text-red-600">
          <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
        </svg>
      </button>
    </form>
    <button id="cancel-delete"  class="w-full bg-white shadow-2xl rounded-md m-auto">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-32 m-auto text-blue-600">
        <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
      </svg>
    </button>
  </div>
</div>
