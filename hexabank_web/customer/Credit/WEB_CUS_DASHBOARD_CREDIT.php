                                                <?php
                                                /*!
                                                * This dasboard display all the account credit for the customer
                                                * @author Alan C. ,Ivan G., Axel Z. 
                                                * @version 0.1
                                                * @package 
                                                */
                                                
                                                
                                                
                                                //call the code from connect the oracle database
                                                include '../../config/config.php';
                                                //start the session from the customer
                                                session_start();
                                                //validate if the button was press send and, validate if the customer is correct
                                                if(empty($_SESSION['customer']) || !($_SESSION['customer'] == $_SESSION['nickname'])){
                                                  header("location:../WEB_CUS_LOGIN.php?error=Locked session, login again");
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
                                               <link href="../../resource/css/bootstrap.min.css" rel="stylesheet">
                                                                          
                                               <!-- Custom CSS -->
                                               <link href="../../resource/css/simple-sidebar.css" rel="stylesheet">
                                              
                                                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                                                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                                                <!--[if lt IE 9]>
                                                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                                                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                                                <![endif]-->
                                                
                                                </head>
                                                
                                                <body>
                                                
                                                <div align="center" id="wrapper">
                                                
                                                <!-- Sidebar -->
                                                <div id="sidebar-wrapper">
                                                <ul class="sidebar-nav">
                                                <li class="sidebar-brand">
                                                <a href="WEB_CUS_DASHBOARD.php">
                                                Hexabank
                                                </a>
                                                </a>
                                                </li>
                                                <li>
                                                <a href="../WEB_CUS_DASHBOARD.php">Back</a>
                                                </li>
                                                
                                                <li>
                                                <a href="../../php/WEB_CUS_LOGOUT.php">Log Out</a>
                                                </li>
                                                </ul>
                                                </div>
                                                <!-- /#sidebar-wrapper -->
                                                <!-- Page Content -->
                                                <div  align ="center"id="page-content-wrapper">
                                                <div class="container-fluid">
                                                <div class="row">
                                                <div class="col-lg-12">

                                               
                                                 <IMG SRC="../../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">

                                
                    
                              
                                                    <h1>
                                                    
                                                      <?php
                                                    //start code php
                                                    //print code variable nick name of customer
                                                    echo "<font color='blue'> Username: </font>";
                                                    echo $_SESSION['nickname'];
                                                    echo "<br>";
                                                    //print code variable id of customer 
                                                    echo "<font color='blue'> User ID: </font>";
                                                    echo $_SESSION['id_customer'];
                                                    echo "<br>";
                                                
                                                
                                                //start code php

                                                //print code variable nick name of customer
                                            
                                                
                                                
                                                //declare varible null1 empty
                                                $null1='';
                                                
                                                //declare a new cursor 
                                                $Cursor1= ocinewcursor($conn);
                                                //assigns the SP_SELECT_CREDIT to variable $sql1 from oracle database
                                                $sql1 = "CALL SP_SELECT_CREDIT(:creditId, :customerId , :result)";
                                                //decalre new variable that connect the variable $sql1
                                                $foo1 = oci_parse($conn,$sql1);
                                                oci_bind_by_name($foo1, ':creditId', $null1);
                                                oci_bind_by_name($foo1, ':customerId', $_SESSION['id_customer']);
                                                oci_bind_by_name($foo1, ':result', $Cursor1, -1, OCI_B_CURSOR);
                                                
                                                $null='';
                                                //execute the connection 
                                                $res1 = oci_execute($foo1);
                                                  //excecute the cursor
                                                $res1 = oci_execute($Cursor1);
                                                
                                                echo "<table class='table'>";
                                                echo "<thead>";
                                                echo " <tr>
                                                <td> Account Credit</td>
                                                <td> Credit limit</td>
                                                <td> Due Balance </td>
                                                <td> Payment</td>
                                                <td> Status</td>
                                                </tr>";
                                                echo "</thead>"; 

                                                // ocifetchstatement = Get multiple rows of a query and set in a bidimiensional array. By default, all rows are returned.
                                                $nrows1= ocifetchstatement($Cursor1,$data1,0,-1,OCI_NUM);

                                                echo "<tbody>";
                                                for ($i1=0; $i1 < $nrows1; $i1++)
                                                {
                                                
                                                echo "<tr>";
                                                //print account credit if exist data in the table credit 

                                                //print account credit 
                                                echo "<td>";
                                                echo $data1[0][$i1];
                                                echo "</td>";
                                                
                                                //print credit limit
                                                echo "<td>";
                                                echo $data1[2][$i1];
                                                echo "</td>";
                                                
                                                //print balance
                                                echo "<td>";
                                                echo $data1[3][$i1];
                                                echo "</td>";
                                                
                                                //print account expiration
                                                echo "<td>";
                                                echo $data1[4][$i1];
                                                echo "</td>";
                                                
                                                //print payment
                                                echo "<td>";
                                                echo $data1[5][$i1];
                                                echo "</td>";

                                                echo "<td>";
                                                echo $data1[11][$i1];
                                                echo "</td>";

                                                echo "</tr>";
                                                

                                                }

                                                echo "</tbody>";
                                                echo "</table>";

                                                echo "<br>";
                                                echo "<br>";
                                                echo "<font color='red'> Join Account: </font>";
                                                echo "<br>";
                                                
                                                //declare the variable $id_j_credit null
                                                $id_j_credit="";
                                                
                                                
                                                //create new cursor
                                                $Cursor= ocinewcursor($conn);
                                                //assigns the SP_SELECT_J_CREDIT to variable $sql from oracle database
                                                $sql = "CALL SP_SELECT_J_CREDIT(:p_id_credit, :p_id_customer , :resulta)";
                                                //create 
                                                $foo = oci_parse($conn,$sql);
                                                //recive parametrs and binds to variable 
                                                oci_bind_by_name($foo, ':p_id_credit', $id_j_credit);
                                                oci_bind_by_name($foo, ':p_id_customer', $_SESSION['id_customer']);
                                                oci_bind_by_name($foo, ':resulta', $Cursor, -1, OCI_B_CURSOR);
                                                
                                                
                                                //execute to varibale $foo
                                                $res = oci_execute($foo);
                                                //execute the cursor
                                                $res = oci_execute($Cursor);
                                                
                                               

                                                echo "<table class='table'>";
                                                echo "<thead>";
                                                echo " <tr>
                                                <td> <font color='red'> Owner: </font></td>
                                                <td> Account JCredit</td>
                                                <td> Credit Limit </td>
                                                <td> Due Balance</td>
                                                <td> Status</td>
                                                </tr>";
                                                echo "</thead>"; 

                                                echo "<tbody>";

                                                 // ocifetchstatement = Get multiple rows of a query and set in a bidimiensional array. By default, all rows are returned.
                                                $nrows= ocifetchstatement($Cursor,$data,0,-1,OCI_NUM);

                                                for ($i=0; $i < $nrows; $i++)
                                                {
                                                //print newline
                                                echo "<tr>";
                                                 //print account credit if exist data in the table credit 

                                                //print owner 
                                                
                                                echo "<td>";
                                                echo $data[1][$i];
                                                echo "</td>";
                                                
                                                //print account join credit
                                                echo "<td>";
                                                echo $data[0][$i];
                                                echo "</td>";
                                                
                                                //print account join  credit limit
                                                echo "<td>";
                                                echo $data[3][$i];
                                                echo "</td>";
                                                
                                                //print account join credit balance
                                                echo "<td>";
                                                echo $data[4][$i];
                                                echo "</td>";


                                                echo "<td>";
                                                echo $data[10][$i];
                                                echo "</td>";
                                                
                                                echo "</tr>";
                                                }

                                                echo "</tbody>";
                                                echo "</table>";
                             
                                                //close code php
                                                ?>
                                           


                                                <br>
                                                <div align="left" FONT FACE="arial" SIZE=3 >
                                                
                                                
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
                                               <script src="../../resource/js/jquery.js"></script>
                                               
                                               <!-- Bootstrap Core JavaScript -->
                                               <script src="../../resource/js/bootstrap.min.js"></script>
                                               
                                               <!-- Menu Toggle Script -->
                                               <script>
                                               $("#menu-toggle").click(function(e) {
                                               e.preventDefault();
                                               $("#wrapper").toggleClass("toggled");
                                               });
                                               </script>
                                               
                                               </body>
                                               
                                               </html>
