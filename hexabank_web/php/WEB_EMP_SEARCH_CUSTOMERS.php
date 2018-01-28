<?php 

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

//The user should have been in WEB_EMP_DASHBOARD view before come here, it checks that.
if((! isset($_POST['Search_btn'])  ||(!$_POST['Search_btn']=="Search") )){
		header("location:../WEB_EMP_LOGIN.php?error=Loked session, login again");

	}
//Check the first field search by id  is empty. If that is true,  search by name

//Deletes blank spaces for id  customer input

//NEED DETAILS
$characters= str_replace(' ', '',$_POST['text_customer_id']);
$characters2=str_replace(' ', '',$_POST['text_customer_name']);

if(empty($characters)&&empty($characters2)){
	header('location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Please, fill the information');			
			exit;
	}

include '../config/config.php';


$cursor= ocinewcursor($conn);

$sql_stmn= "BEGIN SP_SELECT_CUSTOMERS(:id,:name,:result); END;";

$search = oci_parse($conn, $sql_stmn);

oci_bind_by_name($search, ':id',$characters);
oci_bind_by_name($search, ':name',$characters2);

//oci_bind_by_name($search, ':input',$characters);
ocibindbyname($search, ':result', $cursor, -1, OCI_B_CURSOR); 

//Executes the statement
if(!oci_execute($search)){
	header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Error to call database");
	}

//Executes the cursor
if(!oci_execute($cursor)){
	header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Error to call database");
	}

//Fetch cursor's content
$nrows = ocifetchstatement($cursor, $data,0,-1, OCI_NUM ); 


	//var_dump($data);
	//echo $nrows. "<br>". strlen($nrows);
	//exit;

oci_close($conn);

if($nrows<=0){
		header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Search has no results");
		exit;
	}

								 for($i=0;$i<(count($data[0]));$i++){
									 
									 for($j=0;$j<(count($data));$j++){
										 //echo $data[$j][$i];
										 //echo "<br>";
										$res[$i][$j]=$data[$j][$i];
										 
										 }
									 }
									 
									 
//Send the result to show it on the the next page
$_SESSION['cursor']=$res;
$_SESSION['search']="showResult";

//var_dump($res);
	//exit;
	

header("location:../employees/WEB_EMP_SEARCH_RESULT.php");


exit;
?>