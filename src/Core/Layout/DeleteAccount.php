<?php
/**
* DeleteAccount.php
* Script to delete an account
  */

namespace App\Core\Layout;

$sessionUser = intval($_SESSION['userId']);
?>

<div class="flex flex-col shadow-2xl
  items-centel p-2 fixed h-1/2
  absolute top-0  bg-white
  md:left-[50%] md:top-[50%]
  md:transform md:translate-x-[-50%] md:translate-y-[-50%]
  md:w-1/2 invisible"
 id="form-delete-user">
  <p class="md:text-2xl p-4 font-bold text-center">Confirmer la suppression</p>
  <div class="flex flex-row gap-10 flex-nowrap items-center h-full w-full justify-between">
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
