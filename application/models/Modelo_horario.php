<?php

	/**
	* 
	*/
	class Modelo_horario extends CI_Model
	{
		


		public function getArea() //retorna la tabla area_recurso
		{
			
			$query = $this->db->get('area_recurso');

			if($query->num_rows() > 0){
				return $query->result();
			}
		}

		public function getTipoRecurso()//retorna la tabla tipo de recurso
		{
			
			$query = $this->db->get('tipo_recurso');

			if($query->num_rows() > 0){
				return $query->result();
			}
		}

		public function recursoSeleccionado($id_recurso)//obtiene el recurso seleccionado desde la ventana modal/ se usa para cambiar el valor del select del formulario principal por el recurso seleccionado en la ventana modal
		{
			$this->db->select('id_recurso, nombre_recurso');
			$this->db->from('recurso');
			$this->db->where('id_recurso = ', $id_recurso);
			$query = $this->db->get();
			$row = $query->row();
			return $row;
		}



		

		public function getRecursoPorAreaTipo($id_tipo_recurso, $id_area_recurso)//obtiene el recurso por area y tipo
		{
			$this->db->select('re.id_recurso, re.nombre_recurso');
			$this->db->from('recurso re');
			$this->db->join('recurso_tipo_recurso reti', 'reti.RECURSO_id_recurso = re.id_recurso');
			$this->db->join('tipo_recurso ti', 'ti.id_tipo_recurso = reti.TIPO_RECURSO_id_tipo_recurso');
			$this->db->join('recurso_area_recurso rea', 'rea.RECURSO_id_recurso = re.id_recurso');
			$this->db->join('area_recurso are', 'are.id_area_recurso = rea.AREA_RECURSO_id_area_recurso ');
			$this->db->where('are.id_area_recurso =', $id_area_recurso);
			$this->db->where('ti.id_tipo_recurso =', $id_tipo_recurso);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function getRecursoPorTipo($id_tipo_recurso) //obtiene el recurso por tipo
		{
			$this->db->select('re.id_recurso, re.nombre_recurso');
			$this->db->from ('recurso re'); 
			$this->db->join ('recurso_tipo_recurso recu', 'recu.RECURSO_id_recurso = re.id_recurso'); 
			$this->db->join ('tipo_recurso ar', 'ar.id_tipo_recurso = recu.TIPO_RECURSO_id_tipo_recurso');
			$this->db->where ('ar.id_tipo_recurso =', $id_tipo_recurso);
			$query = $this->db->get();
			return $query->result();
		}

		public function getRecursoPorArea($id_area_recurso)//obtiene el recurso por area
		{
			$this->db->select('re.id_recurso, re.nombre_recurso');
			$this->db->from ('recurso re'); 
			$this->db->join ('recurso_area_recurso recu', 'recu.RECURSO_id_recurso = re.id_recurso'); 
			$this->db->join ('area_recurso ar', 'ar.id_area_recurso = recu.AREA_RECURSO_id_area_recurso');
			$this->db->where ('ar.id_area_recurso =', $id_area_recurso);
			$query = $this->db->get();
			return $query->result();
		}

		/*
			public function getRecursos()
			{
				$this->db->order_by('nombre_recurso', 'asc');
				$query = $this->db->get('recurso');

				if($query->num_rows() > 0){
					return $query->result();
				}
			}
		*/
		
		


		public function getCursos()//obtiene el id y nivel de la tabla curso
		{
			$this->db->select('nivel, id_curso');
			$query = $this->db->get('curso');

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}

		

		public function cantidadDisponible($id_recurso, $cantidad)//consultar la cantidad disponible de recursos de la tabla stock pasando por parametro el id_recurso
		{
			
			$consulta = $this->db->query("SELECT cantidad_disponible FROM stock WHERE RECURSO_id_recurso =". $id_recurso . " LIMIT 1"); //selecciona por el nombre pasado por parametro
			$result = $consulta->first_row(); //obtiene la primera fila de la query

			if($result->cantidad_disponible > $cantidad)//si la cantidad_disponible es mayor a la cantidad solicitada
			{
				$descuento = $result->cantidad_disponible - $cantidad; //hace el descuento

				$this->db->query("UPDATE stock SET cantidad_disponible =". $descuento ." WHERE RECURSO_id_recurso = ". $id_recurso);//actualiza el stock de recurso

				if($this->db->affected_rows() > 0){//se modifico la tabla
					return true;
				}
				
			}
			else//si la cantidad_disponible es menor a la cantidad_solicitada
			{
				return false;
			}


		}

		public function crearPlan($data)//crea el plan
		{

				$this->db->insert("planificar", $data); //inserta en la tabla

				if($this->db->affected_rows() > 0){
					return true;
				}
				else
				{
					return false;
				}
		}

		public function getPlan($id_profesor)//obtiene el plan por el id del profesor(metodo para el calendario)
		{
			$this->db->select('pl.id_curso, cu.nivel title, CONCAT(dia,\'T\',hora_solicitud) start'); //Title se mostrara en el calendario
			$this->db->from('planificar pl');
			$this->db->join('curso cu', 'cu.id_curso = pl.id_curso');
			$this->db->join('profesor pro', 'pro.id_profesor = pl.id_profesor');
			$this->db->where('pl.id_profesor =', $id_profesor);
			return $this->db->get()->result();
		}

		public function deletePlan($id)//borra el plan por el id
		{
			$this->db->where('id_plan', $id);
			return $this->db->delete('planificar'); //devuelve 1 o 0 si es que elimina el registro
		}

		public function consultarIdRecurso($nombre_recurso = '')//consulta los registros de la tabla recurso por el nombre
		{
			
			$result = $this->db->query("SELECT * FROM recurso WHERE nombre_recurso = '" . $nombre_recurso . "' LIMIT 1"); 
			return $result->row(); 
		
		}

		public function filtrarTipoRecurso($id_tipo_recurso) //Filtra los recursos por tipo/ se usa en la ventana modal
		{
			$this->db->select('st.cantidad_disponible, re.id_recurso, re.codigo, re.nombre_recurso, re.descripcion, re.LUGAR_RECURSO_id_lugar');
			$this->db->from ('recurso re'); 
			$this->db->join ('recurso_tipo_recurso recu', 'recu.RECURSO_id_recurso = re.id_recurso'); 
			$this->db->join ('tipo_recurso ti', 'ti.id_tipo_recurso = recu.TIPO_RECURSO_id_tipo_recurso');
			$this->db->join('stock st', 'st.RECURSO_id_recurso = re.id_recurso');
			$this->db->where ('ti.id_tipo_recurso =', $id_tipo_recurso);
			$query = $this->db->get();
			return $query->result();
		}


		public function filtrarArea($id_area_recurso)//Filtra los recursos por area/ se usa en la ventana modal
		{
			$this->db->select('st.cantidad_disponible, re.id_recurso, re.codigo, re.nombre_recurso, re.descripcion, re.LUGAR_RECURSO_id_lugar');
			$this->db->from ('recurso re'); 
			$this->db->join ('recurso_area_recurso recu', 'recu.RECURSO_id_recurso = re.id_recurso'); 
			$this->db->join ('area_recurso ar', 'ar.id_area_recurso = recu.AREA_RECURSO_id_area_recurso');
			$this->db->join('stock st', 'st.RECURSO_id_recurso = re.id_recurso');
			$this->db->where ('ar.id_area_recurso =', $id_area_recurso);
			$query = $this->db->get();
			return $query->result();
		}

		public function listarRecursos($valor)//lista todos los recursos disponibles en una tabla con su stock que sean igual al valor pasado por parametro / se usa en la ventana modal
		{
			
			$this->db->select('st.cantidad_disponible, re.id_recurso, re.codigo, re.nombre_recurso, re.descripcion, re.LUGAR_RECURSO_id_lugar');
			$this->db->from('recurso re');
			$this->db->join('stock st', 'st.RECURSO_id_recurso = re.id_recurso');
			$this->db->like("re.nombre_recurso", $valor);
			$consulta = $this->db->get();
			return $consulta->result();

		}

		
		
	}

	

?>