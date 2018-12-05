<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    public function __construct(){
        parent::__construct();
         $this->load->model('Pedidos_modelo');
         $this->load->helper(array('funciones_generales_helper','url'));
    }

    public function index() {
        if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Pedidos");
    		$this->load->view('Pedidos/pedidos_vista',$data);
        }
    }

    public function obtenerPedidos() {
        echo json_encode($this->Pedidos_modelo->obtenerPedidos($this->session->idEmpresa));
    }

    public function informacionPedido() {
        echo json_encode($this->Pedidos_modelo->informacionPedidos($this->input->post('id')));
    }

    public function cancelarPedido() {
        $this->Pedidos_modelo->cancelarPedido($this->input->post('id'));
    }

    public function finalizarPedido() {
        $this->Pedidos_modelo->finalizarPedido($this->input->post('id'));
    }

    public function enproceso() {
        echo json_encode($this->Pedidos_modelo->pedidoProceso($this->input->post('id')));
    }

    public function entregarPedido() {
        $idPedido = hexdec($this->input->post('idPedido'));
        if($this->input->post('id') == $idPedido) {
            $this->Pedidos_modelo->entregarPedido($idPedido);
            echo true;
        }
        else {
            echo false;
        }
    }

}