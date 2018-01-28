                                     <?php
                                     include '../config/config.php';
                                     session_start();

                                    include 'general_Values.php';

        $nViewStates= $_SESSION['ndVariable'];
        //echo $nViewStates."<br>";
        $nameV="VIEWSTATE";
        $nPost=-3;
        foreach ($_POST as $name => $value) {
                        $nPost++;
                    }
                    if($nPost!=$nViewStates)
                    {
                         header("Location:../CUSTOMER/WEB_CUS_DASHBOARD.php?error=ERROR");
                    }

        for ($i=1; $i <=$nViewStates ; $i++) { 
            $tnp=$nameV.$i;
            //echo $_POST[$tnp]." ";
            //echo $_SESSION[$tnp]."<br>";
            if(isset($_POST[$tnp]))
            {
                if($_SESSION[$tnp]!=$_POST[$tnp])
                {
                         header("Location:../CUSTOMER/WEB_CUS_DASHBOARD.php?error=ERROR");
                }

            }else
            {
                 header("Location:../CUSTOMER/WEB_CUS_DASHBOARD.php?error=ERROR");
            }
            
        } 




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
                                     
                                     </head>
                                     
                                     <body>
                                     
                                     <div  align="center" id="wrapper">
                                     
                                     <!-- Sidebar -->
                                     <div id="sidebar-wrapper">
                                     <ul class="sidebar-nav">
                                     <li class="sidebar-brand">
                                     <a href="../WEB_CUS_DASHBOARD.php">
                                     Hexabank
                                     </a>
                                     </a>
                                     </li>
                                     <li>
                                     <a href="../CUSTOMER/WEB_CUS_HISTORY_TRANSACTIONS.php">Back</a>
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
                                     
                                     
                                     
                                     $id_customer = $_SESSION['id_customer'];
                                     $id_cuentaSource=$_POST['ID_CUENTA'];
                                     $id_cuentaSource=strtoupper($id_cuentaSource);
                                     
                                     $sql = "CALL SP_CHECK_ACCOUNT_ONLINE(:p_source,:source, :result)";
                                     $foo = oci_parse($conn,$sql);
                                     oci_bind_by_name($foo, ':p_source',$id_customer);
                                     oci_bind_by_name($foo, ':source',$id_cuentaSource);
                                     oci_bind_by_name($foo, ':result', $result);
                                     
                                     $res = oci_execute($foo); 
                                     
                                     if($result=='T')
                                     {
                                     
                                     
                                     
                                     $id_cuenta= $_POST['ID_CUENTA'];
                                     $id_cuenta=strtoupper($id_cuenta);
                                     $nip=$_POST['NIP'];

                                     
                                     
                                     //checar el NIP
                                     $sql = "CALL SP_CHECKNIP(:p_source,:p_nip, :p_result)";
                                     $foo = oci_parse($conn,$sql);
                                     oci_bind_by_name($foo, ':p_source', $id_cuenta);
                                     oci_bind_by_name($foo, ':p_nip', $nip);
                                     oci_bind_by_name($foo, ':p_result', $result);
                                     
                                     $res = oci_execute($foo); 
                                     
                                     
                                     
                                     //DESPLEGAR TODAS LAS TRANSACCIONES RELACIONADAS
                                     if($result == 'T')
                                     {
                                     

                                     $p_idd=$_POST['ID_CUENTA'];
                                     $p_idd = strtoupper($p_idd);
                                     $Cursor= ocinewcursor($conn);
                                     $sql = "CALL SP_SELECT_TRANSACTIONS(:p_id, :result)";
                                     $foo = oci_parse($conn,$sql);
                                     oci_bind_by_name($foo, ':p_id', $p_idd);
                                     oci_bind_by_name($foo, ':result', $Cursor, -1, OCI_B_CURSOR);
                                     
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

                                     echo "</tr>";
                                     
                                     }
                                     
                                     echo "</tbody>";
                                     echo "</table>";

                                     }else{
                                     header("Location:../customer/WEB_CUS_HISTORY_TRANSACTIONS.php?error=Wrong NIP  ");
                                     }
                                     }else{
                                     header("Location:../customer/WEB_CUS_HISTORY_TRANSACTIONS.php?error=The Current Account Does Not Belong");
                                     }
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     
                                     ?>
                                     </h1> <br><br><br>
                                     
                                     
                                     
                                     <div align="left" FONT FACE="arial" SIZE=3 >
                                     
                                     
                                     <br><br><br><br>
                                     </div>
                                     
                                     
                                     
                                     <br><br><br><br>
                                     <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Display More</a>
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