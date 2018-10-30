<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    	$this->load->model('Usuarios_modelo');
	}
	
	public function index() {
		$this->load->view('Usuarios/usuario_vista');
	}
	public function obtenerUsuarios($estatus) {
		echo json_encode($this->Usuarios_modelo->obtenerUsuarios($estatus));
	}
	
}