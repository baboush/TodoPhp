<div class="flex flex-row p-10 bg-white drop-shadow-2xl w-full items-center justify-between">
  <div class="nav-logo">
    <a href="index.php">
      <img src="images/logo.png" alt="Logo" class="w-24 h-24">
    </a>
  </div>
  <nav class="flex flex-row xl:text-2xl font-mono text-xl">
    <ul class="flex w-full gap-8">
      <li><a href="index.php">Todo</a></li>
      <?php if (!isset($_SESSION['user'])) {
          echo('<li><a href="../../Views/login.php">Connexion</a></li>');
      } else {
          echo('<li><a href="../Core/Usecase/User/Logout-usecase.php">Dèconnexion</a></li>');
      }
      ?>
    </ul>
  </nav>
</div>
