<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrito_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function realizarPedido($idEmpresa) {
        $total = 0;
        foreach($this->cart->contents() as $producto) {
            if($producto['idEmpresa'] == $idEmpresa) {
                $total += $producto['subtotal'];
            }
        }
        $pedido = array(
            'idempresa' => $idEmpresa,
            'idusuario' => $this->session->idUsuario,
            'fecha'     => date('Y/m/d'),
            'hora'      => date('h:i:sa'),
            'total'     => $total,
            'estatus'   => 'Solicitado'
        );
        $this->db->insert('pedidos', $pedido);
        $idPedido = $this->db->insert_id();
        foreach($this->cart->contents() as $producto) {
            if($producto['idEmpresa'] == $idEmpresa) {
                $detallepedidos = array(
                    'idpedido'   => $idPedido,
                    'idproducto' => $producto['id'],
                    'cantidad'   => $producto['qty'],
                    'precio'     => $producto['price']
                );
                $this->cart->remove($producto['rowid']);
                $this->db->insert('detallepedidos', $detallepedidos);
            }
        }
    }

}