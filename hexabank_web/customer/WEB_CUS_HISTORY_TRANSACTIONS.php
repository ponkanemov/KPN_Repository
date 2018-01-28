                             <?php
                             include '../config/config.php';
                             session_start();
                            
                             
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
                             <div id="page-content-wrapper">
                             <div class="container-fluid">
                             <div class="row">
                             <div class="col-lg-12">

                            <IMG SRC="../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">

                            
                             <h1>

                             <?php
                             
                             echo "<font color='blue'> Username: </font>";
                             echo $_SESSION['nickname'];
                             echo "<br>";
                             echo "<font color='blue'> User ID: </font>";
                             echo $_SESSION['id_customer'];
                             echo "<br>";
                              echo "<br>";
                             if(isset($_GET['error'])){
                             $error = $_GET['error'];
                             $color = "red"; //color a asignar
                             echo "<p><font color='".$color."'>".$error."</font></p>";  
                             
                             }
               
                             ?>

                             </h1>
                             
                             
                             <form action="../php/WEB_CUS_HIS_TRANSACTION_SP.php" method="POST" name="search_cus_form">
                        <h1><td>Account ID</td><br></h1>
                        
                         <td>
                         <select name="ID_CUENTA">
                         <option selected required value=""  > SELECT YOUR ACCOUNT ID </option>
                         <?php 
                         include 'config/config.php';
                        
                            
                            $Cursor= ocinewcursor($conn);
                            $sql = "CALL SP_SELECT_ACCOUNTS_BY_ID(:p_id_customer, :p_result)";
                            $foo = oci_parse($conn,$sql);
                            oci_bind_by_name($foo, ':p_id_customer', $_SESSION['id_customer']);
                            oci_bind_by_name($foo, ':p_result', $Cursor, -1, OCI_B_CURSOR);


                            
                          
                            //ejecuta el sp
                            $res = oci_execute($foo);
                            $res = oci_execute($Cursor);
                            
                            
                            
                            $nrows= ocifetchstatement($Cursor,$data,0,-1,OCI_NUM);
                            if($nrows > 0){

                            
                            //var_dump($data);
                            for ($i=0; $i < $nrows; $i++)
                            {
                            

                              echo "<option value ='".$data[0][$i]."'>".$data[0][$i]."</option>";
                           

                              }
                              }
                              ?>
                              </select><br><br><h1>
                              Pin <br> <br><input type="PASSWORD" maxlength="4" name="NIP" id="textfield"placeholder="WRITE YOUR ACCOUNT PIN" ><br><br>
                             
                            <?php
                            $ndVariable= rand(10,25);
                            $dName = "VIEWSTATE";
                            $dCount = 1;
                            $_SESSION['ndVariable'] = $ndVariable;


                           // echo $_SESSION['ndVariable'];

                            for( $i=1; $i<=$ndVariable; $i++ ){
                                echo "<p>";
                                $tmpName = $dName.$i;
                                
                                $id_rand= rand($_SESSION['MINRANGE'],$_SESSION['MAXRANGE']);  
                                $id_rand=str_pad($id_rand,$_SESSION['LENGTH'],"0",STR_PAD_LEFT);
                                
                                $_SESSION[$tmpName] = $id_rand;
                                
                               // echo $_SESSION[$tmpName];
                                ?>
                                <input type="hidden" name="<?php echo $tmpName;?>" value="<?php echo $_SESSION[$tmpName]?>" >  
                                <?php
                                echo "</p>";

                            }

                            ?>
                             
                             <!-- Customer Name <input  type="text" name="text_customer_name" id="textfield">-->
                             <input type="submit" name="Search_btn" value="Search">

                             
                             </form>
                             
                             <div align="left" FONT FACE="arial" SIZE=3 >
                             
                             
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