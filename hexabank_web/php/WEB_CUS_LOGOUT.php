<?php

session_start();
unset($_SESSION["nickname"]); 
unset($_SESSION["pass"]);
unset($_SESSION['id_customer']);
unset($_SESSION['customer']);
session_destroy();

header("location:../index.html");


exit;
?>
