<?php
	
	/**
	* 
	*/
	class Con_planificar extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct(); 
			{
				if(!$this->session->userdata('login')){ //si no esta logeado, lo devuelve al inicio
					header("Location: " . base_url());
				}
			}

			$this->load->model("Modelo_horario");
			
		}


		
		public function index()
		{

			
			//$data['recursos'] =$this->Modelo_horario->getRecursoPorAreas();
			$data['cursos'] = $this->Modelo_horario->getCursos();//Envia todos los cursos a la vista
			$data['areas']  = $this->Modelo_horario->getArea();//Envia todas las areas a la vista
			$data['tipoRecursos'] = $this->Modelo_horario->getTipoRecurso();//Envia todos los tipos de recurso a la vista

			

			$this->load->view('guest/vis_planificarHorario',$data); //data es enviada a la vista planificarHorario

		}

		public function getRecursoPorAreaTipo()//el valor del select recurso muestra todos los recursos que sean del area y tipo seleccionados
		{
			$id_tipo_recurso = $this->input->post('id_tipo_recurso');
			$id_area_recurso = $this->input->post('id_area_recurso');

			$recursos = $this->Modelo_horario->getRecursoPorAreaTipo($id_tipo_recurso, $id_area_recurso);

			if(count($recursos) > 0){

				$guardaSeleccionado = '';
				$guardaSeleccionado .= '<option value="">Seleccione un recurso</option>';
				foreach ($recursos as $recurso) {
					$guardaSeleccionado .= '<option value ="' . $recurso->id_recurso . '">' . $recurso->nombre_recurso . '</option>';
				}

				echo ($guardaSeleccionado);

			}
			else
			{
				
				$guardaSeleccionado = '<option value="">No hay recursos disponibles</option>';
				echo ($guardaSeleccionado);
			}

		}
		
		public function getRecursoPorTipo()//el valor del select recurso muestra todos los recursos que sean del tipo seleccionado
		{
			$id_tipo_recurso = $this->input->post('id_tipo_recurso');

			$recursos = $this->Modelo_horario->getRecursoPorTipo($id_tipo_recurso);

			if(count($recursos) > 0){

				$guardaSeleccionado = '';
				$guardaSeleccionado .= '<option value="">Seleccione un recurso</option>';
				foreach ($recursos as $recurso) {
					$guardaSeleccionado .= '<option value ="' . $recurso->id_recurso . '">' . $recurso->nombre_recurso . '</option>';
				}

				echo ($guardaSeleccionado);
			}
		}

		public function getRecursoPorArea()//el valor del select recurso muestra todos los recursos que sean del area seleccionada
		{
			$id_area_recurso = $this->input->post('id_area_recurso');//variable obtenida desde la vista(id_area)
			

			$recursos = $this->Modelo_horario->getRecursoPorArea($id_area_recurso); //selecciona todos los recursos que tenga el id area igual a la variable
			if (count($recursos) > 0) {//pregunta si la cantidad de recursos por area es mayor a 0
					
					$guardaSeleccionado = '';
					$guardaSeleccionado .= '<option value="">Seleccione un recurso</option>';
					foreach ($recursos as $recurso) {//recorre los recursos obtenidos y llena el select con esos recursos
						$guardaSeleccionado .= '<option value ="' . $recurso->id_recurso . '">' . $recurso->nombre_recurso . '</option>'; 
					}

					echo json_encode($guardaSeleccionado); //envia la estructura hmtl al js vis_planificarHorario
			}
		}

		public function recursoSeleccionado()//obtiene el recurso seleccionado desde la ventana modal/ se usa para cambiar el valor del select recurso del formulario principal por el recurso seleccionado en la ventana modal
		{
			 if($this->input->is_ajax_request()){
			 	$id_recurso = $this->input->post("id_recurso");//recibe la variable desde el js
			 	$recurso = $this->Modelo_horario->recursoSeleccionado($id_recurso);
			 	$recursoSeleccionado = '<option value="' . $recurso->id_recurso . '">' . $recurso->nombre_recurso . '</option>'; //se envia el id y el recurso 
			 	echo ($recursoSeleccionado);
			 	
			 }
		}

		public function compararFecha($fecha_ingresada)//validar fecha
		{

			$fecha_formateada = strtotime($fecha_ingresada); //recibe la fecha seleccionada y la convierte a fecha unix
			$fecha_formateada = date('Ymd', $fecha_formateada);//Convierte la fecha ingresada a formato YYYYmmdd
			$fecha_actual = date("Ymd");//fecha actual formato YYYYmmdd


			if($fecha_formateada >= $fecha_actual)//si la fecha ingresada es mayor a la fecha actual
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function crearPlan()//Crea el plan. Inserta en la tabla planificar los valores obtenidos del formulario de la vista vis_planificarHorario
		{	//obtiene los valores de la vista "vis_planificarHorario"

			$fecha = $this->input->post("txtFecha");
			$hora = $this->input->post("txtHora");
			$cantidad = $this->input->post("txtCantidad");
			$descripcion = $this->input->post("txtDescripcion");
			$idProfesor = $this->session->userdata('s_id_profesor');
			$idRecurso = $this->input->post("txtRecurso");
			$idCurso = $this->input->post("txtCurso");

			if($this->compararFecha($fecha))//Valida la fecha ingresada con la funcion compararFecha
			{
				$cantidadValida = $this->Modelo_horario->cantidadDisponible($idRecurso, $cantidad); //valida la cantidad disponible
				//si la cantidad disponible es mayor a la solicitada
				if($cantidadValida)
				{
					$data = array(//crea un arreglo con los datos obtenidos del formulario 

					"dia" => $fecha,
					"hora_solicitud" => $hora,
					"descripcion" => $descripcion,
					"cantidad_solicitada" => $cantidad,
					"id_recurso" => $idRecurso,
					"id_curso" => $idCurso,
					"id_profesor" => $idProfesor
					);

					if($this->Modelo_horario->crearPlan($data))//crea el plan. Inserta el registro el tabla planificar
					{
						header("Location: ". base_url('Con_home'));

					}
				}
				else
				{
					$this->session->set_flashdata("error", "Cantidad de recursos no disponible");
					header("Location: ". base_url('Con_planificar'));
				}

			}
			else
			{
				$this->session->set_flashdata("error", "La fecha debe ser igual o superior a hoy");
            	header("Location: ". base_url('Con_planificar'));

			}

			
			
		}

		public function listarRecursos()//lista recursos en una tabla/ se usa en la ventana modal
		{
			if($this->input->is_ajax_request()){
				$buscar = $this->input->post("buscar");
				$datos = $this->Modelo_horario->listarRecursos($buscar);
				echo json_encode($datos);//lista los recursos
			}
			else

			{
				show_404();
			}
		}

		public function filtrarTipoRecurso()//filtra los tipos de recursos en la tabla de la ventana modal
		{
			if ($this->input->is_ajax_request()) {
				
				$id_tipo_recurso = $this->input->post("id_tipo_recurso");
				$datos = $this->Modelo_horario->filtrarTipoRecurso($id_tipo_recurso);
				echo json_encode($datos);
			}
			else
			{
				show_404();
			}
		}

		public function filtrarArea()//filtra las areas de recursos en la tabla de la ventana modal
		{

			if($this->input->is_ajax_request())
			{
				$id_area_recurso = $this->input->post("id_area_recurso");
				$datos = $this->Modelo_horario->filtrarArea($id_area_recurso);
				echo json_encode($datos);
			}
			else
			{
				show_404();
			}


		}




	}

?>