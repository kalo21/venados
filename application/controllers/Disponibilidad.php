<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disponibilidad extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Disponibilidad_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Empresa");
    		$this->load->view('Disponibilidad/disponibilidad_vista',$data);
        }
    }

    public function obtenerProductos() {
        echo json_encode($this->Disponibilidad_modelo->obtenerProductos());
    }

    public function cambiarEstado() {
		$this->Disponibilidad_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
    }
}