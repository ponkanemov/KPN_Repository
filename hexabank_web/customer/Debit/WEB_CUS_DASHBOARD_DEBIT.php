                            <?php
                            /*!
                            * This dasboard display all the account debit for the customer
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
                    header("location:../../WEB_CUS_LOGIN.php?error=Locked session, login again");
                    }
                            //close the code php
                            ?>
                            <!DOCTYPE html>
                            <html lang="en">
                            
                            <head>
                          
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta name="description" content="">
                            <meta name="author" content="">
                            
                            <title>HexaBank</title>
                            
                          
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
                            HEXABANK
                            </a>
                            </a>
                            </li>
                            <li>
                            
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
                            <div id="page-content-wrapper">
                            <div class="container-fluid">
                            <div class="row">
                            <div align="center" class="col-lg-12">

                           <IMG SRC="../../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">

                                
                    
                              
                            <h1>
                            
                              <?php
                            //start code php
                            //print code variable nick name of customer
                            echo "<font color='blue'> Username: </font>";
                            echo $_SESSION['nickname'];
                            echo "<br>";
                            echo "<br>";
                            echo "<font color='blue'> User ID: </font>";
                            echo $_SESSION['id_customer'];
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";

                            echo "<td> <font color='red'> Debit Accounts: </font></td>";
                            echo "<br>";
                            echo "<br>";
                            
                            //declare the variable $null empty
                            $null='';
                            
                            //decalre new cursor
                            $Cursor= ocinewcursor($conn);
                            //decalre stored procedure sp_select_debit from oracle database
                            $sql = "CALL SP_SELECT_DEBIT(:debitId, :customerId , :result)";
                            $foo = oci_parse($conn,$sql);
                            oci_bind_by_name($foo, ':debitId', $null);
                            oci_bind_by_name($foo, ':customerId', $_SESSION['id_customer']);
                            oci_bind_by_name($foo, ':result', $Cursor, -1, OCI_B_CURSOR);
                            
                            $null='';
                            //ejecuta el sp
                            $res = oci_execute($foo);
                            $res = oci_execute($Cursor);
                            
                            
                            echo "<table  class='table'>";
                                                    echo "<thead>";
                                                       echo " <tr> 
                                                <td> Account Debit</td>
                                                <td> Created on</td>
                                                <td> Balance Due</td>
                                                <td> Status </td>
                                                </tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                            $nrows= ocifetchstatement($Cursor,$data,0,-1,OCI_NUM);
                            for ($i=0; $i < $nrows; $i++)
                            {
                            echo "<tr>";

                            echo "<td>";
                            echo $data[0][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data[1][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data[2][$i];
                            echo "</td>";

                            echo "<td>";
                            echo $data[8][$i];
                            echo "</td>";                            

                            echo "</tr>";
                            //echo "----------------------------------------------------------";
                            
                            }
                            echo "</tbody>";
                            echo"</table>";



                            echo "<br>";
                            echo "<br>";
                            echo "<br>";

                            echo "<td> <font color='red'>JDebit Accounts: </font></td>";

                            echo "<br>";
                            echo "<br>";
                            
                            $id_j_debit="";
                            
                            
                            
                            $Cursor1= ocinewcursor($conn);
                            $sql1 = "CALL SP_SELECT_J_DEBIT(:p_id_j_debit, :p_id_customer , :resulta)";
                            $foo1 = oci_parse($conn,$sql1);
                            oci_bind_by_name($foo1, ':p_id_j_debit', $id_j_debit);
                            oci_bind_by_name($foo1, ':p_id_customer', $_SESSION['id_customer']);
                            oci_bind_by_name($foo1, ':resulta', $Cursor1, -1, OCI_B_CURSOR);
                            
                            
                            //ejecuta el sp
                            $res1 = oci_execute($foo1);
                            $res1 = oci_execute($Cursor1);
                            

                            
                            echo "<table class='table'>";
                                                echo "<thead>";
                                                       echo " <tr>
                                                <td> <font color='red'> Owner: </font></td>
                                                <td> Account JCreit ID</td>
                                                <td> Balance Due</td>
                                                <td> Main Account </td>
                                                <td> Status</td>
                                                </tr>";
                            echo "</thead>";
                            echo "<tbody>";


                            $nrows1= ocifetchstatement($Cursor1,$data1,0,-1,OCI_NUM);
                            for ($i1=0; $i1 < $nrows1; $i1++)
                            {
                            
                            echo "<tr>";

                            echo "<td>";
                            echo $data1[1][$i1];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data1[0][$i1];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data1[3][$i1];
                            echo "</td>";


                            echo "<td>";
                            echo $data1[4][$i1];
                            echo "</td>";


                            echo "<td>";
                            echo $data1[7][$i1];
                            echo "</td>";
                                
                            echo "</tr>";
                            }
                            
                            echo "</tbody>";
                            echo "</table>";
                            
                            
                            ?>

                        </h1> <br> 
                            <div align="left" FONT FACE="arial" SIZE=3 >
                            
                            </div>
                            
                            
                            
                            <br>
                            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Display More</a>
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

                            
