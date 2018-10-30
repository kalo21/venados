<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends CI_Controller {

    public function __construct(){
        parent::__construct();
    	$this->load->model('Perfiles_modelo');
	}
	
	public function index() {
		$data['datos'] = $this->Perfiles_modelo->obtenerPerfiles();
		if($data) {
			$this->load->view('Perfiles/perfiles_vista', $data);
		}
	}
	public function obtenerPerfil($estatus) {
		echo json_encode($this->Perfiles_modelo->obtenerPerfil($estatus));
	}
	
}