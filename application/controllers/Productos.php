<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Productos_modelo');
        $this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
        if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Modulos");
            $this->load->view('Productos/productos_vista',$data);
        }
    }
	public function obtenerProductos($estatus) {
		echo json_encode($this->Productos_modelo->obtenerProductos($estatus));
	}
    public function cambiarEstado() {
		$this->Productos_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
    }
    public function agregarProducto() {

        $config = [
            "upload_path" => "./assets/images/",
            'allowed_types' => "png|jpg"
        ];

        $this->load->library("upload",$config);
        $this->form_validation->set_rules('inpNombre', 'nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'descripción', 'required');
		$this->form_validation->set_rules('inpPrecio', 'precio', 'numeric');
        
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                echo json_encode($this->Productos_modelo->agregarProducto($this->input->post(), $nombreArchivop));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
        }
    }

    public function modificarProducto() {
        $this->form_validation->set_rules('inpNombre', 'nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'descripción', 'required');
		$this->form_validation->set_rules('inpPrecio', 'precio', 'numeric');
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