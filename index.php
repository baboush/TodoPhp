<?php

namespace App;

require_once "./vendor/autoload.php";

use App\Core\Bd;

$connectionDb = Bd::getInstance();
$conn = $connectionDb->connectionDb();
?>

<!DOCTYPE html>
<html>

<head>
  <title>My Website</title>
</head>

<body>
  <main>
    <h1>Welcome to my website!</h1>
    <p>This is some text on my website.</p>
  </main>
</body>

</html>
