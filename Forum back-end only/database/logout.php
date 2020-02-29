<?php //връща те в логин страницата

session_start();
session_unset();
session_destroy();
header("Location: ../index.php");

?>