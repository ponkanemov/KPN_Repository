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
							
							
								unset($_SESSION['credit']);
								unset($_SESSION['j_credit']);
								unset($_SESSION['debit']);
								unset($_SESSION['j_debit']);
								unset($_SESSION['payroll']);
							
                            if(empty($_SESSION['search']) || !($_SESSION['search']="showResult")){
                            header("location:../employees/WEB_EMP_DASHBOARD.php");
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
                            <div class="col-lg-12">

                            <IMG SRC="../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">
                            <h1>

                            

                             <?php
                              echo "<font color='blue'> Username: </font>";
                            echo $_SESSION['nickname_emp'];
                            echo "<br>";
                            echo "<font color='blue'> Employee ID: </font>";
                            echo $_SESSION['id_employees'];
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";
								 $data=$_SESSION['cursor'];
					                    echo" <table class='table'>
								  		<thead>
										<tr>
										<td> Customer ID</td>
										<td> Customer Name</td>
										<td> Customer Last Name</td>
										<td> Day of Birth</td>
                                        <td> Status</td>
										</tr>
                                        </thead>";
								  echo "<tbody>";
								  for($i=0; $i<count($data);$i++){
                                 		$data[$i][10]=trim($data[$i][10]);
										//if($data[$i][11]=='T'){
											echo "<tr>
											<td> <a href='../php/SEARCH_EMP_CUS_INFORMATION.php?id_cust_emp=".$data[$i][0]."'>".$data[$i][0]."</a></td>
											<td> "	.$data[$i][1]."</td>
											<td>".$data[$i][2]."</td>
											<td>".$data[$i][5]."</td>
                                            <td>".$data[$i][11]."</td>
											</tr>";
                                        //}
								 }
                                 echo "</tbody>";
								 echo "</table>";
								 
                                 ?>          
                            
                            <div align="left" FONT FACE="arial" SIZE=3 >
                            
                            </h1>
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
