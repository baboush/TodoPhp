<?php

namespace App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once'./Core/Layout/Header.php';
require_once './Core/Layout/Navigation.php';
?>

<main id="main-content" class="opacity-0 -translateX-40 h-full flex flex-row w-full flex-wrap items-center justify-between">
  <?php require_once './Core/Layout/Snackbar.php';?>
  <div class="flex flex-row flex-wrap w-full h-full">
    <?php if(!isset($_SESSION['userId'])): ?>
    <div id="main-login" class="w-full flex flex-row">
      <?php
      include_once './Core/Layout/Login.php';
        include_once './Core/Layout/Subscription.php';
        ?>
    </div>
    <?php endif ?>
    <?php if(isset($_SESSION['userId'])): ?>
      <div class="w-full flex flex-col gap-4 p-8 md:w-3/12">
      <?php
          include_once './Core/Layout/ListAction.php';
        ?>
      </div>
      <div class="w-full flex flex-col gap-4 p-8 md:w-7/12">
        <?php
        include_once './Core/Layout/ListTodo.php';
        ?>
      </div>
      <?php endif; ?>
  </div>
</main>

<?php require_once './Core/Layout/Footer.php';
