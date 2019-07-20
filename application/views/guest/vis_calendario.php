<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<!--<script src='<?php echo base_url();?>assets/fullcalendar/lib/jquery.min.js'></script>-->

<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/AdminLTE.min.css" >



<script src='<?php echo base_url();?>assets/bootstrap/js/jquery-2.2.3.min.js'></script>
<script src='<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/locale/es.js'></script>

<script>

	$(document).ready(function() {

		$.post('<?php echo base_url();?>Con_horario/getPlan',
			function(data){
				alert(data);
			
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			defaultDate: new Date(),
                        defaultView: 'basicDay',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: 

			$.parseJSON(data),
			

			eventClick: function(event, jsEvent, view){
				$('#miTitulo').html(event.title); //cargo el titulo del evento en el modal 
				$('#modalPlan').modal();
			},

			eventRender: function(event, element){
				var el  = element.html();
				element.html("<div style='width:90%; float:left;'>" + el + "</div> " + "<div style='color:black; text-align:right;' class='closeE'>" + "<i class='fa fa-trash-o'></i>" + "</div>");
				
				element.find('.closeE').click(function(){
					if(!confirm("Esta seguro de eliminar la planificación?")){
						revertFunc();//RevertFunc es una función que, si se llama, devuelve la fecha de inicio / fin del evento a los valores antes de la operación de arrastre. Esto es útil si falla una llamada ajax.
					}else{
						var id = event.id;
						$.post("<?php echo base_url();?>Con_horario/deletePlan", //borra el id
						{
							id:id
						},
						function (data) {
							if(data == 1){
								$('#calendar').fullCalendar('removeEvents', event.id);
								alert('Se elimino correctamente');
							}else{
								alert('Error. ');
							}
						});
						
					}

				});

			}

			});
		
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: auto;
		margin-top: 70px;
		margin-bottom: 5%;
	}

</style>
<style>
	.example-modal .modal{
		position: relative;
		top: auto;
		bottom: auto;
		right: auto;
		left: auto;
		display: block;
		z-index: 1;

	}

	.exmaple-modal .modal{
		background: transparent !important;
	}
        .fc-center{
         margin-top: 10px;   
        }


</style>
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
	          <div class="navbar-brand"><?php echo "Usuario : ".$this->session->userdata('s_usuario');?></div><!--Muestra el usuario-->
	        </div>
	        <div id="navbar" class="collapse navbar-collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li class="active"><a href="<?= base_url()?>Con_home">Inicio</a></li>
	            <li><a href="http://getbootstrap.com/examples/starter-template/#about">About</a></li>
	            <li><a href="<?= base_url()?>Con_login/logout">Cerrar Sesión</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>
	    

	<div id='calendar'></div>


		<div class="modal fade" id="modalPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-red">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Plan<div id="miTitulo"></div>Curso</h4>
	      </div>

	      <div class="modal-body">
	       	<div id="miTitulo"></div><!--Se carga el titulo del evento-->
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" id="btnCancelar" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" id="btnGuardar" >Guardar</button>
	      </div>
		    </div><!-- /.modal-content -->
		  	</div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->

	 <footer class="footer">
      <div class="container">
       <center>Efecto educativo &copy 2019 todos los derechos reservados.</center>
      </div>
    </footer>

</body>
</html>
