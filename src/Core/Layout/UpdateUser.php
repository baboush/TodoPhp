<?php

namespace App\Core\Layout;

use App\Core\Controller\UserController;

$sessionUser = $_SESSION['userId'];
$controller = new UserController();

$user = $controller->findOneUser($sessionUser);
$login = $user->getLogin();
$password = $user->getPassword();
$id = $user->getId();
?>

<button id="toggle-update-user"
  class="bg-yellow-700 hover:bg-yellow-500
  text-white font-bold p-4 w-full
  rounded focus:shadow-outline"
>
  Mettre à jour son profil
</button>
<div id="container-update" 
  class="flex flex-row shadow-2xl justify-between
  items-center w-full md:w-1/2 p-2 absolute
  md:left-1/2 md:-translate-x-1/2
  md:min-h-96 md:max-h-[70vh] md:top-[18vh] bg-white
  h-screen invisible opacity-0"
>
  <div class="relative m-0 w-full h-full">
    <form class="w-full h-full md:text-2xl p-12 flex 
      flex-col bg-white items-center
      justify-between"
      id="form-update-user"
      action="../../Core/Usecase/User/Update-usecase.php" 
      method="post"
    >
      <div class="mb-4 w-full md:text-2xl">
        <label for="login"
          class="block text-gray-700 
          md:text-xl font-bold mb-2">
          Pseudo
        </label>
        <input
          type="text" name="login" 
          id="input-update-login"
          value="<?php echo $login;?>"
          class="shadow appearance-none border
          rounded w-full py-2 px-3 text-gray-700
          leading-tight focus:outline-none
          focus:shadow-outline"
        >
        <span id="hint-update-login"
          class="inline-flex text-red-500 
          md:text-xs italic invisible"
        >
          Le pseudo doit contenir entre 3 et 40 caaractères
        </span>
      </div>
      <div class="mb-6 w-full">
        <label for="password" 
          class="block text-gray-700 
          md:text-xl font-bold mb-2"
        >
          Mot de passe
        </label>
        <input type="password"
          name="password"
          id="input-update-password"
          class="shadow appearance-none border
          border-red rounded w-full
          py-2 px-3 text-gray-700 mb-3
          leading-tight focus:outline-none
          focus:shadow-outline"
        >
        <span id="hint-update-password"
          class="inline-flex text-red-500
          text-xs italic invisible"
        >
          Le mot de passe doit contenir au moins 10 caractères
          et une majuscule et un caractère spécial
        </span>
      </div>
      <input type="hidden" 
        name="id" 
        value="<?php echo $id;?>"
      >
      <button type="submit" 
        id="update-user"
        class="w-2/4 m-auto bg-white
        shadow-2xl rounded-md "
      >
        <svg xmlns="http://www.w3.org/2000/svg" 
          viewBox="0 0 16 16" fill="currentColor" 
          class="size-32 m-auto text-green-700
          hover:text-green-500"
        >
          <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
          />
        </svg>
      </button>
    </form>
    <button id="cancel-update-user"
      class="w-auto top-2 right-2
      rounded-md m-auto absolute"
    >
      <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 16 16" fill="currentColor"
        class="size-16 m-auto text-red-700
        hover:text-red-500"
      >
        <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
      </svg>
    </button>
  </div>
</div>
