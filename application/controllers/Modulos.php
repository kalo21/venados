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

	public function agregarModulo() {
        $this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'Descripción', 'required');
		$this->form_validation->set_rules('inpIcono', 'Icono', 'required');

        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Modulos_modelo->agregarModulo($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }
	
	public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Modulos/modulo_modal');
		}
		else {
			$data['datos'] = $this->Modulos_modelo->obtenerDatos($id);
			$this->load->view('Modulos/modulo_modal',$data);
		}
	}
	
}