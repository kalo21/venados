<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Notificaciones_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Cliente");
    		$this->load->view('Notificaciones/notificaciones_vista',$data);
        }
    }

    public function obtenerNotificaciones() {
        echo json_encode($this->Notificaciones_modelo->obtenerNotificaciones());
    }

    public function eliminarNotificacion() {
        $this->Notificaciones_modelo->eliminarNotificacion($this->input->post('id'));
    }
}