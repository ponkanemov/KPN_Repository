                    <?php
                    include '../config/config.php';
                    session_start();
                    include 'general_Values.php';
   
                    
                    if(!isset($_POST[$_SESSION['KEYFROMLOGIN']]))
                    {
                         
                          header("Location:../WEB_CUS_LOGIN.php?error=");
                              exit;
                    }

                    $nick_cus = $_POST['nickname'];
                    $pass_cus= $_POST['pass'];

                 
                    
                    $id_customer = "###########################################";
                    
                    
                    //String which willl be called to the database
                    $sql = "CALL SP_LOGIN_CUSTOMER(:p_user_name, :p_password, :p_id, :p_message)";

                    //It prepares the query and merges the parameter to variable
                    $foo = oci_parse($conn,$sql);
                    oci_bind_by_name($foo, ':p_user_name', $nick_cus);
                    oci_bind_by_name($foo, ':p_password', $pass_cus);
                    oci_bind_by_name($foo, ':p_id', $id_customer);
                    oci_bind_by_name($foo, ':p_message', $message);
                    
                    //execute the connection 
                    $res = oci_execute($foo);
                    
                    /*echo $nick_cus."<br>";
                    echo $pass_cus."<br>";
                    echo $id_customer."<br>";
                    echo $message."<br>";
                    exit;*/

                    if($message == 'T')
                    {
                    $sql1 = "CALL SP_ISACTIVE(:p_id, :p_result)";
                    $foo1 = oci_parse($conn,$sql1);
                    oci_bind_by_name($foo1, ':p_id', $id_customer);
                    oci_bind_by_name($foo1, 'p_result', $result);
                    $res1 = oci_execute($foo1);

                    if($result == 'T'){
    
                    if(isset($_SESSION['id_customer'])){
                        // echo "ya existe variable";

                       
                              header("Location:../WEB_CUS_LOGIN.php?error=A user is currently already connected");
                              exit;
                     
                         
                    }else{

                    /*

                    $id_rand= rand($_SESSION['MINRANGE'],$_SESSION['MAXRANGE']);  
                    $id_rand=str_pad($id_rand,$_SESSION['LENGTH'],"0",STR_PAD_LEFT);
                    
                                        echo $id_rand;
                    echo "<br>";
                    */
                    //session_id($id_rand);

                    /*
                    $_SESSION['KEY']=$id_rand;
                    $_SESSION['CURRENTSESSION'.$id_rand]=session_id();
                    $_SESSION['nickname'.$id_rand]=$nick_cus;
                    $_SESSION['pass'.$id_rand]=$pass_cus;
                    
                   
                    echo $_SESSION['pass'.$_SESSION['CURRENTSESSION']];
                    echo "<br>";
                    echo $_SESSION['nickname'.$_SESSION['CURRENTSESSION']];
                    */

                    
                    $_SESSION['nickname_temp']=$nick_cus;   
                    $_SESSION['nickname']=$nick_cus;
                    $_SESSION['pass']=$pass_cus;
                    $_SESSION['customer'] = $_SESSION['nickname'];
                    $_SESSION['id_customer'] = $id_customer;

                
                  //echo $si;
                  //exit;
                    header ("Location:../customer/WEB_CUS_DASHBOARD.php");
                         
                    }

                    
                    }else{
                    
                    header("Location:../WEB_CUS_LOGIN.php?error=Customer Is Not Active");
                    }
                    
                    
                    }else{
                    header("Location:../WEB_CUS_LOGIN.php?error=Customer Not Found");
                    }
                    
 
                    ?>