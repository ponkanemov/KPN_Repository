        <?php
        include '../config/config.php';
        session_start();


$nViewStates= $_SESSION['ndVariable'];
        echo $nViewStates."<br>";
        $nameV="VIEWSTATE";
        $nPost=-4;
        foreach ($_POST as $name => $value) {
                        $nPost++;
                    }
                    if($nPost < $nViewStates)
                    {
                         header("Location:../employees/WEB_EMP_DASHBOARD.php?error=ERROR");
                         exit;
                    }
                        if($nPost>  $nViewStates)
                    {
                         header("Location:../employees/WEB_EMP_DASHBOARD.php?error=ERROR");
                         exit;
                    }

        for ($i=1; $i <=$nViewStates ; $i++) { 
            $tnp=$nameV.$i;
            echo $_POST[$tnp]." ";
            echo $_SESSION[$tnp]."<br>";
            if(isset($_POST[$tnp]))
            {
                if($_SESSION[$tnp]!=$_POST[$tnp])
                {
                         header("Location:../WEB_EMP_DASHBOARD.php?error=ERROR");
                }

            }else
            {
                 header("Location:../WEB_EMP_DASHBOARD.php?error=ERROR");
            }
            
        } 
















        $id_employees = $_SESSION['id_employees'];
        $sql1 = "CALL SP_ISWORKING(:p_id, :p_result)";
        $foo1 = oci_parse($conn, $sql1);
        oci_bind_by_name($foo1, ':p_id', $id_employees);
        oci_bind_by_name($foo1, 'p_result', $result);


        $res1 = oci_execute($foo1);

        $_SESSION['id_employees'] = $id_employees;

        if ($result == 'T') {

            $sql = "CALL SP_CHECK_ACCOUNT(:source, :result)";
            $foo = oci_parse($conn, $sql);
            $source = strtoupper($_POST['source']);

            oci_bind_by_name($foo, ':source', $source);
            oci_bind_by_name($foo, ':result', $result);

            $res = oci_execute($foo);

            if ($result == 'T') {

                $sql = "CALL SP_CHECK_ACCOUNT(:source, :result)";
                $foo = oci_parse($conn, $sql);
                $source = strtoupper($_POST['target']);
                oci_bind_by_name($foo, ':source', $source);
                oci_bind_by_name($foo, ':result', $result);

                $res = oci_execute($foo);


                if ($result == 'T') {

                    $idd = $_POST['source'];
                    $source = strtoupper($idd);
                    $amountt = $_POST['amount'];
                    //$amountt = number_format($amountt, 2, ",", ".");

                    $result = null;
/*
                    $validarN = $_POST['amount'];
                    $validarN = floatval($validarN);

                    if ($validarN < 0) {
                        header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=Do not write negatives numbers");
                    } else {
*/



                        $sql = "BEGIN SP_CHECK_BALANCE(:id, :amount, :resulta); END;";
                        $foo = oci_parse($conn, $sql);
                        oci_bind_by_name($foo, ':id', $source);
                        oci_bind_by_name($foo, ':amount', $amountt);
                        oci_bind_by_name($foo, ':resulta', $result);
                        $res = oci_execute($foo);




                        if ($result == 'T') {



                            $ssource = strtoupper($_POST['source']);
                            $amountt = $_POST['amount'];
                            //$amountt = number_format($amountt, 2, ",", ".");
                            $pinn = intval($_POST['pin']);
                            $targett = $_POST['target'];
                            $targett = strtoupper($targett);





                            $sql = "BEGIN SP_TRANSACT_TRANSFER_ONLINE(:source,:amount,:nip,:target,:id_employee,:result); END;";
                            $foo = oci_parse($conn, $sql);
                            oci_bind_by_name($foo, ':source', $ssource);
                            oci_bind_by_name($foo, ':amount', $amountt);
                            oci_bind_by_name($foo, ':nip', $pinn);
                            oci_bind_by_name($foo, ':target', $targett);
                            oci_bind_by_name($foo, ':id_employee', $id_employee);
                            oci_bind_by_name($foo, ':result', $result);






                            if ($ssource == $targett) {
                                header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=The Account and Target can´t be the same");
                            } else {
                                $res = oci_execute($foo);
                                if ($result == 'T') {

                                    header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=Successful Transaction");
                                } else {
                                    //if the PIN is wrong throw error message
                                    header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=Wrong Pin");
                                }
                            }
                        } else {

                            header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=amount wrong");
                        }
                   // }
                } else {
                    header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=target wrong");
                }
            } else {
                //if the account is wrong , throw error message
                header("Location:../employees/WEB_EMP_TRANSACTIONS.php?error=Account Source Doesn´t Exist");
            }
        } else {

            header("Location:../WEB_EMP_LOGIN.php?error=Employee Is Not Working");
        }
        ?>