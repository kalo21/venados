<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Carrito_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if($this->session->idPerfil == 4) {
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Carrito");
    		$this->load->view('Carrito/carrito_vista',$data);
        }
    }

    public function eliminarProducto() {
        $this->cart->remove($this->input->post('rowid'));
    }

    public function cancelarCarrito() {
        foreach($this->cart->contents() as $productos) {
            if($productos['idEmpresa'] == hexdec($this->input->post('idEmpresa'))) {
                $this->cart->remove($productos['rowid']);
            }
        }
    }

    public function realizarPedido() {
        echo json_encode($this->Carrito_modelo->realizarPedido(hexdec($this->input->post('idEmpresa'))));
    }

    public function actualizarCantidad() {
        if($this->input->post('qty') > 0) {
            $producto = array(
                'rowid' => $this->input->post('rowid'),
                'qty'   => $this->input->post('qty')
            );
            $this->cart->update($producto);
            echo $this->cart->total();
        }
        else {
            echo $this->cart->total();
        }
    }

    public function confirmarPedido() {
        echo json_encode($this->Carrito_modelo->confirmarPedido());
    }

    public function obtenerPedidos() {
        echo json_encode($this->Carrito_modelo->obtenerPedidos());
    }

    public function cancelarPedido() {
        echo json_encode($this->Carrito_modelo->cancelarPedido(hexdec($this->input->post('idPedido'))));
    }

    public function obtenerRealizados() {
        echo json_encode($this->Carrito_modelo->obtenerRealizados());
    }

    public function obtenerCancelados() {
        echo json_encode($this->Carrito_modelo->obtenerCancelados());
    }

    public function eliminarPedido() {
        $this->Carrito_modelo->eliminarPedido(hexdec($this->input->post('idPedido')));
    }
}