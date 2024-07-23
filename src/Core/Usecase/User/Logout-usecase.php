<?php
/**
* This script handles the logout of a user.
*/
session_start();
session_destroy();
unset($_SESSION['user']);
exit();
