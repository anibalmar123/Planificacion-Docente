<?php
	
	class Con_recuperar extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			{
					
			$this->load->model("Modelo_login");
			}
		}

		public function index()
		{
			$this->load->view('guest/vis_recuperar');
		}

		public function recuperarClave()//Permite cambiar la clave del usuario
		{

			$email = $this->input->post("txtEmail");
			$claveAntigua = $this->input->post("txtClaveAntigua");
			$nuevaContraseña = $this->input->post("txtNuevaContraseña");
			$repetirContraseña = $this->input->post("txtRepetirContraseña");

			//si el mail y la clave antigua existen, y la nueva contraseña coincide en la repeticion entonces actualiza la contraseña con la nueva clave
			if($this->Modelo_login->cambiarClave($email, $claveAntigua, $nuevaContraseña)==true & $nuevaContraseña == $repetirContraseña){
				

				echo "<script>alert('Contraseña Modificada');</script>";

 				redirect('Con_login', 'refresh');
			}
			else
			{
				echo "<script>alert('No se pudo modificar la contraseña, los datos no coinciden');</script>";
				$this->load->view('guest/vis_recuperar', 'refresh');
			}



		}
	}

?>