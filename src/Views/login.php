<?php

namespace App\Views;

require_once'../Core/Layout/Header.php';
require_once '../Core/Layout/Navigation.php';
?>

<main class="h-full">
  <?php require_once '../Core/Layout/Login.php'; ?>
  <?php require_once '../Core/Layout/Subscription.php'; ?>
</main>

<?php require_once '../Core/Layout/Footer.php';
