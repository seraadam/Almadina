<?php
session_start();
$_SESSION['login_user']=NULL;
unset($_SESSION['login_user']);

session_destroy();
header("Location: login.php");
?>