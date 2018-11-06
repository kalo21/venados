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
    public function agregarProducto() {
        $this->form_validation->set_rules('inpNombre', 'nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'descripción', 'required');
		$this->form_validation->set_rules('inpPrecio', 'precio', 'required');

        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Productos_modelo->agregarProducto($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }

    public function modificarProducto() {
        $this->form_validation->set_rules('inpNombre', 'nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'descripción', 'required');
		$this->form_validation->set_rules('inpPrecio', 'precio', 'required');

        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Productos_modelo->modificarProducto($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }

    public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Productos/productos_modal');
		}
		else {
			$data['datos'] = $this->Productos_modelo->obtenerDatos($id);
			$this->load->view('Productos/productos_modal',$data);
		}
	}
}