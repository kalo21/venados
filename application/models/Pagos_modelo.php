<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagos_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function infoEmpresas() {
        $this->db->select('empresas.id, empresas.nombre, empresas.img_fondo, clientes.saldo');
        $this->db->join('clientes', 'clientes.id_usuario = empresas.id_usuario');
        $query = $this->db->get('empresas');
        return $query->result();
    }

    public function pagarEmpresas($id, $monto) {

        $this->db->select('clientes.saldo, clientes.id');
        $this->db->from('empresas');
        $this->db->join('clientes', 'clientes.id_usuario = empresas.id_usuario');
        $this->db->where('empresas.id', $id);
        $aux = $this->db->get()->row();
        
        if($monto > $aux->saldo) {
            return array('exito' => false, 'msg' => 'El monto insertado excede el dinero de la empresa');
        }
        else {
            $data = array(
                'id_usuario' => $this->session->idUsuario,
                'id_empresa' => $id,
                'monto'      => $monto
            );
            $this->db->insert('movimientos', $data);

            $saldo = array('saldo' => $aux->saldo - $monto);
            $this->db->where('clientes.id', $aux->id);
            $this->db->update('clientes', $saldo);
            return array('exito' => true, 'msg' => 'Movimiento exitoso');
        }
    }

}
