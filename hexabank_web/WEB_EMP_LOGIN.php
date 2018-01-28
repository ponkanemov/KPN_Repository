                    <!DOCTYPE html>
               <html lang="en">
               <head>
               <meta http-equiv="content-type" content="text/html; charset=UTF-8">
               <meta charset ="utf-8">
               <title>Tlaxi - Acceso a PE</title>
               
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
            
               <h1 class="text-center"><strong>Acceso a PE</strong></h1>

               </div>
               <div class="modal-body">
               <form class="form col-md-12 center-block" action="php/WEB_EMP_LOGIN.php" method="post" name="contact_form">
               <div class="form-group">
               <label><strong>Correo electrónico:</strong></label>
               <input type="text" class="form-control input-lg"  name= "nickname_emp"  id="exampleInputEmail3" maxlength='50' required placeholder="Escriba su usuario">
               </div>
               <div class="form-group">
               <label><strong>Contraseña:</strong></label>
               <input type="password" name="pass_emp" class="form-control input-lg" id="exampleInputPassword3" maxlength='50' required placeholder="Password">
               <input type="hidden" name="<?php echo $id_rand; ?>" value="<?php echo session_id(); ?>">
               <?php $_SESSION['KEYFROMLOGIN']=$id_rand; ?>
               </div>
               <div class="form-group">
                    
               <button class="btn btn-primary btn-lg btn-block" name="enviar">Acceder</button>
               <div align="center">
                 <h1><a href="MENU_PRINCIPAL.php">Recuperar contraseña</a></h1>
                 </span></div>
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