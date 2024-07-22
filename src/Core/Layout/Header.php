<?php

namespace App\Core\Layout;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ma super Todo Responsive en php et javascript natif">
    <link rel="stylesheet" href="../../styles/global.css"></link>
    <link rel="icon" type="image/png" href="../../styles/images/favicon.png"></link>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <?php if (!isset($_SESSION['userId'])): ?>
      <script type="module" src="../../Core/Script/UserScript/createUser.js" defer></script>
      <script type="module" src="../../Core/Script/UserScript/loginUser.js" defer></script>
    <?php endif; ?>


    <?php if (isset($_SESSION['userId'])): ?>
      <script type="module" src="../../Core/Script/UserScript/deleteUser.js" defer></script>
      <script type="module" src="../../Core/Script/UserScript/updateUser.js" defer></script>
      <script type="module" src="../../Core/Script/TodoScript/createTodo.js" defer></script>
      <script type="module" src="../../Core/Script/TodoScript/displayTodo.js" defer></script>
      <script type="module" src="../../Core/Script/TodoScript/buildTodoList.js" defer></script>
    <?php endif; ?>

    <script type="module" src="../../Core/Script/Utils/animationRoute.js" defer></script>
    <script type="module" src="../../Core/Script/Utils/animationComponent.js" defer></script>
    <script type="module" src="../../Core/Script/Utils/toggleMenuMobile.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js" integrity="sha512-aNMyYYxdIxIaot0Y1/PLuEu3eipGCmsEUBrUq+7aVyPGMFH8z0eTP0tkqAvv34fzN6z+201d3T8HPb1svWSKHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Ma Super TODO</title>
  </head>
  <body>
