                            <?php
                            include '../config/config.php';
                            session_start();
                            include '../php/general_Values.php';


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
                            
                            <div  align="center"id="wrapper">
                            
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
                            
                            
                            <div class="row" >
                            <div align="center" class="col-lg-12" align="left">
                            
                            <IMG SRC="../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">
                            
                                                        
                          
                            <h1>
                            <?php
                            
                            
                            echo "<font color='blue'> Username: </font>";
                            echo $_SESSION['nickname_emp'];
                            echo "<br>";
                            echo "<font color='blue'> Employee ID: </font>";
                            echo $_SESSION['id_employees'];
                            echo "<br>";
                            
                            
                            if(isset($_GET['error'])){
                            $error = $_GET['error'];
                            $color = "red"; //color a asignar
                            echo "<p><font color='".$color."'>".$error."</font></p>";  
                            
                            }
                            
                            ?>
                            
                            </h1>
                            <form class="" action="../php/WEB_EMP_TRANSACTION_SP.php" method="POST" name="contact_form">  
                            
                            <div align="center" FONT FACE="arial" SIZE=3 >
                            <h1>Account<br><input class="mayuscula"type="text" size="20"  maxlength="16"  placeholder="Must be an account" name="source"  ></h1> 
                            <h1>Pin<br><input type="password" size="4" maxlength="4" placeholder=""  name="pin" pattern="[0-9]{4,4}" ></h1> 
                            <h1>Amount<br><input type="text" size="10" maxlength="30" placeholder="$" name="amount"  ></h1>         
                            <h1>Target account <br><input class="mayuscula" type="text" name="target" size="20" maxlength="16" placeholder="Must be a target"  >
                          
                            
                            <div align="left" FONT FACE="arial" SIZE=3 >
                            
                            
                            <br><br>
                            </div>
                            <?php
                            $ndVariable= rand(10,25);
                            $dName = "VIEWSTATE";
                            $dCount = 1;
                            $_SESSION['ndVariable'] = $ndVariable;


                           // echo $_SESSION['ndVariable'];

                            for( $i=1; $i<=$ndVariable; $i++ ){
                                echo "<p id = Variablerandom (qwe23)>";
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
                            
                            
                            
                            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Display Menu</a>
                            
                            <input type="submit" class="btn btn-default" value="Send">
                            </form>
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