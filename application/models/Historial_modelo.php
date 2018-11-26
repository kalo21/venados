<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historial_modelo extends CI_Model{

    public function obtenerPedidos($estatus) {
        $this->db->select('pedidos.id, usuarios.nombre, pedidos.total, pedidos.estatus, pedidos.fecha');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $this->session->idEmpresa);
        switch($estatus) {
            case 1: {
                $this->db->where('pedidos.estatus', 'Solicitado');
                break;
            }
            case 2: {
                $this->db->where('pedidos.estatus', 'Cancelado');
                break;
            }
            case 3: {
                $this->db->where('pedidos.estatus', 'Entregado');
                break;
            }
            case 4: {
                $this->db->where('pedidos.estatus', 'Realizado');
                break;
            }
            case 5: {
                $this->db->where('pedidos.estatus', 'En proceso');
                break;
            }
            case 6: {
                $this->db->where('pedidos.estatus', 'Eliminado');
                break;
            }
            default: {
                break;
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function informacionPedido($id) {
        $this->db->select('pedidos.id, usuarios.nombre, productos.nombre as productoNombre, detallepedidos.precio, detallepedidos.cantidad, pedidos.total');
        $this->db->from('detallepedidos');
        $this->db->join('pedidos', 'pedidos.id = detallepedidos.idpedido');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->join('productos', 'productos.id = detallepedidos.idproducto');
        $this->db->where('detallepedidos.idpedido', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarFecha($fechaInicio, $fechaFinal) {
        $this->db->select('pedidos.id, usuarios.nombre, pedidos.total, pedidos.estatus, pedidos.fecha');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $this->session->idEmpresa);
        $this->db->where('pedidos.fecha >=', $fechaInicio);
        $this->db->where('pedidos.fecha <=', $fechaFinal);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarUsuario($usuario) {
        $this->db->select('pedidos.id, usuarios.nombre, pedidos.total, pedidos.estatus, pedidos.fecha');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $this->session->idEmpresa);
        $this->db->where('usuarios.nombre', $usuario);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscaEspecifica($data) {
        $this->db->select('pedidos.id, usuarios.nombre, pedidos.total, pedidos.estatus, pedidos.fecha');
        $this->db->from('pedidos');
        $this->db->join('usuarios', 'usuarios.id = pedidos.idusuario');
        $this->db->where('pedidos.idempresa', $this->session->idEmpresa);
        if($data['usuario'] != "") {
            $this->db->where('usuarios.nombre', $data['usuario']);
        }
        if($data['fechaInicio'] != "") {
            $this->db->where('pedidos.fecha >=', $data['fechaInicio']);
            $this->db->where('pedidos.fecha <=', $data['fechaFinal']);
        }
        switch($data['estado']) {
            case 1: {
                $this->db->where('pedidos.estatus', 'Solicitado');
                break;
            }
            case 2: {
                $this->db->where('pedidos.estatus', 'Cancelado');
                break;
            }
            case 3: {
                $this->db->where('pedidos.estatus', 'Entregado');
                break;
            }
            case 4: {
                $this->db->where('pedidos.estatus', 'Realizado');
                break;
            }
            case 5: {
                $this->db->where('pedidos.estatus', 'En proceso');
                break;
            }
            case 6: {
                $this->db->where('pedidos.estatus', 'Eliminado');
                break;
            }
            default: {
                break;
            }
        }
        $query = $this->db->get();
        return $query->result();
    }



}