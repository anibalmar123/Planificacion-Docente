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
    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url();?>assets/bootstrap/css/vis_planificarHorario.css" rel="stylesheet">
    

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
          <div class="navbar-brand" ><?php echo "Usuario : ".$this->session->userdata('s_usuario');?></div><!--Muestra el nombre de usuario en la barra de navegación-->
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?= base_url()?>Con_home/">Inicio</a></li><!--Redirecciona al controlador Con_home-->
            <li><a href="http://getbootstrap.com/examples/starter-template/#about">About</a></li>
            <li><a href="<?= base_url()?>Con_login/logout">Cerrar Sesión</a></li><!--Cierra sesion-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" >

      <div id="principal"><!--Diseño en vis_recurperar.css-->
        <h1 style="padding-bottom: 25px;">Planificación</h1>
        <div class="col-lg-8 col-lg-offset-3 col-md-8 col-md-offset-1">

        <form id="form" action="<?=base_url('Con_planificar/crearPlan');?>" method="POST" class="form-horizontal" ><!--Envia al controlador Con_planificar, funcion crearPlan-->


            <div class="form-group">
              <label for="dia" class="control-label col-md-2">Fecha</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="dia" name="txtFecha" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="hora" class="control-label col-md-2">Hora</label>
              <div class="col-md-6">
                <input type="time" class="form-control" id="hora" name="txtHora" required="">
              </div>
            </div>


            <div class="form-group">
              <label for="cantidad" class="control-label col-md-2">Cantidad</label>
              <div class="col-md-6">
                <input type="number" min="1" class="form-control" id="cantidad" name="txtCantidad" required="">
              </div>
            </div>

             <div class="form-group">
              <label for="curso" class="control-label col-md-2">Curso</label>
              <div class="col-md-6">
                <select class="form-control" id="curso" name="txtCurso" required="">
                  <option value="0">Seleccione un Curso</option>
                    <?php 
                      foreach ($cursos as $key) {//Recorre la variable cursos recibidad del controlador planificar
                        echo '<option value='. $key->id_curso .'">' . $key->nivel . '</option>';//llena el select con los cursos desde la BD
                      }
                    ?>
                </select>
              </div>
            </div>
           
             <div class="form-group">
              <label for="area" class="control-label col-md-2">Area</label>
              <div class="col-md-6">
                <select  id="area" name="txtArea" class="form-control" required="">
                  <option value="">Seleccione un Área</option>
                  <?php foreach ($areas as $area): ?> <!--Recorre la variable areas recibida del controlador planificar-->
                    
                        <option value="<?php echo $area->id_area_recurso; ?>"><?php echo $area->nombre_area; ?></option><!--llena el select con las areas registradas en la bd-->
                    <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="tipoRecurso" class="col-sm-2 col-form-label">Tipo de Recurso</label>
              <div class="col-md-6">
                <select class="form-control" id="tipoRecurso" name="txtTipoRecurso" required="">
                  <option value="">Seleccione un Tipo de Recurso</option>
                  <?php foreach ($tipoRecursos as $tipoRecurso): ?>
                    
                        <option value="<?php echo $tipoRecurso->id_tipo_recurso; ?>"><?php echo $tipoRecurso->nombre_tipo; ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
          

            <div class="form-group">
              <label for="recurso" class="control-label col-md-2 col-xs-12">Recurso</label>
              <div class="col-md-4 col-xs-8">
                <select class="form-control" id="recurso" name="txtRecurso" disabled="" required="">
                  <option value="">Seleccione un recurso</option>
                </select>
              </div>

                <a href="#ventana1" name="btnBuscar" class="btn btn-success col-md-2 col-xs-4" data-toggle="modal"><!--Abre la ventana modal-->
                  Buscar Recursos
                </a>
            </div>

            

            <div class="form-group">
              <label for="descripcion" class="control-label col-md-2">Descripcion</label>
              <div class="col-md-6">
                <textarea class="form-control" id="descripcion" rows="3" name="txtDescripcion" required=""></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="control-label col-md-4 col-xs-6" id="botones">
                <button type="submit" class="btn btn-primary" >Enviar</button>
              </div>
              <div class="control-label col-md-3  col-xs-6" id="botones" >
                <a class="btn btn-primary" href="<?php echo base_url('Con_home/inicioHorario');?>">Volver</a>
              </div>
            </div>

           <p class="col-md-5 col-md-offset-2 text-center bg-danger text-danger" style="margin-top: 20px;" id="errorCampos">
                <?php
                $error = $this->session->flashdata("error");
                if(isset($error) && !empty($error)) echo $error;
                ?>
           </p>

          </form>

          </div>
      </div>

    </div><!-- /.container -->
   
    <br/>

    <div class="container">
       <div class="modal fade" id="ventana1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <!-- Header de la ventana -->
                  <div class="modal-header">
                    <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Recursos</h2>
                  </div>

                  <!--Contenido de la ventana-->
                  <div class="modal-body" >

                    <div class="col-md-12">
                      <form id="formularioModal" class="form-horizontal">

                     <div class="form-group clearfix">
                        <label for="curso" class="control-label col-md-2">Curso</label>
                        <div class="col-md-3">
                          <select class="form-control" id="curso" name="txtCurso" >
                            <option value="0">Seleccione un curso</option><!--Recorre la variable cursos recibida del controlador planificar-->
                              <?php 
                                foreach ($cursos as $key) {
                                  echo '<option value='. $key->id_curso .'">' . $key->nivel . '</option>';//llena el select cursos
                                }
                              ?>
                          </select>
                        </div>
                       <label for="buscar" class="control-label col-md-2">Buscar</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar"><!--Busca por nombre del recurso-->
                        </div>
                        <div class="col-md-2">
                          <input type="button" class="btn btn-primary btn-block" id="btnBuscar" value="Mostrar Todo" />
                        </div>
                    </div>
                  

                    <div class="form-group clearfix">
                      <label for="modalArea" class="control-label col-md-2">Area</label>
                      <div class="col-md-3">
                        <select  id="modalArea" name="txtModalArea" class="form-control" >
                          <option value="">Seleccione un area</option>
                          <?php foreach ($areas as $area): ?><!--recorre la variable areas recibida del controlador Con_planificar-->
                            
                                <option value="<?php echo $area->id_area_recurso; ?>"><?php echo $area->nombre_area; ?></option><!--LLena el select area-->
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label for="modalTipo" class="control-label col-md-2">Tipo de Recurso</label>
                      <div class="col-md-3">
                        <select class="form-control" id="modalTipo" name="txtModalTipo" class="form-control" >
                          <option value="">Seleccione un Tipo de Recurso</option>
                          <?php foreach ($tipoRecursos as $tipoRecurso): ?><!--recorre la variable tipoRecursos recibida del controlador Con_planificar-->
                            
                                <option value="<?php echo $tipoRecurso->id_tipo_recurso; ?>"><?php echo $tipoRecurso->nombre_tipo; ?></option><!--LLena el select tipo recurso-->
                            <?php endforeach; ?>
                        </select>
                      </div>
                      
                     </div>

                     <div class="col-md-12">
                        <div id="lista"></div> <!--Se listaran todos los recursos-->
                    </div>

                  </form>

                  </div>

                  <!--Footer de la ventana-->

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    
                  </div>
                </div>
              </div>
          </div>
        </div>

     <footer class="footer">
      <div class="container">
       <center>Efecto educativo &copy 2019 todos los derechos reservados.</center>
      </div>
    </footer>

    <script type="text/javascript">

        var baseurl = "<?php echo base_url();?>"; //contiene la url base, aqui si reconoce le codigo php, por tener extension .php
    </script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/vis_planificacionHorario.js"></script><!--Carga el js-->

</body></html>