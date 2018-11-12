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
            default: {
                break;
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

}