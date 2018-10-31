<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Productos_modelo');
    }
    public function index(){
        $this->load->view('Productos/productos_vista');
    }
	public function obtenerProductos($estatus) {
		echo json_encode($this->Productos_modelo->obtenerProductos($estatus));
	}
    public function cambiarEstado() {
		$this->Productos_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
	}
}