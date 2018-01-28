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
                            <style>
                                .mayuscula{  
                                   text-transform: uppercase;  
                                          }  
                            </style>
                            
                            </head>
                            
                            <body>
                            
                            <div align="center" id="wrapper">
                            
                            <!-- Sidebar -->
                            <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                            <li class="sidebar-brand">
                            <a href="WEB_EMP_DASHBOARD.php">
                           Hexabank
                            </a>
                            </li>
                            <li>
                            <a href="WEB_EMP_DASHBOARD.php">Dashboard</a>
                            </li>
                            <li>
                            <a href="WEB_EMP_TRANSACTIONS.php">Make A Transfer</a>
                            </li>
                            <li>
                            <a href="WEB_EMP_HISTORY_TRANSACTIONS.php">Transactions History</a>
                            </li>                            
                            <li>
                            <a href="../php/WEB_EMP_LOGOUT.php">Log Out</a>
                            </li>
                            </ul>
                            </div>
                            <!-- /#sidebar-wrapper -->
                            <!-- Page Content -->
                            <div id="page-content-wrapper">
                            <div class="container-fluid">
                            <div class="row">
                            <div align="center" class="col-lg-12">

                            <IMG SRC="../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">
                            
                            
                    <?php 
                    
                          if(isset($_GET['message_emp_update'])){
                          $error = $_GET['message_emp_update'];
                          $color = "#FF0000"; //color a asignar
                          echo "<p><font color='".$color."'>".$error."</font></p>";  
                          }
                                            ?>
                                            <font color="red"> <h2> Customer Information</h2></font><br>
                                            <h1>
                                            <FORM id="settings_id" name="settings_name" action="../php/WEB_EMP_UPDATE_CUSTOMER.php" method="POST" >
                                            
                                            <p> Fisrt Name: <?php echo $_SESSION['f_name_emp'];  ?>
                                            <br>
                                            <br>
                                            <br>
                                            Last Name: <?php echo $_SESSION['l_name_emp']; ?>
                                            <br><br>
                                            Email:  
                                            <input type="text" name="e_mail"  maxlength="50" required value="<?php echo $_SESSION['e_mail_emp'] ?>"/>
                                            <br><br>
                                            Phone Number:
                                            <input type="tel" name="Phone_number" maxlength="15" required value="<?php echo $_SESSION['phone_emp'] ?>" />
                                            <br><br>
                                            Date of birth: <?php echo $_SESSION['birth_emp'] ?>
                                            <br><br>
                                            
                                            <p> Address
                                            <input type="text" name="address" maxlength="100" required  value="<?php echo $_SESSION['address_emp'] ?>" />
                                            <br>
                                            
                                            <br>
                                            Gender: <?php  if($_SESSION['gender_emp']='M'){
                                            echo "Male";
                                            }
                                            elseif($_SESSION['gender_emp']='F'){
                                            echo "Female";
                                            }

                                            ?>
                                            
                                            <br><br>
                                            Zip Code
                                            <input type="text" name="zip_code" maxlength="5" pattern="[0-9]{5}" required value="<?php echo $_SESSION['zipcode_emp'] ?>" />
                                            <br><br>
                                            
                                            City
                                            <input type="text" name="city" maxlength="30" required value="<?php echo $_SESSION['city_emp'] ?>" />
                                            <br>                          
                                            <br><br>
                                            Status  <br>
                                            <select required  name="status_ifz"  >
                                            <option  value="" >Select a status</option>    
                                            <option value="T" >Active</option>
                                            <option value="F">Inactive</option>
                                            </select>
                                            <br><br>
                                            
                                            Do you want to change your password?
                                            <br><br>
                                            Write your actual password
                                            <input type="text" name="actual_password" id="id_actual_password" maxlength="20"  value=""  />
                                            <br> 
                                            Write your new password
                                            <input type="text" name="new_password" id="id_new_pasword" maxlength="20"  value=""  />
                                            <br><br>
                                            <?php if(isset($_GET['validation_emp'])){
                                            
                                            $error = $_GET['validation_emp'];
                                            $color = "red"; //color a asignar
                                            echo "<p><font color='".$color."'>".$error."</font></p>";
                                            }
                                            ?>
                                            <br>
                                            
                                            

                                            
                                            <input type="submit" name="Next" value="Change_information">
                                            <br>
                                            <br>
                                            
                                            
                                            <div align='center' FONT FACE='arial' SIZE=5 >
                               
                                            </p>
                                            
                                            </FORM>
                                            
                    <?php
                    
                    

                                                                    echo "<font color='red'> Credit Accounts </font>";
                                                                    echo "<br>";
                                                                   
                    if(isset($_SESSION['credit'])){

                           echo "<table class='table'>";
                           echo "<thead>";
                            echo " <tr>
                            <td> Credit Account </td>
                            <td> Created on</td>
                            <td> Credit limit</td>
                            <td> Balance Due</td>
                            <td> Expiration</td>
                            <td> Payment </td>
                            </tr>";
                            echo "</thead>";
                            
                            echo "<tbody>";
                         for($i=0;$i<count($_SESSION['credit'][0]);$i++){
                             
                            $_SESSION['credit'][11][$i]=trim($_SESSION['credit'][11][$i]);
                                
                            if($_SESSION['credit'][11][$i]=='T'){
                                echo "<tr>";
                                echo "<td>";
                                echo $_SESSION['credit'][0][$i];
                                echo "</td>";

                                echo "<td>";
                                echo $_SESSION['credit'][1][$i];
                                echo "</td>";

                                echo "<td>";
                                echo $_SESSION['credit'][2][$i];
                                echo "</td>";

                                echo "<td>";
                                echo $_SESSION['credit'][3][$i];    
                                echo "</td>";

                                echo "<td>";
                                echo $_SESSION['credit'][4][$i]; 
                                echo "</td>";

                                echo "<td>";
                                echo $_SESSION['credit'][5][$i];    
                                echo "</td>";

                                echo "</tr>";
                                
                            }
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }



                    
                    

                        if(isset($_SESSION['j_credit'])){
                            
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";
                       
                            echo "<font color='red'> Credit Joint Accounts </font>";
                            echo "<br>";
                            echo "<br>";
                                                                   

                            echo "<table class='table'>";
                            echo "<thead>";
                            echo " <tr>
                            <td> <font color='red'> Owner: </font> </td>
                            <td> Account ID</td>
                            <td> Created On</td>
                            <td> Balance Due</td>
                            <td> Main Account</td>
                            </tr>";
                            echo "</thead>";

                            echo "<tbody>";

                            for($j=0;$j<count($_SESSION['j_credit'][0]);$j++){
                                    $_SESSION['j_credit'][10][$j]=trim($_SESSION['j_credit'][10][$j]);
                                    if($_SESSION['j_credit'][10][$j]=='T'){
                                                            
                                              echo "<tr>";

                                              echo "<td>";
                                              echo $_SESSION['j_credit'][1][$j];
                                              echo "</td>";

                                              echo "<td>";
                                              echo $_SESSION['j_credit'][0][$j];
                                              echo "</td>";

                                              echo "<td>";
                                              echo $_SESSION['j_credit'][2][$j];
                                              echo "</td>";

                                              echo "<td>";
                                              echo $_SESSION['j_credit'][4][$j];
                                              echo "</td>";

                                              echo "<td>";
                                              echo $_SESSION['j_credit'][7][$j];
                                              echo "</td>";

                                              echo "</tr>";
                                          
                                     }
                            }
                            echo "</tbody>";
                            echo "</table>";
                                
                        }







                echo "<br>";
                echo "<br>";
                echo "<font color='red'> Debit Accounts </font>";
                echo "<br>";
                echo "<br>";
         
                        
    if(isset($_SESSION['debit'])){
                            

        echo "<table class='table'>";

        echo "<thead>";
        echo " <tr>
        <td> Account ID</td>
        <td> Created On</td>
        <td> Balance Due</td>
        <td> Expiration Date</td>
        <td> Rights</td>
        </tr>";
        echo "</thead>";


        echo "<tbody>";
        for($i=0;$i<count($_SESSION['debit'][0]);$i++){
                $_SESSION['debit'][8][$i]=trim($_SESSION['debit'][8][$i]);
                if($_SESSION['debit'][8][$i]=='T'){

                        echo "<tr>";

                        echo "<td>";
                        echo $_SESSION['debit'][0][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['debit'][7][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['debit'][2][$i]; 
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['debit'][4][$i]; 
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['debit'][7][$i];
                        echo "</td>";

                        echo "</tr>";
                                
                 }
        }

                        echo "</tbody>";
                        echo "</table>";
    }


                echo "<br>";
                echo "<font color='red'> JDebit Accounts </font>";
                echo "<br>";
                echo "<br>";
           


                if(isset($_SESSION['j_debit'])){

                    echo "<table class='table'>";
                    echo "<thead>";
                    echo " <tr>
                    <td> Account ID</td>
                    <td> Main Account</td>
                    <td> Created On</td>
                    <td> <font color='red'> Owner: </font> </td>
                    <td> Rights</td>
                    </tr>";
                    echo "</thead>";

                    echo "<tbody>";
                        
                                for($j=0;$j<count($_SESSION['j_debit'][0]);$j++){

                                    $_SESSION['j_debit'][7][$j]=trim($_SESSION['j_debit'][7][$j]);
                                    if($_SESSION['j_debit'][7][$j]=='T'){                                       

                                            echo "<tr>";

                                               echo "<td>";
                                               echo $_SESSION['j_debit'][0][$j];
                                               echo "</td>";


                                               echo "<td>";
                                                echo $_SESSION['j_debit'][4][$j];
                                                echo "</td>";
                                                
                                                echo "<td>";
                                                echo $_SESSION['j_debit'][2][$j];
                                                echo "</td>";


                                                echo "<td>";
                                                echo $_SESSION['j_debit'][1][$j];
                                                echo "</td>";



                                                echo "<td>";
                                                echo $_SESSION['j_debit'][6][$j];
                                                echo "</td>";

                                                 echo "</tr>";
                                            }
                                    }
                                        echo "</tbody>";
                                        echo "</table>";
                                }
                            


                                echo "<br>";
                echo "<font color='red'> Payroll Accounts </font>";
                echo "<br>";
                echo "<br>";
           

                            echo "<table class='table'>";
                            echo "<thead>";
                            echo " <tr>
                            <td> Account Payroll</td>
                            <td> Created on</td>
                            <td> Balance Due</td>
                            <td> Rights</td>
                            <td> Status</td>
                            </tr>";
                            echo "</thead>";                            

                            echo "<tbody>";
                            for ($i=0;$i<count($_SESSION['payroll'][0]);$i++)
                            {
                            
                            echo "<tr>";
                            
                            echo "<td>";
                            echo $_SESSION['payroll'][0][$i];
                            echo "</td>";
                            
                            
                            echo "<td>";
                            echo $_SESSION['payroll'][1][$i];
                            echo "</td>";

                            echo "<td>";
                            echo $_SESSION['payroll'][2][$i];
                            echo "</td>";                            



                            echo "<td>";
                            echo $_SESSION['payroll'][7][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $_SESSION['payroll'][8][$i];
                            echo "</td>";


                            
                            echo "</tr>";
                            //echo "----------------------------------------------";
                            
                            }
                            echo "</tbody>";

                            echo "</table>";
                            
                            



    

/*
$_SESSION['credit'];
$_SESSION['j_credit'];
$_SESSION['debit'];
$_SESSION['j_debit'];
$_SESSION['payroll'];
*/
?>






                            <div align="center" FONT FACE="arial" SIZE=3 >
                            
                            
                            <br><br>
                            </div>
                            
                            <div align="left" FONT FACE="arial" SIZE=3 >
                            
                            
                            <br><br>
                            </div>
                            
                            
                            
                            
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
















































                           
