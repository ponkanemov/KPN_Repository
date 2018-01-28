		<?php
		
		include '../config/config.php';
	
		
		$email=$_POST['email'];
		

		$nickname = "####################################";
		$pass = "###############################";
		
		//calling to sp
		$sql = "CALL SP_LOGIN_RECOVERY(:p_email, :p_nickname, :p_pass, :p_message)";
		$foo = oci_parse($conn,$sql);
		oci_bind_by_name($foo, ':p_email', $email);
		oci_bind_by_name($foo, ':p_nickname', $nickname);
		oci_bind_by_name($foo, ':p_pass', $pass);
		oci_bind_by_name($foo, ':p_message', $message);
		
		//ejecuta el sp
		$res = oci_execute($foo);
		
		
		
		
		if($message == 'T')
		{
		
		$to = $_POST['email'];
		$subject = "Recovery Passoword";
		$txt = "Hexabank 
		
Hello Customer, your recovery password was successfull.
		
Your Nickname is: $nickname
Passoword is: $pass
		
		
best and regards....";
		$headers = "From: donotreply@fmtt.com";
		
		mail($to,$subject,$txt,$headers);
		
		header("location:../customer/WEB_CUS_FORGOTPASS_SUCCESSFULL.php");
		
		}else{
		
		header("Location:../customer/WEB_CUS_FORGOTPASS.php?error=Email Not Found,Sorry");
		}
		
		
		
		?>
