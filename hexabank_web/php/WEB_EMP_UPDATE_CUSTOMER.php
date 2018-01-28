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
/*					echo $_SESSION['showInfo']."<br>";
					echo $_SESSION['id_cust_emp'];
					exit;*/
						if(empty($_SESSION['showInfo']) || !($_SESSION['showInfo']=$_SESSION['id_cust_emp'])){
                            header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=Anauthorized Access");
							exit;
                            }
										
					//It check if a Button called Save was clicked before
					if(!isset($_POST['Next'])){
					header("location:../WEB_EMP_LOGIN.php?error=Initial First Session..");
					exit;
					}
					//VALIDATIONS
					
					//Validates a correct email
					if(!filter_var($_POST['e_mail'],FILTER_VALIDATE_EMAIL)){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Incorrect email.");
					exit;
					}
					
					if(empty($_POST['e_mail'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, write your email.");
					exit;
						}
					
					if(strlen($_POST['e_mail'])>50){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=E mail address too long.");
					exit;
						}
					
					if(empty($_POST['Phone_number'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, write your phone number.");
					exit;
						}
					
					
					if(strlen($_POST['Phone_number'])>15){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Phone number too long.");
					exit;
					}
					
					if(empty($_POST['address'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, write address.");
					exit;
						}
					
					if(strlen($_POST['address'])>100){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Address too long.");
					exit;
					}
					
					if(empty($_POST['zip_code'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, write your zipcode.");
					exit;
						}
					
					if(strlen($_POST['zip_code'])>15){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Zipcode too long.");
					exit;
					}
					
					
					if(empty($_POST['city'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, write your city.");
					exit;
						}
					
					if(strlen($_POST['city'])>30){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=City too long.");
					exit;
					}
					
					
					
					
					$user_pass=$_SESSION['passw_emp'];
						
					
					
					
					
					//It checks if the user writed in a textbox
					if(!empty($_POST['new_password'])||!empty($_POST['actual_password'])){
					
					
					//It checks if the new password input does not contain words
					if(empty($_POST['new_password'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, write a new password");
					exit;
					
					}
					
					//It checks if the actual password input does not contain words
					if(empty($_POST['actual_password'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please, if you want to change your password, write the actual password.");
					exit;
					
					}
					
					if(strlen($_POST['actual_password'])>30){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Your actual password is too long.");
					exit;
					}
					
					if(strlen($_POST['new_password'])>30){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Your new password is too long.");
					exit;
					}
		
					//It validates the password written string is not equal to the password stored in the database 
					if($_POST['actual_password']!==$_SESSION['passw_emp']){
						
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Write your pasword correctly");
					
					exit;	
					}
					//In the other case, it switches the session's values
					else{
					$user_pass=$_POST['new_password'];
					}		
					
					}
					
					if(empty($_POST['status_ifz'])){
					header("location:../employees/WEB_EMP_SHOW_CUS_INFO.php?validation_emp=Please select an status");
					exit;
						}
					
					//Adds the conecttion file
					include("../config/config.php");
		
					//String which willl be called to the database
					$statement='BEGIN SP_UPDATE_CUSTOMERS(:id, :f_name,:l_name,:e_mail,:phone,:birth,:address,:gender, :zipcode,:city,:nickname,:pass,:status,:result); END;';
					
					//It prepares the query
					$calling = oci_parse($conn, $statement);
					
					
					//$_SESSION['status_emp']=trim($_SESSION['status_emp']);
					$zipcode=$_POST['zip_code'];
					
					
					
					// oci_bind_by_name binds the PHP variable to the Oracle placeholder 
					//The procedures updates a user.
					oci_bind_by_name($calling, ':id', $_SESSION['id_cust_emp'],16);
					oci_bind_by_name($calling, ':f_name', $_SESSION['f_name_emp'],51);
					oci_bind_by_name($calling, ':l_name', $_SESSION['l_name_emp'],51);
					oci_bind_by_name($calling, ':e_mail', mb_convert_case($_POST['e_mail'],MB_CASE_LOWER,"UTF-8"),51);
					oci_bind_by_name($calling, ':phone', $_POST['Phone_number'],16);
					oci_bind_by_name($calling, ':birth', $_SESSION['birth_emp'],10);
					oci_bind_by_name($calling, ':address', $_POST['address'],100);
					oci_bind_by_name($calling, ':gender', $_SESSION['gender_emp'],1);
					oci_bind_by_name($calling, ':zipcode', $zipcode,6);
					oci_bind_by_name($calling, ':city', $_POST['city'],31);
					oci_bind_by_name($calling, ':nickname', $_SESSION['nick_emp'],31);
					oci_bind_by_name($calling, ':pass', $user_pass,21);
					oci_bind_by_name($calling, ':status', $_POST['status_ifz'],1); 
					oci_bind_by_name($calling, ':result', $result,3);
					
					
					/*
					echo $_SESSION['id_cust_emp']."-".strlen($_SESSION['id_cust_emp'])."<br>";
					echo $_SESSION['f_name']."-".strlen($_SESSION['f_name_emp'])."<br>";
					echo $_SESSION['l_name']."-".strlen($_SESSION['l_name_emp'])."<br>";
					echo $_POST['e_mail']."-".strlen($_POST['e_mail'])."<br>";
					echo $_POST['Phone_number']."-".strlen($_POST['Phone_number'])."<br>";
					echo $_SESSION['birth']."-".strlen($_SESSION['birth_emp'])."<br>";
					echo $_POST['address']."-".strlen($_POST['address'])."<br>";
					echo $_SESSION['gender']."-".strlen($_SESSION['gender_emp'])."<br>";
					echo $_SESSION['zipcode']."-".strlen($_SESSION['zipcode_emp'])."<br>";
					echo $_POST['city']."-".strlen($_POST['city'])."<br>";
					echo $_SESSION['nick']."-".strlen($_SESSION['nick_emp'])."<br>";
					echo $user_pass."-".strlen($user_pass)."<br>";
					echo $_SESSION['passw']."-". strlen($_SESSION['passw_emp'])."<br>";
					echo  $_SESSION['status']."-".strlen( $_SESSION['status_emp'])."<br>";*/
					
					
					//Ya que la clase envía espacios en blanco, eliminamos aquella variables que pueden llevar mas un caracter.
					
					//Executes the statement and checks if an error ocurred
					if(!oci_execute($calling)){
					header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=An error has ocurred, try it later.");
					unset($_SESSION['f_name_emp']);
					unset($_SESSION['l_name_emp']);
					unset($_SESSION['e_mail_emp']);
					unset($_SESSION['phone_emp']);
					unset($_SESSION['birth_emp']);
					unset($_SESSION['gender_emp']);
					unset($_SESSION['zipcode_emp']);
					unset($_SESSION['city_emp']);
					unset($_SESSION['nick_emp']);
					unset($_SESSION['passw_emp']);
					unset($_SESSION['status_emp']);
					unset($_SESSION['address_emp']);
					unset($_SESSION['showInfo']);
					unset($_SESSION['id_cust_emp']);
					exit;
					}
					
					//Checks the result and deletes white spaces
					
					
					$result=trim($result);
					
					/*echo $result;
					exit;*/
					if($result =='F'){
					//The procedure did not process successfully, so it returns to dashboard sending a message.
					header("location:../employees/WEB_EMP_DASHBOARD.php?error_dash_emp=An error has ocurred, customer information could not be updated. If you want to disable your account, be sure you do not have active accounts, neither have you your  debts.");
					unset($_SESSION['f_name']);
					unset($_SESSION['l_name']);
					unset($_SESSION['e_mail']);
					unset($_SESSION['phone']);
					unset($_SESSION['birth']);
					unset($_SESSION['gender']);
					unset($_SESSION['zipcode']);
					unset($_SESSION['city']);
					unset($_SESSION['nick']);
					unset($_SESSION['passw']);
					unset($_SESSION['status']);
					unset($_SESSION['address']);
					unset($_SESSION['showInfo']);
					unset($_SESSION['id_cust_emp']);
					// close procedure call
					oci_free_statement($calling);
					// close database connection
					oci_close($conn);
					exit;
					}
					else{
					//Deletes the variables created previously
					unset($_SESSION['f_name']);
					unset($_SESSION['l_name']);
					unset($_SESSION['e_mail']);
					unset($_SESSION['phone']);
					unset($_SESSION['birth']);
					unset($_SESSION['gender']);
					unset($_SESSION['zipcode']);
					unset($_SESSION['city']);
					unset($_SESSION['nick']);
					unset($_SESSION['passw']);
					unset($_SESSION['status']);
					unset($_SESSION['address']); 
					unset($_SESSION['showInfo']);
					
					// close procedure call
					oci_free_statement($calling);
					
					// close database connection
					oci_close($conn);
					
					//Go to dashboard printing a message
					header("location:../employees/WEB_EMP_CONFIRMATION.php");
					
					}
					?>