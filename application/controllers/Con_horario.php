<?php
	
	/**
	* 
	*/
	class Con_horario extends CI_Controller
	{


		public function __construct()
		{
			parent::__construct();
			{
				if(!$this->session->userdata('login')){ //si no esta logeado, lo devuelve al inicio
					header("Location: " . base_url());
				}
			}
			$this->load->model('Modelo_horario');
		}
		
		public function index()
		{
					
			$this->load->view('guest/vis_calendario');

		}

		public function getPlan()
		{
			$r = $this->Modelo_horario->getPlan($this->session->userdata('s_id_profesor'));
			echo json_encode($r);
		}

		public function deletePlan()
		{
			$id = $this->input->post('id');
			$r = $this->Modelo_horario->deletePlan($id);
			echo $r;
		}





	}

?>