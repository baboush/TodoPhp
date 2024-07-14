<div id="container-subscription"
  class=" flex flex-col md:w-1/2
  w-full items-center p-4"
>
  <p class="text-2xl font-bold mb-4">
    Inscription
  </p>
  <form id="form-create-user"
    action="../../Core/Usecase/User/Create-user-usecase.php"
    method="post"
  >
    <div class="mb-4">
      <label for="login"
        class="block text-gray-700
        text-sm font-bold mb-2">
        Pseudo
      </label>
      <input type="text"
        name="login"
        id="login-create"
        class="shadow appearance-none
        border rounded w-full py-2
        px-3 text-gray-700
        leading-tight
        focus:outline-none
        focus:shadow-outline"
      >
      <span id="error-login"
        class="inline-flex text-red-500
        text-xs italic invisible"
      >
        Le pseudo doit contenir entre 3 et 40 caaractères
      </span>
    </div>
    <div class="mb-6">
      <label for="password"
        class="block text-gray-700
        text-sm font-bold mb-2"
      >Mot de passe
      </label>
      <input type="password"
        name="password"
        id="password-create"
        class="shadow appearance-none
        border border-red rounded
        w-full py-2 px-3 text-gray-700
        mb-3 leading-tight focus:outline-none
        focus:shadow-outline"
      >
      <span id="error-password"
        class="inline-flex text-red-500
        text-xs italic invisible"
      >
        Le mot de passe doit contenir au moins 10 caractères
        et une majuscule et un caractère spécial
      </span>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700
        text-white font-bold py-2 px-4
        rounded focus:outline-none focus:shadow-outline"
        type="submit"
      >
        Inscription
      </button>
    </div>
  </form>
</div>
