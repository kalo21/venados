<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Inicio_modelo');
        $this->load->helper(array('funciones_generales_helper','url'));

    }
    public function index(){
        switch ($this->session->userdata('idPerfil')) {
            case '1':
                $data['modulos'] = modulos();
                $data['informacion'] = informacionInicial("VenadoSnacks | Administrador");
                $this->load->view('Administrador/index',$data);
                break;
            case '2':
                $data['modulos'] = modulos();
                $data['informacion'] = informacionInicial("VenadoSnacks | Empresa");
                $this->load->view('Empresa/index',$data);
                break;
            case '3':
                $data['modulos'] = modulos();
                $data['informacion'] = informacionInicial("VenadoSnacks | Sistemas");
                $this->load->view('Sistemas/index',$data);
                break;
            case '4':
                $data['modulos'] = modulos();
                $data['informacion'] = informacionInicial("VenadoSnacks | Cliente");
                $this->load->view('Cliente/index',$data);
                break;
            default:
                $this->load->view('Inicio/login');
                break;
        }
       
    }
    
    public function ingresar() {
        if($this->input->is_ajax_request()) {
            echo json_encode($this->Inicio_modelo->ingresar($this->input->post()));
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
