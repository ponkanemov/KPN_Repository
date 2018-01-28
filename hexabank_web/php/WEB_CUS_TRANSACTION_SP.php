        <?php
        include '../config/config.php';

        session_start();
        include 'general_Values.php';


 $nViewStates= $_SESSION['ndVariable'];
        echo $nViewStates."<br>";
        $nameV="VIEWSTATE";
        $nPost=-4;
        foreach ($_POST as $name => $value) {
                        $nPost++;
                        
                    }
                    if($nPost<$nViewStates)
                    {
                         header("Location:../customer/WEB_CUS_DASHBOARD.php?error=ERROR");
                         exit;
                    }
                     if($nPost>$nViewStates)
                    {
                         header("Location:../customer/WEB_CUS_DASHBOARD.php?error=ERROR");
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
                         header("Location:../WEB_CUS_DASHBOARD.php?error=ERROR");
                }

            }else
            {
                 header("Location:../WEB_CUS_DASHBOARD.php?error=ERROR");
            }
            
        } 

               /* echo $_SESSION['CURRENTSESSION'.$_SESSION['KEY']];
                
                 echo $_SESSION['pass'.$_SESSION['KEY']];
                    echo "<br>";
                    echo $_SESSION['nickname'.$_SESSION['KEY']];
                    echo "<br>";
                   echo session_id(); 
                   echo "<br>";
                   echo  $_SESSION['CURRENTSESSION'.$_SESSION['KEY']];

                    echo $_POST[$_SESSION['CURRENTSESSION'.$_SESSION['KEY']]];
                     
                    foreach ($_POST as $name => $value) {
                        echo htmlspecialchars($name.",".$value)."......";
                    }
                   */
                    //echo $_POST["CURRENTSESSION".$_SESSION['KEY']];
                



        /*
         * This part of the code first check if the Account exits
         * and for this is used a stored procedure calls SP_check_account,
         * if the account exists the Stored procedure return True or false.
         * @param Varchar,
         *
         */
      
                 $id_customer = $_SESSION['id_customer'];
                     $sql1 = "CALL SP_ISACTIVE(:p_id, :p_result)";
                    $foo1 = oci_parse($conn,$sql1);
                    oci_bind_by_name($foo1, ':p_id', $id_customer);
                    oci_bind_by_name($foo1, 'p_result', $result);
                    $res1 = oci_execute($foo1);
                    if($result == 'T'){      
                    


        $id_customer = $_SESSION['id_customer'];
        $sql = "CALL SP_CHECK_ACCOUNT_ONLINE(:p_source,:source, :result)";
        $foo = oci_parse($conn, $sql);
        $source = $_POST['source'];
        $ssource = strtoupper($source);
        oci_bind_by_name($foo, ':p_source', $id_customer);
        oci_bind_by_name($foo, ':source', $ssource);
        oci_bind_by_name($foo, ':result', $result);

        $res = oci_execute($foo);

        if ($result == 'T') 
        {
            /* This part of the code first check if the Target Account exits
             * and for this is used a stored procedure calls SP_check_account,
             * if the account exists the Stored procedure return True or false.
             * @param Varchar,
             *
             */
            $sql = "CALL SP_CHECK_ACCOUNT(:source, :result)";
            $foo = oci_parse($conn, $sql);
            $source = strtoupper($_POST['target']);
            $ssource = strtoupper($source);
            oci_bind_by_name($foo, ':source', $ssource);
            oci_bind_by_name($foo, ':result', $result);



            $res = oci_execute($foo);
            if ($result == 'F') {

                header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=Account Target Doesn´t Exist ");
            } else {

                /*
                 * This part of the code confirm if the account has enough founds
                 * and for this is used a stored procedure calls SP_check_amount,
                 * if the amount is correct the Stored procedure return True or false.
                 * @param varchar,number,
                 *
                 */

                $result = ####################.####;
                
                $idd = $_POST['source'];
                $idd = strtoupper($idd);

                
                $amountt = $_POST['amount']; 
                /*
                 $amountt = number_format($amountt,2,",",".");


                $validarN = $_POST['amount'];
                $validarN = floatval($validarN);
               
                if($validarN < 0)
                {
                    header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=do not write negative numbers ");
               }else{
              
*/              
                

                        $sql = "CALL SP_CHECK_BALANCE(:id, :amount, :resulta)";
                $foo = oci_parse($conn, $sql);
                oci_bind_by_name($foo, ':id', $idd);
                oci_bind_by_name($foo, ':amount', $amountt);
                oci_bind_by_name($foo, ':resulta', $result);
                $res = oci_execute($foo);

                echo gettype($amountt);
                echo "<br>";
                echo $amountt;
                echo "<br>";
                echo $result;
                
                

                if ($result == 'T') {

                    /*
                     * This part of the code checks if the account's NIP is correct
                     * and for this is used a stored procedure calls SP_TRANSACT_TRANSFER_ONLINE,
                     * if the NIP is correct the Stored procedure return True or false.
                     * Then Updates the data base with respect to the data provided.
                     * @param Varchar,number
                     *
                     */

                      //$id_employee = null;
                    //$result = null;

                    $ssource = $_POST['source'];
                    $ssource = strtoupper($ssource);
                    $amountt = $_POST['amount'];
                    //$amountt = number_format($amountt,2,",",".");
                    $pinn = intval($_POST['pin']);
                    $targett = $_POST['target'];
                    $targett = strtoupper($targett);
                  
                    $sql = "BEGIN SP_TRANSACT_TRANSFER_ONLINE(:source,:amount,:nip,:target,'',:result); END;";
                    $foo = oci_parse($conn, $sql);
                    oci_bind_by_name($foo, ':source', $ssource);
                    oci_bind_by_name($foo, ':amount', $amountt);
                    oci_bind_by_name($foo, ':nip', $pinn);
                    oci_bind_by_name($foo, ':target', $targett);
                    oci_bind_by_name($foo, ':result', $result);

                 

  //Here checks if the main account and the final account are the same and if is true throws a error message
                    if ($ssource == $targett) {
                        header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=The Account and Target can´t be the same");
                    } else {
                        $res = oci_execute($foo);
                        if ($result == 'T') {

                            header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=Successful Transfer");
                        } else {
                            //if the PIN is wrong throw error message


                            header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=Wrong Pin");
                        }
                    }


                    //if doesn't have enough founds throw error message
               } else {
                    header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=Wrong Amount");
                }
            }
       // }
        } else {

            //if the account is wrong , throw error message
            header("Location:../customer/WEB_CUS_TRANSACTIONS.php?error=The Current Account Does Not Belong");
        }
    }else{
        header("Location:../WEB_CUS_LOGIN.php?error=Customer Is Not Active");
    }

 
        ?>