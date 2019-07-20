<!DOCTYPE html>
<!-- saved from url=(0041)https://getbootstrap.com/examples/signin/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Login | Horario</title>



    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/vis_recuperar.css">
    

    
  </head>

  <body>

    <div class="container">


                <form class="form-horizontal" id="login" action="<?=base_url('Con_recuperar/recuperarClave');?>" method="POST"><!--Envia los datos al controlador Con_recuperar, funcion recuperarClave-->
                        <h2 class="text-center">Efecto Educativo</h2>

                <div class="form-group" style="margin-top: 7%;">
                    <label for="Email" class="control-label col-md-4">Email:</label>
                    <div class="col-md-4">
                        <input type="email" id="Email" class="form-control" placeholder="Email" name="txtEmail" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="ClaveAntigua" class="control-label col-md-4">Ingrese Clave Antigua:</label>
                    <div class="col-md-4">
                        <input type="password" id="ClaveAntigua" class="form-control" placeholder="Clave Antigua" name="txtClaveAntigua" required="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="NuevaContraseña" class="control-label col-md-4">Ingrese Clave Nueva:</label>
                    <div class="col-md-4">
                        <input type="password" id="NuevaContraseña" class="form-control" placeholder="Nueva Contraseña" name="txtNuevaContraseña" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="RepetirContraseña" class="control-label col-md-4">Repetir Clave:</label>
                    <div class="col-md-4">
                        <input type="password" id="RepetirContraseña" class="form-control" placeholder="Repetir Contraseña" name="txtRepetirContraseña" required="">
                    </div>
                </div>
                
                
                <div id="general" style="margin-top: 10%;">
                    <div id="primero">
                         <button class="btn btn-lg btn-primary btn-block"  value="Index" type="submit">Confirmar</button>
                    </div>
                    <div id="segundo">
                         <button class="btn btn-lg btn-primary btn-block" id="volver" onclick="location.href='<?php echo base_url();?>'" value="Index" type="button">Volver</button>
                    </div>
               
                </div>

                </form>

                <footer class="footer" >
                  <div class="container">
                   <center>Efecto educativo &copy 2019 todos los derechos reservados.</center>
                  </div>
                </footer>

    </div> <!-- /container -->


    

    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>