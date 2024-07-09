<?php

use App\Core\Controller\UserController;

require_once __DIR__ . '/../../../../vendor/autoload.php';

session_start();

$user = $_SESSION['user'];

$controller = new UserController();
$controller->deleteUser($user);
session_destroy();
unset($_SESSION['user']);
header('Location: ../../../index.php');
exit();
