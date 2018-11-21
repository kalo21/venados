<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recargas extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Recargas_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Recargas");
    		$this->load->view('Recargas/recargas_vista',$data);
        }
    }
    public function obtenerRecargas() {
		echo json_encode($this->Recargas_modelo->obtenerRecargas());
	}
    public function agregarRecargas() {
        $this->form_validation->set_rules('inpUsuario', 'ID', 'required');
		$this->form_validation->set_rules('inpVerificar', 'verificar nombre', 'trim|required|matches[inpUsuario]');
		$this->form_validation->set_rules('inpMonto', 'Monto', 'numeric');
        $this->form_validation->set_rules('inpPIN', 'PIN', 'numeric');
        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Recargas_modelo->agregarRecargas($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }
}