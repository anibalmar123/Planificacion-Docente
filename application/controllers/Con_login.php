<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

   
class Con_login extends CI_Controller{

    public function __construct(){
        parent::__construct();
        {
            if($this->session->userdata('login')){ //si no esta logeado, lo devuelve al inicio
                $this->session->sess_destroy();
            }
            $this->load->helper('cookie');//carga el helper cookie
        }
    }

    public function index() {
        $id_usuario = get_cookie("id_login_planificacion"); //obtiene la cookie con sus valores
        if($id_usuario > 0){//si es mayor a uno 
            $this->load->model('Modelo_login');
            $user = $this->Modelo_login->get($id_usuario); //devuelve el resultado de la query 
            if($user->num_rows() == 1) { 
                $r = $user->row(); //le asigno el valor de la fila a una variable
                $session_usuario = array( //creo la sesion
                    's_id_profesor' => $r->id_profesor,
                    's_usuario' => $r->nombre." ".$r->apellido_paterno." ".$r->apellido_materno,
                    'login' => true
                );
                $this->session->set_userdata($session_usuario);//se guarda en session
                redirect(base_url('Con_home/inicioHorario')); 
            }
        }
        $this->load->view('guest/vis_login');
    }

    public function ingresar() {
        $email = $this->input->post('txtEmail'); //obtengo los valores del post
        $pass = $this->input->post('txtPass');
        $remember = $this->input->post('remember');
        

        $this->load->model('Modelo_login');//cargo el modelo login

        $query = $this->Modelo_login->login($email, $pass);//uso la funcion login del modelo

        if($query->num_rows() == 1) {//si devuelve un registro, el usuario existe
            $r = $query->row(); //le asigno el valor de la fila a una variable

            $session_usuario = array( //creo la sesion
                's_id_profesor' => $r->id_profesor,
                's_usuario' => $r->nombre." ".$r->apellido_paterno." ".$r->apellido_materno,
                'login' => true
                );

            $this->session->set_userdata($session_usuario);//se guarda en session
            if($remember == 1){ // si el remember igual a 1 (marcado)
                set_cookie('id_login_planificacion', $r->id_profesor, 86400); //seteo la cookie con el id del profesor un nombre de cookie y un numero
            }
            redirect(base_url('Con_home/inicioHorario')); //redirije  a inicioHorario

        } else{
            $this->session->set_flashdata("error", "Usuario o contraseña incorrecto"); //mensaje de error
            redirect(base_url()); 
        }
    }

    public function logout(){//salir de sesion
        delete_cookie('id_login_planificacion');//borra la cookie
        $this->session->sess_destroy();//quita la sesion
        redirect(base_url());			
    }


}

?>