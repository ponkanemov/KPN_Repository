				
				
				<?php
				
				/**
				* Code to connect oracle database from php
				* User is: banking
				* Pass is: userbank
				* @author Alan C. ,Ivan G., Axel Z. 
				* @version 0.1
				*/
				
				//user in the oracle database banking
				$user = "banking";
				//password in the oracle database banking
				$password = "userbank";
				//path database oracle
				$db = "(DESCRIPTION =
    				(ADDRESS = (PROTOCOL = TCP)(HOST = Hexaware-PC)(PORT = 1521))
    				(CONNECT_DATA =
     				 (SERVER = DEDICATED)
      				(SERVICE_NAME = XE) ))";
   						
 					 
				//connection to database oracle 11g
				$conn = oci_connect($user, $password, $db);				
				if (!$conn){
				header("location:ERROR_DATABASE.php");
				
				}
				?>
				
				
