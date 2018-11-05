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
		$this->Empresa_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
	}

	public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Empresa/empresa_modals');
		}
		else {
			$data['datos'] = $this->Empresa_modelo->obtenerDatos($id);
			$this->load->view('Empresa/empresa_modals',$data);
		}
	}

	public function agregarEmpresa() {
		return true;
	}

}

