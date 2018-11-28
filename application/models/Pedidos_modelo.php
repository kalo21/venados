<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_modelo extends CI_Model{
    
    public function obtenerPedidos($id) {
        $this->db->select('pedidos.id, pedidos.estatus, usuarios.nombre');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $id);
        $this->db->where('pedidos.estatus !=', 'Entregado');
        $this->db->where('pedidos.estatus !=', 'Cancelado');
        $this->db->where('pedidos.estatus !=', 'Eliminado');
        $query = $this->db->get();
        return $query->result();
    }

    public function informacionPedidos($id) {
        $this->db->select('pedidos.estatus, pedidos.id, usuarios.nombre, productos.nombre as productoNombre, detallepedidos.precio, detallepedidos.cantidad, pedidos.total');
        $this->db->from('detallepedidos');
        $this->db->join('pedidos', 'pedidos.id = detallepedidos.idpedido');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->join('productos', 'productos.id = detallepedidos.idproducto');
        $this->db->where('detallepedidos.idpedido', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function cancelarPedido($id) {
        $this->db->select('pedidos.total, pedidos.idusuario');
        $this->db->where('pedidos.id', $id);
        $query = $this->db->get('pedidos')->row();

        $this->db->select('clientes.saldo');
        $this->db->where('id_usuario', $query->idusuario);
        $saldo = $this->db->get('clientes')->row();

        $total = array('saldo' => $saldo->saldo + $query->total);
        $this->db->where('id_usuario', $query->idusuario);
        $this->db->update('clientes', $total);

        $data = array( 'estatus' => 'Cancelado');
        $this->db->where('pedidos.id', $id);
        $this->db->update('pedidos', $data);
        // $this->db->select('pedidos.idusuario');
        // $this->db->where('pedidos.id', $id);
        // $idUsuario = $this->db->get('pedidos')->row();
        // $notificacion = array(
        //     'titulo'      => $this->session->nombreEmpresa,
        //     'mensaje'     => $msg,
        //     'estatus'     => 1,
        //     'id_usuario'  => $idUsuario->idusuario
        // );
        // $this->db->insert('notificaciones', $notificacion);
    }
    
    public function pedidoProceso($id) {
        $this->db->where('pedidos.id', $id);
        $this->db->where('estatus !=', 'Cancelado');
        $data = array('estatus' => 'En proceso');
        $this->db->update('pedidos', $data);
        if($this->db->affected_rows() > 0) {
            return array('exito' => true, 'msg' => '');
        }
        else {
            return array('exito' => false, 'msg' => 'No se pudo cambiar el estado del pedido debido a que se había cancelado');
        }
    }
    
    public function finalizarPedido($id) {
        $this->db->where('pedidos.id', $id);
        $data = array('estatus' => 'Realizado');
        $this->db->update('pedidos', $data);

        $this->db->select('pedidos.total');
        $this->db->where('pedidos.id', $id);
        $total = $this->db->get('pedidos')->row();

        $this->db->select('clientes.saldo');
        $this->db->where('id_usuario', $this->session->idUsuario);
        $saldo = $this->db->get('clientes')->row();

        $data = array('saldo' => $total->total + $saldo->saldo);

        $this->db->select('clientes.saldo');
        $this->db->where('id_usuario', $this->session->idUsuario);
        $this->db->update('clientes', $data);
        // $this->db->select('pedidos.idusuario');
        // $this->db->where('pedidos.id', $id);
        // $idUsuario = $this->db->get('pedidos')->row();
        // $notificacion = array(  
        //     'titulo' => $this->session->nombreEmpresa,
        //     'mensaje' => 'Pedido finalizado',
        //     'estatus' => 1
        //     'id_usuario'  => $idUsuario->idusuario
        // );
        // $this->db->insert('notificaciones', $notificacion);
    }

    public function entregarPedido($idPedido) {
        $data = array('estatus' => 'Entregado');
        $this->db->where('id', $idPedido);
        $this->db->update('pedidos', $data);
    }

}