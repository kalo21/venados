<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Eventos_model');
		$this->load->helper(array('funciones_generales_helper','url'));
	}

	public function index(){
		if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Empresa");
    		$this->load->view('Eventos/Eventos_vista',$data);
        }
	}

	public function obtenerEventos($estatus) {
		echo json_encode($this->Eventos_model->obtenerEventos($estatus));
	}

	public function formulario($id = ''){
		if(empty($id)) {
			$this->load->view('Eventos/eventos_modal');
		}
		else {
			$data['datos'] = $this->Eventos_model->datosFormulario($id);
			$this->load->view('Eventos/eventos_modal',$data);
		}
	}

	public function agregarEvento(){

		$config = [
			'upload_path' => './assets/images/eventos',
			'allowed_types' => 'jpg|png'
		];
		$this->load->library('upload', $config);

		$this->form_validation->set_rules('inpNombre', 'Nombre del evento', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'Descripcion del evento', 'required');
		$this->form_validation->set_rules('inpInicioD', 'Fecha de inicio del evento', 'required');
		$this->form_validation->set_rules('inpFinD', 'Fecha en que termina el evento', 'required');

		if ($this->upload->do_upload('inpFoto')) {
			$data = array('upload_data' => $this->upload->data());
			$file_nombre = $data['upload_data']['file_name'];
			if ($this->form_validation->run() === TRUE) {
				echo json_encode($this->Eventos_model->agregarEvento($this->input->post(), $file_nombre));
			}else{
				echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
			}
		}
		else{
			echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
		}
	}

	public function editarEventos(){

		$config = [
			'upload_path' => './assets/images/eventos',
			'allowed_types' => 'jpg|png'
		];
		$this->load->library('upload', $config);

		$this->form_validation->set_rules('inpNombre', 'Nombre del evento', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'Descripcion del evento', 'required');
		$this->form_validation->set_rules('inpInicioD', 'Fecha de inicio del evento', 'required');
		$this->form_validation->set_rules('inpFinD', 'Fecha en que termina el evento', 'required');

		if ($this->upload->do_upload('inpFoto')) {
			$data = array('upload_data' => $this->upload->data());
			$file_nombre = $data['upload_data']['file_name'];
			if($this->form_validation->run() === TRUE){
				echo json_encode($this->Eventos_model->modificarEvento($this->input->post(), $file_nombre));
			}else{
				echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
			}
		}
		else{
			echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
		}
	}

	public function cambiarEstado() {
		$this->Eventos_model->cambiarEstado($this->input->post('id'), $this->input->post('status'));
    }
}