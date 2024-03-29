<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historial extends CI_Controller {

    public function __construct(){
        parent::__construct();
         $this->load->model('Historial_modelo');
         $this->load->helper(array('funciones_generales_helper','url'));
    }

    public function index() {
        if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Historial");
    		$this->load->view('Historial/historial_vista',$data);
        }
    }

    public function obtenerPedidos() {
        echo json_encode($this->Historial_modelo->obtenerPedidos($this->input->post('estatus')));
    }

    public function informacion($id) {
        $data['datos'] = $this->Historial_modelo->informacionPedido($id);
        $this->load->view('Historial/historial_modal', $data);
    }

    public function buscarFecha() {
        echo json_encode($this->Historial_modelo->buscarFecha($this->input->post('fechaInicio'), $this->input->post('fechaFinal')));
    }

    public function buscarUsuario() {
        echo json_encode($this->Historial_modelo->buscarUsuario($this->input->post('usuario')));
    }

    public function buscaEspecifica() {
        echo json_encode($this->Historial_modelo->buscaEspecifica($this->input->post()));
    }
}