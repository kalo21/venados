<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_modelo extends CI_Model{
    
    public function obtenerPedidos($id) {
        $this->db->select('pedidos.id, pedidos.estatus, usuarios.nombre');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $id);
        $query = $this->db->get();
        return $query->result();
    }
    /*
    $this->db->select('pedidos.id, pedidos.estatus, usuarios.nombre, productos.nombre as productoNombre, detallepedidos.precio');
        $this->db->from('detallepedidos');
        $this->db->join('pedidos', 'pedidos.id = detallepedidos.idpedido');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->join('productos', 'productos.id = detallepedidos.idproducto');
        $this->db->where('pedidos.idempresa', $id);
        $query = $this->db->get();
        return $query->result();
    */
}