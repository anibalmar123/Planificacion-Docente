<!DOCTYPE html>
<!-- saved from url=(0050)http://getbootstrap.com/examples/starter-template/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Horario Profesor</title>


  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand" ><?php echo "Usuario : ".$this->session->userdata('s_usuario');?></div><!--Muestra el usuario en la barra de navegacion-->
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="<?= base_url()?>Con_login/logout">Cerrar Sesión</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

     
        <h1 class="text-center">Bienvenido</h1>
       
      

     <div class="form-group" >

         
         <div class="col-md-offset-4 col-md-4 text-center" style="margin-bottom: 50px;">
            <button id="singlebutton" name="btnPlanificarHorario"  class="btn btn-lg btn-block btn-primary" onclick=" location.href='<?=base_url('Con_planificar')?>' "><!--Redirecciona al controlador Con_planificar-->    
                Planificar Horario
            </button>
           </div>
           <div class="col-md-offset-4 col-md-4 text-center">
            <button id="singlebutton" name="btnVerHorario"class="btn btn-lg btn-block btn-warning"  onclick=" location.href='<?=base_url('Con_horario')?>'"><!--Redirecciona al controlador Con_horario-->
                Ver Horario
            </button>
        </div>
    </div>


    </div><!-- /.container -->

    <footer class="footer" style="margin-top: 15%;">
      <div class="container">
       <center>Efecto educativo &copy 2019 todos los derechos reservados.</center>
      </div>
    </footer>

    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
</body></html>