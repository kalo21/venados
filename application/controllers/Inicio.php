<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_modelo');

    }
    public function index(){
        //$this->load->view('inicio');/Se utiliza casos para controlar el acceso al servidor depende del tipo de usuario (perfil) se mostrara la pantalla principal correspodiente
       $this->load->view('Inicio/login');
    }
    
    public function ingresar() {
        if($this->input->is_ajax_request()) {
            echo $this->Inicio_modelo->ingresar($this->input->post());
        }
        else {
            show_404();
        }
    }

    public function salir() {
        $this->session->sess_destroy();
        redirect('Inicio');
    }
}
