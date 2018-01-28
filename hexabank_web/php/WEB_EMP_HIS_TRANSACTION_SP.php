                            <?php
                            include '../config/config.php';
                            session_start();


                 include 'general_Values.php';
                

        $nViewStates= $_SESSION['ndVariable'];
        //echo $nViewStates."<br>";
        $nameV="VIEWSTATE";
        $nPost=-2;
        foreach ($_POST as $name => $value) {
                        $nPost++;
                    }
                    if($nPost!=$nViewStates)
                    {
                         header("Location:../employees/WEB_EMP_DASHBOARD.php?error=ERROR");
                    }

        for ($i=1; $i <=$nViewStates ; $i++) { 
            $tnp=$nameV.$i;
            //echo $_POST[$tnp]." ";
            //echo $_SESSION[$tnp]."<br>";
            if(isset($_POST[$tnp]))
            {
                if($_SESSION[$tnp]!=$_POST[$tnp])
                {
                         header("Location:../employees/WEB_EMP_DASHBOARD.php?error=ERROR");
                }

            }else
            {
                 header("Location:../employees/WEB_EMP_DASHBOARD.php?error=ERROR");
            }
            
        } 
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
                            
                            </head>
                            
                            <body>
                            
                            <div align="center" id="wrapper">
                            
                            <!-- Sidebar -->
                            <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                            <li class="sidebar-brand">
                            <a href="../employees/WEB_EMP_HISTORY_TRANSACTIONS.php">
                            Hexabank
                            </a>
                            </a>
                            </li>
                            <li>
                            <a href="../employees/WEB_EMP_HISTORY_TRANSACTIONS.php">Back</a>
                            </li>
                            
                            <li>
                            <a href="../php/WEB_EMP_LOGOUT.php">Log Out</a>
                            </li>
                            </ul>
                            </div>
                            <!-- /#sidebar-wrapper -->
                            <!-- Page Content -->
                            <div align="center" id="page-content-wrapper">
                            <div class="container-fluid">
                            <div class="row">
                            <div class="col-lg-12">
                            <IMG SRC="../resource/images/logo.gif" align="center" WIDTH=200 HEIGHT=140 BORDER=2 ALT="Bank Of India">
                          
                            
                            <h1>
                            
                            
                            
                            
                            <?php
                            
                            /*
                            *This part of the code shows the Nickname employee and employee ID 
                            *with the session variables
                            */
                            echo "<font color='blue'> Username: </font>";
                            echo $_SESSION['nickname_emp'];
                            echo "<br>";
                            echo "<font color='blue'> Employee ID: </font>";
                            echo $_SESSION['id_employees'];
                            echo "<br>";
                            
                            
                            /*
                             *This part of the code first check if the Account exits
                             *and for this is used a stored procedure calls SP_check_account,
                             *if the account exists the Stored procedure return True or false.
                             *@param Varchar,
                             *
                             */
                                     $id_cuentaSource=$_POST['ID_CUENTA'];
                                     $id_cuentaSource=strtoupper($id_cuentaSource);
                                     $sql = "CALL SP_CHECK_ACCOUNT(:source, :result)";
                                     $foo = oci_parse($conn,$sql);
                                     oci_bind_by_name($foo, ':source',$id_cuentaSource);
                                     oci_bind_by_name($foo, ':result', $result);
                                     
                                     $res = oci_execute($foo); 
                                     
                                   if($result=='F')
                                     {
                                          header("Location:../employees/WEB_EMP_HISTORY_TRANSACTIONS.php?error= Wrong Account ");
                                     }else{
                            
                            //$null='';
                            $p_idd=$_POST['ID_CUENTA'];
                            $Cursor= ocinewcursor($conn);
                            $sql = "CALL SP_SELECT_TRANSACTIONS(:p_id, :result)";
                            $foo = oci_parse($conn,$sql);
                            oci_bind_by_name($foo, ':p_id', $p_idd);
                            oci_bind_by_name($foo, ':result', $Cursor, -1, OCI_B_CURSOR);
                            
                            //$null='';
                            //ejecuta el sp
                            $res = oci_execute($foo);
                            $res = oci_execute($Cursor);
                            
                            
                             echo "<table class='table'>";
                            echo "<thead>";
                            echo " <tr>
                             <td> Transaction Id</td>
                             <td> Account ID </td>
                             <td> Target: ID</td>
                             <td> Category</td>
                             <td> Amount</td>
                             <td> Created on</td>
                             <td> Way</td>
                             <td> Employee Id</td>
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
                            echo $data[3][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data[4][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data[5][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data[6][$i];
                            echo "</td>";
                            
                            echo "<td>";
                            echo $data[7][$i];
                            echo "</td>";

                            echo "</tr>";
                            
                            }
                            echo "</tbody>";
                            echo "<table>";

                            }
                            
                            
                            
                            
                            ?>
                            </h1> <br><br><br>
                            
                            
                            
                            <div align="center" FONT FACE="arial" SIZE=3 >
                            
                            
                            <br><br><br><br>
                            </div>
                            
                            
                            
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