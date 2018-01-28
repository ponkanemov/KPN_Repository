<?php

session_start();
unset($_SESSION["nickname"]); 
unset($_SESSION["pass"]);
unset($_SESSION['id_employees']);
unset($_SESSION['employee']);
session_destroy();

header("location:../index.html");

exit;
?>
