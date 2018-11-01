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
    public function cambiarEstado() {
        if($this->input->is_ajax_request()) {
           echo json_encode($this->Perfiles_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus')));
        }
        else{
            show_404();
        }
	}
    
    public function agregarPerfil() {
        $this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inpDescripcion', 'Descripción', 'required');
        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Perfiles_modelo->agregarPerfil($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }
	
	public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Perfiles/perfiles_modal');
		}
		else {
			$data['datos'] = $this->Perfiles_modelo->obtenerDatos($id);
			$this->load->view('Perfiles/perfiles_modal',$data);
		}
	}

	public function modificarPerfil() {
		$this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'Descripción', 'required');
        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Perfiles_modelo->modificarPerfil($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
	}
}