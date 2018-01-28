                
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
                </head>
                <body>
                <!--login modal-->
                <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">Successfull recovery, please check your email</h1>
                <h1 class="text-center">and try again.</h1><br>
                <a href="../WEB_CUS_LOGIN.php">Back to Login</a>
                
                
                </div>
                <div class="modal-body">
                
                <div class="form-group" align="center">
        <IMG SRC="../resource/images/india.jpg" align="center" WIDTH=100% HEIGHT=140 BORDER=2 ALT="Bank Of India">
                
                <div class="form-group">
                
                <?php
                
                if(isset($_GET['error'])){
                $error = $_GET['error'];
                
                $color = "#FF0000"; //color a asignar
                echo "<p><font color='".$color."'>".$error."</font></p>";  
                
                }
                
                ?>
                
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
                <script src="resource/js/bootstrap.min.js"></script>
                </body>
                </html>