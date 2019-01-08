<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldos extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Saldos_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }

    public function index(){
    	if(validacion()) {
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Saldos");
            $data['empresas'] = $this->Saldos_modelo->obtenerEmpresas();
            $data['vendedores'] = $this->Saldos_modelo->obtenerVendedores();
    		$this->load->view('Saldos/saldos_vista',$data);
        }
    }

    public function buscarEmpresa() {
        echo json_encode($this->Saldos_modelo->buscarEmpresa($this->input->post()));
    }

    public function buscarVendedor() {
        echo json_encode($this->Saldos_modelo->buscarVendedor($this->input->post()));
    }

    public function buscarCliente() {
        $data['movimientos'] = $this->Saldos_modelo->buscarCliente($this->input->post());
        $data['saldo'] = $this->Saldos_modelo->obtenerTotalRecargas($this->input->post()); 
        $data['pedidos'] = $this->Saldos_modelo->obtenerTotalPedidos($this->input->post());
        echo json_encode($data);
    }

}