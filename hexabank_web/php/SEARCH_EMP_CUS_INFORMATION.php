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
/*							

if(!isset($_SESSION['showCustInfor'])){
	header("location:../employees/WEB_EMP_DASHBOARD.php");
	unset($_SESSION['cursor']);
	unset($_SESSION['showCustInfor']);
	exit;
	}

if(!isset($_GET['id_cust_emp'])){
	header("location:../WEB_EMP_LOGIN.php?error=Initial First Session");
	unset($_SESSION['cursor']);
	unset($_SESSION['showCustInfor']);
	exit;
	}
	*/
/*
	unset($_SESSION['cursor']);
	unset($_SESSION['showCustInfor']);
	*/
	
	include '../config/config.php';
	
	$sql= "BEGIN SP_GETCUSTOMER(:id,:first_name,:last_name,:email,:phone,:birth,:gender,:zipcode,:city,:nickname,:pass,:status,:address,:result); END;"; //Crea el script que se enviara a la bd

//Enlaza el script con la bd, aun no se ejecuta


$search_info = oci_parse($conn, $sql);

//exit;
//Enlaza la variable number con la variable php 
oci_bind_by_name($search_info, ':id',$_GET['id_cust_emp'],15);
oci_bind_by_name($search_info, ':first_name',$_SESSION['f_name_emp'],50);
oci_bind_by_name($search_info, ':last_name',$_SESSION['l_name_emp'],50);
oci_bind_by_name($search_info, ':email',$_SESSION['e_mail_emp'],50);
oci_bind_by_name($search_info, ':phone',$_SESSION['phone_emp'],15);
oci_bind_by_name($search_info, ':birth',$_SESSION['birth_emp'],10);
oci_bind_by_name($search_info, ':gender',$_SESSION['gender_emp'],1);
oci_bind_by_name($search_info, ':zipcode',$_SESSION['zipcode_emp'],5);
oci_bind_by_name($search_info, ':city',$_SESSION['city_emp'],30);
oci_bind_by_name($search_info, ':nickname',$_SESSION['nick_emp'],30);
oci_bind_by_name($search_info, ':pass',$_SESSION['passw_emp'],20);
oci_bind_by_name($search_info, ':status',$_SESSION['status_emp'],1);
oci_bind_by_name($search_info, ':address',$_SESSION['address_emp'],100);
oci_bind_by_name($search_info, ':result',$result,1);


oci_execute($search_info);
$_SESSION['status_emp']=trim($_SESSION['status_emp']);


$result=trim($result);
echo $result."<br>";
echo strlen($result);

if($result=='F'){
	
	header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=User does not exist");
	exit;
	}


/*if($_SESSION['status_emp']=='F'){
		header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=User does not exist");
	exit;
	}*/
/*
echo $_SESSION['f_name_emp'] ."<br>";
echo $_SESSION['l_name_emp']."<br>";
echo $_SESSION['e_mail_emp']."<br>";
echo $_SESSION['phone_emp']."<br>";
echo $_SESSION['birth_emp']."<br>";
echo $_SESSION['gender_emp']."<br>";
echo $_SESSION['zipcode_emp']."<br>";
echo $_SESSION['city_emp']."<br>";
echo $_SESSION['nick_emp']."<br>";
echo $_SESSION['passw_emp']."<br>";
echo $_SESSION['status_emp']."<br>";
echo $_SESSION['address_emp']."<br>";
$_SESSION['status_emp']=trim($_SESSION['status_emp']);

echo $result."<br>";*/

//exit;

/* BUSCA LOS CREDIT*/
$cursor_credit= ocinewcursor($conn);

$statement_credit= "BEGIN SP_SELECT_CREDIT('',:id_customer,:credit_accounts); END;";

$search_credit = oci_parse($conn, $statement_credit);

oci_bind_by_name($search_credit, ':id_customer',$_GET['id_cust_emp']);
ocibindbyname($search_credit, ':credit_accounts', $cursor_credit, -1, OCI_B_CURSOR); 

if(!oci_execute($search_credit)){
	header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Error to call database");
	}
	

//Executes the cursor
if(!oci_execute($cursor_credit)){
	header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Error to call database..");
	}
	
$nrows_credit = ocifetchstatement($cursor_credit, $data_credit,0,-1, OCI_NUM ); 
//exit;

ocifreestatement($search_credit);
ocifreestatement($cursor_credit);
	

if($nrows_credit>0){
	$_SESSION['credit']=$data_credit;
	
	}



$cursor_jcredit= ocinewcursor($conn);

				$statement_jcredit= "BEGIN SP_SELECT_J_CREDIT('',:id_customer,:credit_accounts); END;";

				$search_jcredit = oci_parse($conn, $statement_jcredit);
				
				oci_bind_by_name($search_jcredit, ':id_customer',$_GET['id_cust_emp']);

				ocibindbyname($search_jcredit, ':credit_accounts', $cursor_jcredit, -1, OCI_B_CURSOR); 
				
				oci_execute($search_jcredit);
				oci_execute($cursor_jcredit);

				$nrows_jcredit = ocifetchstatement($cursor_jcredit, $data_jcredit,0,-1, OCI_NUM ); 
				
		if($nrows_jcredit>0){
				$_SESSION['j_credit']=$data_jcredit;
			}
			
		ocifreestatement($search_jcredit);
		ocifreestatement($cursor_jcredit);
			
			
			
				
$cursor_debit= ocinewcursor($conn);

				$statement_debit= "BEGIN SP_SELECT_DEBIT('',:id_customer,:credit_accounts); END;";

				$search_debit = oci_parse($conn, $statement_debit);
				
				oci_bind_by_name($search_debit, ':id_customer',$_GET['id_cust_emp']);

				ocibindbyname($search_debit, ':credit_accounts', $cursor_debit, -1, OCI_B_CURSOR); 
				
				oci_execute($search_debit);
				oci_execute($cursor_debit);

				$nrows_debit = ocifetchstatement($cursor_debit, $data_debit,0,-1, OCI_NUM ); 
				
		if($nrows_debit>0){
				$_SESSION['debit']=$data_debit;
			}
		ocifreestatement($search_debit);
		ocifreestatement($cursor_debit);


				

$cursor_jdebit= ocinewcursor($conn);

	$statement_jdebit= "BEGIN SP_SELECT_J_DEBIT('',:id_customer,:credit_accounts); END;";

	$search_jdebit = oci_parse($conn, $statement_jdebit);
				
	oci_bind_by_name($search_jdebit, ':id_customer',$_GET['id_cust_emp']);

	ocibindbyname($search_jdebit, ':credit_accounts', $cursor_jdebit, -1, OCI_B_CURSOR); 
				
	oci_execute($search_jdebit);
	oci_execute($cursor_jdebit);

	$nrows_jcredit = ocifetchstatement($cursor_jdebit, $data_jdebit,0,-1, OCI_NUM ); 
				
		if($nrows_jcredit>0){
				$_SESSION['j_debit']=$data_jdebit;
			}
		ocifreestatement($search_jdebit);
		ocifreestatement($cursor_jdebit);
			
		$cursor_payroll= ocinewcursor($conn);

		$statement_payroll= "BEGIN SP_SELECT_PAYROLL('',:id_customer,:credit_accounts); END;";

		$search_payroll = oci_parse($conn, $statement_payroll);
				
		oci_bind_by_name($search_payroll, ':id_customer',$_GET['id_cust_emp']);

		ocibindbyname($search_payroll, ':credit_accounts', $cursor_payroll, -1, OCI_B_CURSOR); 
				
		oci_execute($search_payroll);
		oci_execute($cursor_payroll);

		$nrows_payroll = ocifetchstatement($cursor_payroll, $data_payroll,0,-1, OCI_NUM ); 
				
	if($nrows_payroll>0){
				$_SESSION['payroll']=$data_payroll;
			}
			
	ocifreestatement($search_payroll);
		ocifreestatement($cursor_payroll);		

//var_dump($data_credit);

//echo "<br>--------------------------------------------------------";
//var_dump($data_jcredit);
//echo "<br>--------------------------------------------------------";
//var_dump ($data_debit);
//var_dump($data_jdebit);
//var_dump($data_payroll);


oci_close($conn);


$_SESSION['id_cust_emp']=$_GET['id_cust_emp'];

$_SESSION['showInfo']=$_SESSION['id_cust_emp'];


header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php");

?>



