<?php

	/**
	* 
	*/
	class Modelo_login extends CI_Model
	{
		
			 public function __construct() {
			      parent::__construct();
			   
			   }


             public function get($id_usuario = 0)//selecciona el profesor donde el id ingresado sea igual al de la bd
			 {
			   $this->db->select('id_profesor, nombre, apellido_paterno, apellido_materno');
			   $this->db->from('profesor');
			   $this->db->where('id_profesor', $id_usuario);
			   	 
			   $query = $this->db->get();

			   return $query;
			 
			 }
                         
			public function login($email, $pass)//selecciona el mail y la password que sean igual a las pasadas por parametrox
			 {
			   $this->db->select('id_profesor, nombre, apellido_paterno, apellido_materno');
			   $this->db->from('profesor');
			   $this->db->where('email', $email);
			   $this->db->where('clave_prof', $pass);
			   	 
			   $query = $this->db->get();

			   return $query; 
			 
			 }

			 public function cambiarClave($email, $claveAntigua, $nuevaContraseña)//Cambiar la clave
			{	//actualiza la clave, si el mail y la claveAntigua existen

			  	$SQL = "UPDATE profesor SET clave_prof = '" . $nuevaContraseña . "' WHERE email = '" . $email . "' AND clave_prof = '". $claveAntigua . "' LIMIT 1";

			  	$resultado = $this->db->query($SQL);

				if($this->db->affected_rows())
				{
					return true; 
				}
				else
				{
					return false;
				}
			   
			}

		


	}

?>