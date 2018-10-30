<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('Login_modelo');
        $this->load->model('Modulos_modelo');

    }
    public function informacionInicial($titulo){
        $data['imagen'] = "escuela.png ";
        $data['nombre'] = "Prueba";
        $data['titulo'] = $titulo;
        return $data;
    }
    public function validacion(){
        $url = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"],"index.php"));//--TOMO EL URL A QUE SE QUIERE ACCEDER
        if($this->session->userdata('id_perfil') == true){//-- SI EL 's_id_usuario' EXISTE EN LA SESSION QUIERE DECIR QUE SI HUBO ALGUIEN LOGUEADO
            if($this->Modulos_modelo->validarPerfil($this->session->userdata('id_perfil'),$url)==true){//--VALIDA QUE EL PERFIL LOGUEADO LE PERTENECE EL MODULO AL QUE DESEA ACCEDER.
              return true;
            }
            else{
              header('Location: '.base_url().'index.php/Inicio/index');
            }
        }
        else{
          header('Location: '.base_url().'index.php/Inicio/index');
        }
    }

    public function index(){
        //$this->load->view('inicio');
        switch ($this->session->userdata('id_perfil')) {
            case '': 
            // print_r($this->session->userdata());
                redirect(base_url().'index.php/Inicio/login');
                break;
            case '1':
                redirect(base_url().'index.php/Administrador');
                break;
            case '2':
                echo "TRABJANDO";
                break;   
            case '3':
               echo "TRABJANDO";
                break;
                
            case '4':
                echo "TRABJANDO";
                break;
            default:
                redirect(base_url().'index.php/Inicio/login');
                break;
        }
    }
    public function ingresar(){
        if($this->input->is_ajax_request()) {
          $usuario = $this->input->post("usuario");
          $contraseña = $this->input->post("contraseña");

          echo $this->Login_modelo->login($usuario,$contraseña);
        }
        else{
          show_404();
        }
      }
    public function login(){
        if($this->session->userdata('id_perfil') == true){
            header('Location: '.base_url().'index.php/Inicio/index');
        }
        else{
          $this->load->view('Inicio/login2');
        }
        
    }
    public function salir(){
        $this->session->sess_destroy();//-destruye la sesion actual
        header('Location: '.base_url());
      }
    

}
