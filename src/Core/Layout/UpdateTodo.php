<?php

namespace App\Core\Layout;

?>

<div id="container-update-todo"
  class="flex flex-row bg-white
  p-4 invisible min-w-96
  max-w-screen-sm top-[20vh]
  h-screen md:translate-x-[-50%]
  md:left-[50%] md:h-auto max-h-fit
  md:top-1/2 md:-translate-y-1/2
  w-screen flex-wrap items-center
  justify-center p-4 z-50
  shadow-md absolute left-0"
>
  <div class="relative w-full h-full">
    <form class="w-full h-full md:text-2xl p-12 flex 
      flex-col bg-white items-center"
      id="form-update-todo"
      action="../../Core/Usecase/Todo/Update-Todo.php"
      method="post"
    >
      <div class=" w-full md:text-2xl">
        <label for="title"
          class="block text-gray-700 
          md:text-xl font-bold mb-2">
          Titre
        </label>
        <input
          type="text" name="title"
          id="input-todo-title"
          class="shadow appearance-none border
          rounded w-full py-2 px-3 text-gray-700
          leading-tight focus:outline-none
          focus:shadow-outline"
        >
        <span id="hint-todo-title"
          class="inline-flex text-red-500
          md:text-xs italic invisible"
        >
          Le titre doit contenir entre 10 et 40 caaractères
        </span>
      </div>
      <div class="w-full">
        <label for="message"
          class="block text-gray-700
          md:text-xl font-bold mb-2"
        >
          Message
        </label>
        <textarea
          name="message"
          id="input-todo-message"
          class="shadow appearance-none border
          border-red rounded w-full
          py-2 px-3 text-gray-700 mb-3
          leading-tight focus:outline-none
          focus:shadow-outline"
        ></textarea>
        <span id="hint-todo-message"
          class="inline-flex text-red-500
          text-xs italic invisible"
        >
          Le message doit contenir entre 50 et 400 caractères
        </span>
      </div>
      <div class="w-full">
        <label for="date"
        class="block text-gray-700
        md:text-xl font-bold mb-2">Date</label>
        <input type="date"
          name="dateFinish"
          id="input-date"
          class="shadow appearance-none border
          border-red rounded w-full
          py-2 px-3 text-gray-700
          leading-tight focus:outline-none
          focus:shadow-outline"
        >
      </div>
      <input type="hidden"
        id="id-todo-update"
        name="idTodoUpdate"
      >
      <button type="submit"
        id="update-todo"
        class="w-2/4 m-auto md:m-8 bg-white
        shadow-2xl rounded-md "
      >
        <svg xmlns="http://www.w3.org/2000/svg" 
          viewBox="0 0 16 16" fill="currentColor"
          class="size-28 m-auto text-green-700
          hover:text-green-500"
        >
          <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
          />
        </svg>
      </button>
    </form>
    <button id="cancel-update-todo"
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
