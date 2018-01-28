					<?php 

					//Starts session
					session_start();

					//Validates a user signed in before.
					if(!($_SESSION['nickname_temp'] == $_SESSION['nickname'])){
                                header("location:../WEB_CUS_LOGIN.php?error=Locked session, login again");
                                unset($_SESSION['nickname_temp']);
                                unset($_SESSION['nickname']);
                                //session_destroy();
                                exit;
                             } if(!isset($_SESSION['id_customer'])){
                                header("location:../WEB_CUS_LOGIN.php?error=Initial fisrt session");
                                exit;
                             }
					
					//Check the information where created on SEARCH_CUS_CUS_INFORMATION php file
					if(isset($_SESSION['settings_next']) || !($_SESSION['settings_next']="WEB_SETTING")){
					header("location:../WEB_CUS_LOGIN.php?error=Initial First Session.");
					}
					
					//It check if a Button called Save was clicked before
					if(!isset($_POST['Save'])|| (!$_POST['Save']=='Send')){
					header("location:../WEB_CUS_LOGIN.php?error=Initial First Session..");
					exit;
					}
					//VALIDATIONS
					
					//Validates a correct email
					if(!filter_var($_POST['e_mail'],FILTER_VALIDATE_EMAIL)){
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Incorrect email.");
					exit;
					}
					//Validates if the email input is empty
					if(empty($_POST['e_mail'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, write your email.");
					exit;
						}
					
					//Validates the email is longer than 50 characters.
					if(strlen($_POST['e_mail'])>50){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=E mail address too long.");
					exit;
						}
					
					//Validates the phne number input is empty
					if(empty($_POST['Phone_number'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, write your phone number.");
					exit;
						}
					
					//Validates the phone number is longer than 15 characters.
					if(strlen($_POST['Phone_number'])>15){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Phone number too long.");
					exit;
					}
					
					//Validates the address input is empty
					if(empty($_POST['address'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, write address.");
					exit;
						}
					
					//Validates the address is longer than 50 characters.
					if(strlen($_POST['address'])>100){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Address too long.");
					exit;
					}
					
					//Validates the zipcode input is empty
					if(empty($_POST['zip_code'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, write your zipcode.");
					exit;
						}
					
					//Validates the address is longer than 15 characters.
					if(strlen($_POST['zip_code'])>15){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Zipcode too long.");
					exit;
					}
					
					//Validates the city input is empty
					if(empty($_POST['city'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, write your city.");
					exit;
						}
					
					//Validates the address is longer than 30 characters.
					if(strlen($_POST['city'])>30){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Cit¿y too long.");
					exit;
					}
					
					//Creates the variable user_pass and  it is assigned session passw value.
					$user_pass=$_SESSION['passw'];
					
					//It checks if a user wrote in extra inputs
					if(!empty($_POST['new_password'])||!empty($_POST['actual_password'])){
					
					
					//It checks if the new password input does not contain words
					if(empty($_POST['new_password'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, write a new password");
					exit;
					
					}
					
					//It checks if the actual password input does not contain words
					if(empty($_POST['actual_password'])){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Please, if you want to change your password, write the actual password.");
					exit;
					
					}
					//Validates the address is longer than 20 characters.
					if(strlen($_POST['actual_password'])>20){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Your actual password is too long.");
					exit;
					}
					
					//Validates the address is longer than 20 characters.
					if(strlen($_POST['new_password'])>20){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Your new password is too long.");
					exit;
					}
		
					//It validates the password written string is not equal to the password stored in the database 
					if($_POST['actual_password']!==$_SESSION['passw']){
						//Redirects to WEB_CUS_SETTINGS showing the customer mistake
					header("location:../customer/WEB_CUS_SETTINGS.php?validation=Write your pasword correctly");
					
					exit;	
					}
					//In the other case, it switches the session's values
					else{
					$user_pass=$_POST['new_password'];
					}		
					
					}
					
					
					//Adds the conecttion file
					include("../config/config.php");
		
					//String which willl be called to the database
					$statement='BEGIN SP_UPDATE_CUSTOMERS(:id, :f_name,:l_name,:e_mail,:phone,:birth,:address,:gender, :zipcode,:city,:nickname,:pass,:status,:result); END;';
					
					//It prepares the query
					$calling = oci_parse($conn, $statement);
					
					//Deletes blank spaces
					$_SESSION['status']=trim($_SESSION['status']);

					$zipcode=$_POST['zip_code'];
					
					
					
					// oci_bind_by_name binds the PHP variable to the Oracle placeholder 
					//The procedures updates a user.
					oci_bind_by_name($calling, ':id', $_SESSION['id_customer'],16);
					oci_bind_by_name($calling, ':f_name', $_SESSION['f_name'],51);
					oci_bind_by_name($calling, ':l_name', $_SESSION['l_name'],51);
					oci_bind_by_name($calling, ':e_mail', mb_convert_case($_POST['e_mail'], MB_CASE_LOWER, "UTF-8"),51);
					oci_bind_by_name($calling, ':phone', $_POST['Phone_number'],16);
					oci_bind_by_name($calling, ':birth', $_SESSION['birth'],10);
					oci_bind_by_name($calling, ':address', $_POST['address'],100);
					oci_bind_by_name($calling, ':gender', $_SESSION['gender'],1);
					oci_bind_by_name($calling, ':zipcode', $zipcode,6);
					oci_bind_by_name($calling, ':city', $_POST['city'],31);
					oci_bind_by_name($calling, ':nickname', $_SESSION['nick'],31);
					oci_bind_by_name($calling, ':pass', $user_pass,21);
					oci_bind_by_name($calling, ':status', $_SESSION['status'],1); 
					oci_bind_by_name($calling, ':result', $result,3);
					
					
					/*
					echo $_SESSION['id_customer']."-".strlen($_SESSION['id_customer'])."<br>";
					echo $_SESSION['f_name']."-".strlen($_SESSION['f_name'])."<br>";
					echo $_SESSION['l_name']."-".strlen($_SESSION['l_name'])."<br>";
					echo $_POST['e_mail']."-".strlen($_POST['e_mail'])."<br>";
					echo $_POST['Phone_number']."-".strlen($_POST['Phone_number'])."<br>";
					echo $_SESSION['birth']."-".strlen($_SESSION['birth'])."<br>";
					echo $_POST['address']."-".strlen($_POST['address'])."<br>";
					echo $_SESSION['gender']."-".strlen($_SESSION['gender'])."<br>";
					echo $_SESSION['zipcode']."-".strlen($_SESSION['zipcode'])."<br>";
					echo $_POST['city']."-".strlen($_POST['city'])."<br>";
					echo $_SESSION['nick']."-".strlen($_SESSION['nick'])."<br>";
					echo $user_pass."-".strlen($user_pass)."<br>";
					echo $_SESSION['passw']."-". strlen($_SESSION['passw'])."<br>";
					echo  $_SESSION['status']."-".strlen( $_SESSION['status'])."<br>";*/

					
					//Executes the statement and checks if an error ocurred
					if(!oci_execute($calling)){
						//Redirects to WEB_CUS_SETTINGS showing the error.
					header("location:../customer/WEB_CUS_DASHBOARD.php?message_update=An error has ocurred, try it later.");
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
					exit;
					}
					
					//Checks the result and deletes white spaces
					$result=trim($result);
					if($result =='F'){
					//The procedure did not process successfully, so it returns to dashboard sending a message.
					header("location:../customer/WEB_CUS_DASHBOARD.php?message_update=An error has ocurred, customer information could not be updated.");
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
					unset($_SESSION['settings_next']);
					
					// close procedure call
					oci_free_statement($calling);
					
					// close database connection
					oci_close($conn);
					
					//Go to dashboard printing a message
					header("location:../customer/WEB_CUS_DASHBOARD.php?message_update=Your information has changed sucessfully");
					
					}
					?>