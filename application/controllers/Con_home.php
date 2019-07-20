<?php
	
	class Con_home extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			{
				if(!$this->session->userdata('login')){ //si no esta logeado, lo devuelve al inicio
					header("Location: " . base_url());
				}
			}
		}

		public function index($value='')
		{
			header("Location: " . base_url('Con_home/inicioHorario')); 
		}

		public function inicioHorario()
		{
				
			$this->load->view('guest/vis_inicio');
				
		}
	}

?>