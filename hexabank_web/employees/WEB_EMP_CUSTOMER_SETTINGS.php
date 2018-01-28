
 <?php
                                            session_start();

                            include '../config/config.php';
                        
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

                                            ECHO "<h1>Change settings</h1>"
                                           
                                            if(isset($_GET['message_emp_update'])){
                                            $error = $_GET['message_emp_update'];
                                            
                                            $color = "#FF0000"; //color a asignar
                                            echo "<p><font color='".$color."'>".$error."</font></p>";  
                                            }
                                            
                                            //echo "jcijcirjcijcij<br>";
                                            //echo $_SESSION['passw'];
                                            ?>
                                            <FORM id="settings_id" name="settings_name" action="../php/WEB_EMP_UPDATE_CUSTOMER.php" method="POST" >
                                            
                                            <p> Fisrt Name: <?php echo $_SESSION['f_name_emp'];  ?>
                                            <br>
                                            <br>
                                            Last Name: <?php echo $_SESSION['l_name_emp']; ?>
                                            <br>
                                            Email:	
                                            <input type="text" name="e_mail"  maxlength="50" required value="<?php echo $_SESSION['e_mail_emp'] ?>"/>
                                            <br>
                                            Phone Number:
                                            <input type="tel" name="Phone_number" maxlength="15" required value="<?php echo $_SESSION['phone_emp'] ?>" />
                                            <br>
                                            Date of birth: <?php echo $_SESSION['birth_emp'] ?>
                                            <br>
                                            
                                            <p> Address
                                            <input type="text" name="address" maxlength="100" required  value="<?php echo $_SESSION['address_emp'] ?>" />
                                            <br>
                                            
                                            
                                            Genre: <?php  if($_SESSION['gender_emp']='M'){
                                            echo "Male";
                                            }
                                            elseif($_SESSION['gender_emp']='F'){
                                            echo "Female";
                                            }
                                            ?>
                                            
                                            <br>
                                            Zip Code
                                            <input type="text" name="zip_code" maxlength="5" pattern="[0-9]{5}" required value="<?php echo $_SESSION['zipcode_emp'] ?>" />
                                            <br>
                                            
                                            City
                                            <input type="text" name="city" maxlength="30" required value="<?php echo $_SESSION['city_emp'] ?>" />
                                            <br>                          
                                            <br>
                                            Status	<?php if($_SESSION['status_emp']=='T'){
                                            
                                            echo "Active";
                                            }
                                            else {
                                            echo "No active";
                                            }		
                                            ?>
                                            <br>
                                            
                                            Do you want to change your password?
                                            <br>
                                            Write your actual password
                                            <input type="text" name="actual_password" id="id_actual_password" maxlength="20"  value=""  />
                                            <br>
                                            Write your new password
                                            <input type="text" name="new_password" id="id_new_pasword" maxlength="20"  value=""  />
                                            <br>
                                            <?php if(isset($_GET['validation_emp'])){
                                            
                                            $error = $_GET['validation_emp'];
                                            $color = "red"; //color a asignar
                                            echo "<p><font color='".$color."'>".$error."</font></p>";
                                            } ?>
                                            <br>
                                            
                                            
                                            
                                            <input type="submit" name="Next" value="Send">
                                            <br>
                                            
                                            
                                            </p>
                                            
                                            </FORM>
                                            
                                            
                                            