<?php
session_start();

// unset($_COOKIE);
setcookie('user', '', time() - 3600);
unset($_SESSION['user']);
session_destroy();
header('location:/web/welcome.php');