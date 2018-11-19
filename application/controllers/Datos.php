<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('Datos_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
	
	public function index() {
		if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Mis Datos");
            $id = $this->session->idUsuario;
            $data['datos'] = $this->Datos_modelo->obtenerDatos($id);
    		$this->load->view('Datos/datos_vista',$data);
        }
    }
}