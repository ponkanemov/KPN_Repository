<?php

include '../config/config.php';
session_start();

 if(!($_SESSION['nickname_temp_emp'] == $_SESSION['nickname_emp'])){
                                header("location:../WEB_CUS_LOGIN.php?error=Locked session, login again");
                                unset($_SESSION['nickname_temp_emp']);
                                unset($_SESSION['nickname_emp']);
                                //session_destroy();
                                exit;
                             } if(!isset($_SESSION['id_employees'])){
                                header("location:../WEB_CUS_LOGIN.php?error=Initial fisrt session");
                                exit;
                             }

							
							
                            
$web =$_POST["version_web"];
$app =$_POST["version_app"];




if($web){
header("Location:../employees/WEB_EMP_DASHBOARD.php");
}else{

header("Location:../employees/WEB_EMP_MENU.php");

}

if($app){

exec("C:\calcu.jar");

}else{

header("Location:../employees/WEB_EMP_MENU.php");

}




?>
