<?php

namespace App\Core\Layout;

$_SESSION['user'] = null;
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
?>

  <div class="flex flex-col items-center md:w-1/2 p-4">
    <p class="text-2xl font-bold mb-4">Connexion</p>
    <form action="#" method="post">
      <div class="mb-4">
        <label for="login" class="block text-gray-700 text-sm font-bold mb-2">Pseudo</label>
        <input type="text" name="login" id="login " class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
        <input type="password" name="password" id="password" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Connexion
        </button>
    </form>
  </div>
