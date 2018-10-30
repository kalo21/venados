<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Empresa_modelo');
    }
    public function index(){
        $this->load->view('Empresa/empresa_vista');
    }
	public function obtenerEmpresa($estatus) {
		echo json_encode($this->Empresa_modelo->obtenerEmpresa($estatus));
	}
	public function cambiarEstado() {
		$this->Empresa_modelo->cambiarEstado($_POST['id'], $_POST['estatus']);
	}
    public function modal(){
        
    }
}

