                
                <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta http-equiv="content-type" content="text/html; charset=UTF-8">
                <meta charset="utf-8">
                <title>Hexa-Bank Reset Password</title>
                
                <meta name="generator" content="Bootply" />
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                 <!-- Bootstrap Core CSS -->
                <link href="../resource/css/bootstrap.min.css" rel="stylesheet">
                            
                <!-- Custom CSS -->
                <link href="../resource/css/simple-sidebar.css" rel="stylesheet">
                  <style>
                                .mayuscula{  
                                   text-transform: lowercase;  
                                          }  
                            </style>
                </head>
                <body>
                <!--login modal-->
                <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                
                <h1 class="text-center">Forgot Password?</h1>
                
                
                
                </div>
                <div class="modal-body">
                <form class="form col-md-12 center-block" action="../php/WEB_CUS_FORGOTPASS.php" method="post" name="contact_form">
                <div class="form-group">
            
                
                <a href="../WEB_CUS_LOGIN.php">Back to login</a>
                <IMG SRC="../resource/images/india.jpg" align="center" WIDTH=100% HEIGHT=140 BORDER=2 ALT="Bank Of India">
                <?php
                
                if(isset($_GET['error'])){
                $error = $_GET['error'];
                
                $color = "#FF0000"; //color a asignar
                echo "<p><font color='".$color."'>".$error."</font></p>";  
                
                }
                ?>
                <input type="text" class="form-control input-lg"  name= "email"  id="exampleInputEmail3" required placeholder="E-mail">
                <div align="center">
                
                </div>
                </div>
                <div class="form-group">
                
                
                
                
                </div>
                <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" name="enviar">Send</button>
                
                </div>
                </form>
                </div>
                <div class="modal-footer">
                <div class="col-md-12">
                <!-- <input type="button" value="cerrar" onclick="self.close()" />  -->
                
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