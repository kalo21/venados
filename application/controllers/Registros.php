<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registros extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Registros_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }

    public function index(){
    	if(validacion()) {
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Registros");
    		$this->load->view('Registros/registros_vista',$data);
        }
    }

    public function obtenerDatos() {
        $data['empresas'] = $this->Registros_modelo->obtenerTotalEmpresas($this->input->post());
        $data['vendedores'] = $this->Registros_modelo->obtenerTotalVendedores($this->input->post());
        echo json_encode($data);
    }
}