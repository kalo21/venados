<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Pagos_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }

    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Pagos");
    		$this->load->view('Pagos/pagos_vista',$data);
        }
    }

    public function obtenerEmpresas() {
        echo json_encode($this->Pagos_modelo->infoEmpresas());
    }

    public function pagarEmpresa() {
        echo json_encode($this->Pagos_modelo->pagarEmpresas($this->input->post('id'),$this->input->post('monto')));
    }
}