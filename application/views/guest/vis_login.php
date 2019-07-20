<!DOCTYPE html>
<!-- saved from url=(0041)https://getbootstrap.com/examples/signin/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Login | Horario</title>

  </head>

  <body>

    <div class="container">

              
                <form class="form-horizontal" id="login" action="<?=base_url('Con_login/ingresar');?>" method="POST"> <!--Envia al controlador Con_login funcion ingresar-->
                        <h2 class="text-center" >Efecto Educativo</h2>

                <div class="form-group" style="margin-top: 10%;">
                  <label for="inputEmail" class="control-label col-md-4">Email:</label><!---->
                  <div class="col-md-4 ">
                    <input type="text" id="inputEmail" class="form-control " placeholder="Email" name="txtEmail" required="">
                  </div> <!---->
                </div>
                
                <div class="form-group">
                  <label for="inputPassword" class="control-label col-md-4">Contraseña:</label><!---->
                  <div class="col-md-4">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Clave" name="txtPass" required="">
                  </div>
                </div>
                
                <div class="form-group">
                   <div class="checkbox col-md-4 col-md-offset-4"><!---->
                    <label>
                      <input type="checkbox" value="1" name="remember" class="text-center"> Recordar Contraseña
                    </label>
                  </div>
                </div>
                
                <div class="form-group"><!---->
                  <div class="col-md-4 col-md-offset-4">
                    <button class="btn btn-lg btn-primary btn-block" value="Index" type="submit">Ingresar</button>
                  </div>
                </div>
               

                  <a class="col-md-4 col-md-offset-4 text-center" href="<?= base_url()?>Con_recuperar">Cambiar Contraseña</a>
                  <!--Envia al controlador Con_recuperar-->
                </div>


      <p class="col-md-4 col-md-offset-4 text-center bg-danger text-danger" style="margin-top: 20px;" id="errorLogin">
          <?php
          $error = $this->session->flashdata("error");
          if(isset($error) && !empty($error)) echo $error;//
          ?>
          
      </p>

                 

                </form>

                <footer class="footer" style="margin-top: 15%">
                  <div class="container">
                   <center>Efecto educativo &copy 2019 todos los derechos reservados.</center>
                  </div>
                </footer>
              
    </div> <!-- /container -->

    
    
        
    
    
    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    
  

</body>

</html>


        

      