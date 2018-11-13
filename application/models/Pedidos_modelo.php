<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_modelo extends CI_Model{
    
    public function obtenerPedidos($id) {
        $this->db->select('pedidos.id, pedidos.estatus, usuarios.nombre');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $id);
        $this->db->where('pedidos.estatus !=', 'Entregado');
        $this->db->where('pedidos.estatus !=', 'Cancelado');
        $query = $this->db->get();
        return $query->result();
    }

    public function informacionPedidos($id) {
        $this->db->select('pedidos.id, usuarios.nombre, productos.nombre as productoNombre, detallepedidos.precio, detallepedidos.cantidad');
        $this->db->from('detallepedidos');
        $this->db->join('pedidos', 'pedidos.id = detallepedidos.idpedido');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->join('productos', 'productos.id = detallepedidos.idproducto');
        $this->db->where('detallepedidos.idpedido', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function cancelarPedido($id) {
        $this->db->where('pedidos.id', $id);
        $data = array( 'estatus' => 'Cancelado');
        $this->db->update('pedidos', $data);
    }
    
    public function finalizarPedido($id) {
        $this->db->where('pedidos.id', $id);
        $data = array('estatus' => 'Realizado');
        $this->db->update('pedidos', $data);
    }

}