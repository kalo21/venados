<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Eventos_model');
	}

	public function index(){
		$this->load->view('Eventos/Eventos_vista');
	}

	public function obtenerEventos($estatus) {
		echo json_encode($this->Eventos_model->obtenerEventos($estatus));
	}

	public function formulario($id = ''){
		if(empty($id)) {
			$this->load->view('Eventos/eventos_modal');
		}
		else {
			$data['datos'] = $this->Modulos_modelo->obtenerDatos($id);
			$this->load->view('Eventos/eventos_modal',$data);
		}
	}

	public function agregarEvento(){
		$nombre = $this->input->post('inpNombre');
		$descripcion = $this->input->post('inpDescripcion');
		$fechainicio = $this->input->post('inpInicioD');
		$fechafinal = $this->input->post('inpFinD');
		$config = [
			'upload_path' => './assets/images/eventos',
			'allowed_types' => 'gif|jpg|png'
		];
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('inpFoto')) {
			$data = array('upload_data' => $this->upload->data());
			$datos = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'fecha_inicial' => $fechainicio,
				'fecha_fin' => $fechafinal,
				'imagen' => $data['upload_data']['file_name'],
				'status' => 1
			);
			$this->Eventos_model->agregarEvento($datos);
		}
		else{
			echo $this->upload->display_errors();
		}
	}
}