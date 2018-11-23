<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiendas extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Tiendas_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Empresa");
    		$this->load->view('Tiendas/tiendas_vista',$data);
        }
    }

    public function obtenerEmpresas() {
        echo json_encode($this->Tiendas_modelo->infoEmpresas());
    }
    
    public function productos($id) {
        echo json_encode($this->Tiendas_modelo->obtenerProductos($id));
    }
    
    public function infoProducto($id) {
        $data['datos'] = $this->Tiendas_modelo->infoProducto($id);
        $this->load->view('Tiendas/tiendas_modal', $data);
    }

    public function agregarCarrito() {
        $nombreEmpresa = $this->Tiendas_modelo->nombreEmpresa($this->input->post('idEmpresa'));
        $data = array(
            'id'            =>  $this->input->post('idProducto'),
            'qty'           =>  $this->input->post('cantidad'),
            'price'         =>  $this->input->post('precio'),
            'name'          =>  $this->input->post('nombre'),
            'idEmpresa'     =>  $this->input->post('idEmpresa'),
            'description'   =>  $this->input->post('descripcion'),
            'nombreEmpresa' =>  $nombreEmpresa->nombre
        );
        $this->cart->insert($data);
        echo json_encode($this->cart->contents());
    }
}