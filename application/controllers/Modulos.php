<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('Modulos_modelo');
    }
	
	public function index() {
		$this->load->view('Modulos/modulo_vista');
	}
	
	public function obtenerModulos($estatus) {
		echo json_encode($this->Modulos_modelo->obtenerModulos($estatus));
	}
	
}