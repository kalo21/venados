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
        $this->db->select('clientes.saldo');
        $this->db->where('clientes.id_usuario', $this->session->idUsuario);
        $query = $this->db->get('clientes')->row();
        if($query->saldo >= $total) {
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
            $data = array(
                'saldo' => $query->saldo - $total
            );
            $this->db->where('clientes.id_usuario', $this->session->idUsuario);
            $this->db->update('clientes', $data);
            return array('exito' => true, 'msg' => '');
        }
        else {
            return array('exito' => false, 'msg' => 'No hay saldo suficiente para realizar el pedido');
        }
    }

    public function confirmarPedido() {
        $this->db->select('clientes.saldo');
        $this->db->where('clientes.id_usuario', $this->session->idUsuario);
        $query = $this->db->get('clientes')->row();
        if($query->saldo >= $this->cart->total()) {
            return array('exito' => true, 'msg' => '');
        }
        else {
            return array('exito' => false, 'msg' => 'No hay saldo suficiente para realizar el pedido');
        }
    }
}