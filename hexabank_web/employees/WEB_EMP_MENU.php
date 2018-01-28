                               <?php
                            include '../config/config.php';
                            session_start();
                          
                     if(!($_SESSION['nickname_temp_emp'] == $_SESSION['nickname_emp'])){
                                header("location:../WEB_CUS_LOGIN.php?error=Locked session, login again");
                              
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
                  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
                  <meta charset="utf-8">
                  <title>Hexa-Bank</title>
                  <meta name="generator" content="Bootply" />
                  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                  <!-- Bootstrap Core CSS -->
                  <link href="../resource/css/bootstrap.min.css" rel="stylesheet">
                                                        
                  <!-- Custom CSS -->
                  <link href="../resource/css/simple-sidebar.css" rel="stylesheet">

                  </head>
                  <body>
                  <!--login modal-->
                  <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                  
                  <h1 class="text-center">Menu Employees</h1>
                  <IMG SRC="../resource/images/india.jpg" WIDTH="100%" HEIGHT=180 BORDER=2 ALT="Bank Of India">
                  <h1> 
                  <?php
                  echo "<font color='blue'> Welcome  </font>";
                            echo $_SESSION['nickname_emp'];
                            echo "<br>";
                           
                  ?>
                </h1>
                  </div>
                  <div class="modal-body">
                  <form class="form col-md-12 center-block" align ="center" action="../php/WEB_EMP_VALIDATION_MENU.php" method="post" name="contact_form" >
                  <div class="form-group">
                  
                  </div>
                  <div class="form-group">
                  
                  </div>
                  <div class="form-group" >
                  
                  <button class="btn btn-primary btn-lg btn-block"  name="version_web" value="version_web">Web Version</button>
                                    <button class="btn btn-primary btn-lg btn-block"  name="version_app" value="version_app">Desktop Version</button>


                  <!--<br><a href="C:\Program Files (x86)\Mozilla Firefox\firefox.exe">Aplication Version</a>-->
                  <br>
                  
                  
                  
                  </div>
                  </form>
                  </div>
                  <div class="modal-footer">
                  <div class="col-md-12">
                  
                  
                  </div>	
                  </div>
                  </div>
                  </div>
                  </div>
                  <!-- script references -->
                  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                  <script src="js/bootstrap.min.js"></script>
                  </body>
                  </html>