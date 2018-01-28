
               <!DOCTYPE html>
               <html lang="en">
               <head>
               <meta http-equiv="content-type" content="text/html; charset=UTF-8">
               <meta charset ="utf-8">
               <title>Hexa-Bank login</title>
               
               <meta name="generator" content="Bootply" />
               <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
               <link href="resource/css/bootstrap.min.css" rel="stylesheet">
               <!--[if lt IE 9]>
               <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
               <![endif]-->
               <link href="resoruce/css/styles.css" rel="stylesheet">
               </head>
               <body>
               <!--login modal-->
               <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog">
               <div class="modal-content">
               <div class="modal-header">
            
               <h1 class="text-center">Login Employees</h1>
               <a href="WEB_CUS_LOGIN.php">Module Customers?</a></span>
               
               <IMG SRC="resource/images/india.jpg" WIDTH="100%" HEIGHT=180 BORDER=2 ALT="Bank Of India">
               <?php
               
               if(isset($_GET['error'])){
               $error = $_GET['error'];
               
               $color = "#FF0000"; //color a asignar
               echo "<p><font color='".$color."'>".$error."</font></p>";  
               
               }
                    $id_rand= rand($_SESSION['MINRANGE'],$_SESSION['MAXRANGE']);  
                    $id_rand=str_pad($id_rand,$_SESSION['LENGTH'],"0",STR_PAD_LEFT);
               ?>
               </div>
               <div class="modal-body">
               <form class="form col-md-12 center-block" action="php/WEB_EMP_LOGIN.php" method="post" name="contact_form">
               <div class="form-group">
               <input type="text" class="form-control input-lg"  name= "nickname_emp"  id="exampleInputEmail3" maxlength='50' required placeholder="Username">
               </div>
               <div class="form-group">
               <input type="password" name="pass_emp" class="form-control input-lg" id="exampleInputPassword3" maxlength='50' required placeholder="Password">
               <input type="hidden" name="<?php echo $id_rand; ?>" value="<?php echo session_id(); ?>">
               <?php $_SESSION['KEYFROMLOGIN']=$id_rand; ?>
               </div>
               <div class="form-group">
                    
               <button class="btn btn-primary btn-lg btn-block" name="enviar">Sign In</button>
               
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