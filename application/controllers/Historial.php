<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historial extends CI_Controller {

    public function __construct(){
        parent::__construct();
         $this->load->model('Historial_modelo');
         $this->load->helper(array('funciones_generales_helper','url'));
    }

    public function index() {
        if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Empresa");
    		$this->load->view('Historial/historial_vista',$data);
        }
    }

    public function obtenerPedidos() {
        echo json_encode($this->Historial_modelo->obtenerPedidos($this->input->post('estatus')));
    }
}