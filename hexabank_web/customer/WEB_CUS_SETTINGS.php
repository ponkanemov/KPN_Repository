                                            <?php

                                                /**
                                            * Code to show a customer's information and modify it
                                            * @author Alan C. ,Ivan G., Axel Z. 
                                            * @version 0.1
                                            * @package 
                                            */
                                            session_start();

                                            //Validates if a customer is online before enter this page
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

                                            //This session variable was created on SEARCH_CUS_CUS_INFORMATION, so if a customer want to access this page, it had to be on SEARCH_CUS_CUS_INFORMATION before
                                            //This conditional ocurres when the variable is created.
                                            if(empty($_SESSION['settings_next']) || !($_SESSION['settings_next']="WEB_SETTING")){
                                            //Redirects to the custmer dashboard.
                                            header("location:WEB_CUS_DASHBOARD.php");
                                            exit;
                                            }
                                            
                                            ?>
                                            <!DOCTYPE html>
                                            <html lang="en">
                                            
                                            <head>
                                            
                                            <meta charset="utf-8">
                                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                            <meta name="viewport" content="width=device-width, initial-scale=1">
                                            <meta name="description" content="">
                                            <meta name="author" content="">
                                            
                                            <title>Hexabank</title>
                                            
                                                                                    
                                         <!-- Bootstrap Core CSS -->
                                         <link href="../resource/css/bootstrap.min.css" rel="stylesheet">
                                                                    
                                         <!-- Custom CSS -->
                                         <link href="../resource/css/simple-sidebar.css" rel="stylesheet"> 
                                            
                                            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                                            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                                            <!--[if lt IE 9]>
                                            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                                            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                                            <![endif]-->
                                            
                                            </head>
                                            
                                            <body>
                                            
                                            <div id="wrapper">
                                            
                                            <!-- Sidebar -->
                                            <div align="center" id="sidebar-wrapper">
                                            <ul class="sidebar-nav">
                                            <li class="sidebar-brand">
                                            <a href="../index.html">

                                          Hexabank
                             </a>
                             </li>
                             <li>
                             <a href="WEB_CUS_DASHBOARD.php">Dashboard</a>
                             </li>
                             <li>
                             <a href="WEB_CUS_TRANSACTIONS.php">Make A Transfer</a>
                             </li>
                             <li>
                             <a href="WEB_CUS_HISTORY_TRANSACTIONS.php">Transactions History</a>
                             </li>
                             <li>
                             <a href="../php/SEARCH_CUS_CUS_INFORMATION.php">My Profile</a>
                             </li>
                             
                             <li>
                             <a href="../php/WEB_CUS_LOGOUT.php">Log Out</a>
                             </li>
                             </ul>
                           
                             </div>
                             <!-- /#sidebar-wrapper -->  
                                            <!-- Page Content -->
                                            <div align="center" id="page-content-wrapper">
                                            <div class="container-fluid">
                                            <div class="row">
                                            <div class="col-lg-12">
                                              
<IMG SRC="../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India"><!-- Here begins  -->
                                          
                                             <h1>
                                            <?php
                                            //Shows the user's nickname and id
                                            echo "<font color='blue'> Username: </font>";
                                            echo $_SESSION['nickname'];
                                            echo "<br>";
                                            echo "<font color='blue'> User ID: </font>";
                                            echo $_SESSION['id_customer']
                                            ."<br>";
                                            echo "<br>";

                                                                                        //A variable that appears when a error ocurred
                                            if(isset($_GET['message_update'])){
                                            $error = $_GET['message_update'];
                                            
                                            $color = "#FF0000"; //Colour red
                                            echo "<p><font color='".$color."'>".$error."</font></p>";  
                                            }

                                            ?>
                                          <!-- /#sidebar-wrapper    <A HREF="../customer/PATH.php">Change Your Nip</A>-->
                                             </h1>
                                             <h1>

                                            <FORM id="settings_id" name="settings_name" action="../php/WEB_CUS_UPDATE_CUSTOMER.php" method="POST" >
                                            
                                            <p> Fisrt Name: <?php  echo $_SESSION['f_name'] ?><br>
                                            <br>
                                          
                                            Last Name: <?php echo $_SESSION['l_name'] ?><br>
                                            <br>
                                             <br>
                                             <br>
                                             Status:  <?php 
                                            //Checks the result of status variable, if the variable's value is 'T', it means that the customer is active

                                            if($_SESSION['status']=='T'){
                                            
                                            echo "Active";
                                            }
                                            else {
                                            echo "No active";
                                            }       
                                            ?>
                                            <br>
                                            <br>
                                            Email:  
                                            <br><input type="text" name="e_mail"  maxlength="50" required value="<?php echo $_SESSION['e_mail'] ?>"/>
                                            <br>
                                            <br>

                                            <!--Input the checks a phone number-->
                                            Phone Number:<br>
                                            <input type="tel" name="Phone_number" maxlength="15" required value="<?php echo $_SESSION['phone'] ?>" />
                                            <br>
                                            <br>

                                            <!--Shows a day of birth of a customer-->
                                            Date of birth: <?php echo $_SESSION['birth'] ?>
                                            <br>
                                            <br>
                                            
                                            <p> Address<br>
                                            <input type="text" name="address" maxlength="100" required  value="<?php echo $_SESSION['address'] ?>" />
                                            <br>
                                            <br>
                                            
                                            Genre: <?php  if($_SESSION['gender']='M'){
                                            echo "Male";
                                            }
                                            elseif($_SESSION['gender']='F'){
                                            echo "Female";
                                            }
                                            ?>
                                            
                                            <br>
                                            <br>
                                            Zip Code<br>
                                            <input type="text" name="zip_code" maxlength="5" pattern="[0-9]{5}" required value="<?php echo $_SESSION['zipcode'] ?>" />
                                            <br>
                                            <br>
                                            City<br>
                                            <input type="text" name="city" maxlength="30" required value="<?php echo $_SESSION['city'] ?>" />
                                            <br>                          
                                            <br>
                                            

                                            <!--This extra inputs is used when a user wants to change its password-->
                                            Do you want to change your password?
                                            <br><br>
                                            Write your actual password

                                            <!--The customer writes its currently password-->
                                            <input type="password" name="actual_password" id="id_actual_password" maxlength="20"  value=""  />
                                            <br>
                                            Write your new password

                                            <!--The customer writes the new password-->
                                            <input type="password" name="new_password" id="id_new_pasword" maxlength="20"  value=""  />
                                            <br>
                                            <?php 

                                            //Check the session called validations exists, it is created when the user writes its information incorrectly.
                                            if(isset($_GET['validation'])){
                                            
                                            //Prints the error on the screen.
                                            $error = $_GET['validation'];
                                            $color = "red"; //color a asignar
                                            echo "<p><font color='".$color."'>".$error."</font></p>";
                                            } ?>
                                            <br>
                                            
                                            
                                            </h1>
                                            <input type="submit" name="Save" value="Save">
                                            <br>
                                            
                                            
                                            </p>
                                            
                                            </FORM>
                                            
                                            <br><br><br><br>
                                            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Display Menu</a>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                          <!-- /#page-content-wrapper -->
                             
                                             </div>
                                             <!-- /#wrapper -->
                                             
                                             <!-- jQuery -->
                                             <script src="../resource/js/jquery.js"></script>
                                             
                                             <!-- Bootstrap Core JavaScript -->
                                             <script src="../resource/js/bootstrap.min.js"></script>
                                             
                                             <!-- Menu Toggle Script -->
                                             <script>
                                             $("#menu-toggle").click(function(e) {
                                             e.preventDefault();
                                             $("#wrapper").toggleClass("toggled");
                                             });
                                             </script>
                                             
                                             </body>
                                             
                                             </html>