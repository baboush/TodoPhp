<?php

namespace App;

require_once "./vendor/autoload.php";

use App\Core\Bd;

$connectionDb = Bd::getInstance();
$conn = $connectionDb->connectionDb();

require_once'./Core/Layout/Header.php';

require_once './Core/Layout/Navigation.php';
?>


  <main>
  </main>

<?php require_once './Core/Layout/Footer.php';
