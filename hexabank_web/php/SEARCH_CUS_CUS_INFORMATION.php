				<?php 
				/**
				* Code to get a customer's information caling an stored procedure.
				* @author Alan C. ,Ivan G., Axel Z. 
				* @version 0.1
				* @package 
				*/
				session_start();

				//It checks a user is connected, if not, it can not execute this part of the code.
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
				
				//Adds the conection file
				include '../config/config.php';
				
				//Create the procedure and variables
				$sql= "BEGIN SP_GETCUSTOMER(:id,:first_name,:last_name,:email,:phone,:birth,:gender,:zipcode,:city,:nickname,:pass,:status,:address,:result); END;"; //Crea el script que se enviara a la bd
				
				//Prepares the query
				$search_info = oci_parse($conn, $sql);
				
				
				
				
				//Binds the php varibles to Oracle objects
				oci_bind_by_name($search_info, ':id',$_SESSION['id_customer'],15);
				oci_bind_by_name($search_info, ':first_name',$_SESSION['f_name'],50);
				oci_bind_by_name($search_info, ':last_name',$_SESSION['l_name'],50);
				oci_bind_by_name($search_info, ':email',$_SESSION['e_mail'],50);
				oci_bind_by_name($search_info, ':phone',$_SESSION['phone'],15);
				oci_bind_by_name($search_info, ':birth',$_SESSION['birth'],10);
				oci_bind_by_name($search_info, ':gender',$_SESSION['gender'],1);
				oci_bind_by_name($search_info, ':zipcode',$_SESSION['zipcode'],5);
				oci_bind_by_name($search_info, ':city',$_SESSION['city'],30);
				oci_bind_by_name($search_info, ':nickname',$_SESSION['nick'],30);
				oci_bind_by_name($search_info, ':pass',$_SESSION['passw'],20);
				oci_bind_by_name($search_info, ':status',$_SESSION['status'],1);
				oci_bind_by_name($search_info, ':address',$_SESSION['address'],100);
				oci_bind_by_name($search_info, ':result',$result,1);
				
				//Executes the statement, if it fails, it will relink to the dashboard page.
				if(!oci_execute($search_info)){
				header("location:../customer/WEB_CUS_DASHBOARD.php?message_update=An error has ocurred, customer information could not be showed.");
				exit;
				
				}
				
				$result=trim($resutl);
				
				//When the result variable returns an F, it means that customer does not exist or an exception
				if($result =='F'){
				//The procedure did not process successfully, so it returns to dashboard sending a message.
				header("location:../customer/WEB_CUS_DASHBOARD.php?error=An error has ocurred, customer information could not be showed.");
				// close procedure call
				oci_free_statement($calling);
				// close database connection
				oci_close($conn);
				exit;
				}
				
				//These are char variables. Sometimes oracle send char variables and blankspaces, trim deletes that disadvantage
				$_SESSION['gender']=trim($_SESSION['gender']);
				$_SESSION['status']=trim($_SESSION['status']);
				
				//Create a session ariable for security matters
				$_SESSION['settings_next']="WEB_SETTING";
				
				
				//Redirects to Settings 
				header("location:../customer/WEB_CUS_SETTINGS.php");
				
				?>