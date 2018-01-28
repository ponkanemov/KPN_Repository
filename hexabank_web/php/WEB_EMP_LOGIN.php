                        <?php
                    include '../config/config.php';
   
                    session_start();
                    include 'general_Values.php';

                       
                    
                    if(!isset($_POST[$_SESSION['KEYFROMLOGIN']]))
                    {
                         
                          header("Location:../WEB_CUS_LOGIN.php?error=");
                              exit;
                    }
                    
                    $nick_emp = $_POST['nickname_emp'];
                    $pass_emp= $_POST['pass_emp'];

                    
                    




                    $id_employees = "###########################################";
                    
                    //calling to sp
                    $sql = "CALL SP_LOGIN_EMPLOYEE(:p_user_name, :p_password, :p_id, :p_message)";
                    $foo = oci_parse($conn,$sql);
                    oci_bind_by_name($foo, ':p_user_name', $nick_emp);
                    oci_bind_by_name($foo, ':p_password', $pass_emp);
                    oci_bind_by_name($foo, ':p_id', $id_employees);
                    oci_bind_by_name($foo, ':p_message', $message);
                    
                    //ejecuta el sp
                    $res = oci_execute($foo);
                    
                    //echo $foo;
                    
                  
                   
                    if($message == 'T')
                    {
                         
                       
                    $sql1 = "CALL SP_ISWORKING(:p_id, :p_result)";
                    $foo1 = oci_parse($conn,$sql1);
                    oci_bind_by_name($foo1, ':p_id', $id_employees);
                    oci_bind_by_name($foo1, 'p_result', $result);
                    
                    
                    $res1 = oci_execute($foo1);
                    
                    if($result == 'T'){
                    
                      if(isset($_SESSION['id_employees'])){
                        // echo "ya existe variable";

                       
                              header("Location:../WEB_EMP_LOGIN.php?error=A employee is currently already connected");
                              exit;
                         
                    }else{
                    $_SESSION['nickname_temp_emp']=$nick_emp;   
                    $_SESSION['nickname_emp']=$nick_emp;
                    $_SESSION['pass_emp']=$pass_emp;
                    $_SESSION['employees'] = $_SESSION['employees'];
                    $_SESSION['id_employees'] = $id_employees;
                    header ("Location:../employees/WEB_EMP_DASHBOARD.php");
                         
                    }

                    
                    }else{
                    
                    header("Location:../WEB_EMP_LOGIN.php?error=Employee Is Not Working");
                    }
                    
                    
                    }else{
                    header("Location:../WEB_EMP_LOGIN.php?error=Employee Not Found");
                    }
                    
                    
                    /*

if($result == 'T'){
                    $_SESSION['employee'] = $_SESSION['nickname'];
                    header ("Location:../employees/WEB_EMP_MENU.php");
                    }else{
                    header("Location:../WEB_EMP_LOGIN.php?error=Employee Is Not Working");
                    
                    }
                    
                    }else{
                    header("Location:../WEB_EMP_LOGIN.php?error=Employee Not Found ");
                    
                    }
                    */
                    
                    ?>
                    
                    
              