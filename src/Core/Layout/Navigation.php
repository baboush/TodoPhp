<div id="toolbar" class="flex flex-row min-h-[10vh] p-10 bg-white drop-shadow-2xl w-full items-center justify-between">
  <div class="nav-logo">
    <a href="index.php">
      <img src="../../styles/images/logo.svg" alt="Logo" class="w-24 h-24" alt="mon super logo">
    </a>
  </div>
  <nav class="flex flex-row xl:text-2xl font-mono text-xl">
    <ul class="flex w-full gap-8">
      <?php if (isset($_SESSION['userId'])) {
          echo('
      <li><button type="submit" id="logout">Déconnexion</button></li>
      ');
      }
      ?>
      <li class="md:hidden">
        <button id="mobile-menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </li>
    </ul>
  </nav>
</div>
