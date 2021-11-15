<?php
session_start();
require_once './lib/common.php';

unset($_SESSION['auth']);
setcookie('remember_login', $remember_token, 0, '/');
header("location: login.php");
?>