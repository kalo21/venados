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

    public function obtenerPedidos() {
        $this->db->where('idusuario', $this->session->idUsuario);
        $this->db->where('estatus', 'Solicitado');
        $query = $this->db->get('pedidos');
        foreach($query->result() as $empresa) {
            $this->db->where('idpedido', $empresa->id);
            $aux = $this->db->get('detallepedidos');
            foreach($aux->result() as $producto) {
                $this->db->select('productos.nombre, productos.descripcion');
                $this->db->where('id', $producto->idproducto);
                $info = $this->db->get('productos')->row();
                $data[] = array(
                    'name'          => $info->nombre,
                    'description'   => $info->descripcion,
                    'price'         => $producto->precio,
                    'qty'           => $producto->cantidad,
                    'idPedido'      => $empresa->id
                );
            }
        }
        return $data;
    }

    public function cancelarPedido($idPedido) {
        $this->db->where('id', $idPedido);
        $query = $this->db->get('pedidos')->row();
        if($query->estatus == 'Solicitado') {
            $data = array('estatus' => 'Cancelado');
            $this->db->where('id', $idPedido);
            $this->db->update('pedidos', $data);
            $this->db->select('clientes.saldo');
            $this->db->where('clientes.id_usuario', $this->session->idUsuario);
            $saldo = $this->db->get('clientes')->row();
            $monto = array('saldo' => $saldo->saldo + $query->total);
            $this->db->where('clientes.id_usuario', $this->session->idUsuario);
            $this->db->update('clientes', $monto);
            return array('exito' => true, 'msg' => 'El pedido se ha cancelado');
        }
        else {
            return array('exito' => false, 'msg' => 'El pedido ya se encuentra en proceso y no se puede cancelar');
        }
    }

    public function obtenerRealizados() {
        $this->db->where('idusuario', $this->session->idUsuario);
        $this->db->where('estatus', 'Realizado');
        $query = $this->db->get('pedidos');
        foreach($query->result() as $empresa) {
            $this->db->where('idpedido', $empresa->id);
            $aux = $this->db->get('detallepedidos');
            foreach($aux->result() as $producto) {
                $this->db->select('productos.nombre, productos.descripcion');
                $this->db->where('id', $producto->idproducto);
                $info = $this->db->get('productos')->row();
                $data[] = array(
                    'name'          => $info->nombre,
                    'description'   => $info->descripcion,
                    'price'         => $producto->precio,
                    'qty'           => $producto->cantidad,
                    'idPedido'      => $empresa->id
                );
            }
        }
        return $data;
    }

    public function obtenerCancelados() {
        $this->db->where('idusuario', $this->session->idUsuario);
        $this->db->where('estatus', 'Cancelado');
        $query = $this->db->get('pedidos');
        foreach($query->result() as $empresa) {
            $this->db->where('idpedido', $empresa->id);
            $aux = $this->db->get('detallepedidos');
            foreach($aux->result() as $producto) {
                $this->db->select('productos.nombre, productos.descripcion');
                $this->db->where('id', $producto->idproducto);
                $info = $this->db->get('productos')->row();
                $data[] = array(
                    'name'          => $info->nombre,
                    'description'   => $info->descripcion,
                    'price'         => $producto->precio,
                    'qty'           => $producto->cantidad,
                    'idPedido'      => $empresa->id
                );
            }
        }
        return $data;
    }

    public function eliminarPedido($idPedido) {
        $data = array('estatus' => 'Eliminado');
        $this->db->where('id', $idPedido);
        $this->db->update('pedidos', $data);
    }
}