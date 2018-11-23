<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recargas_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
	}
    public function agregarRecargas($data) {
        $this->db->where('pin',$data['inpPIN']);
        $resultado = $this->db->get('vendedores')->row();
        if($resultado != null){
            $this->db->where('id',$data['inpUsuario']);
            $query = $this->db->get('clientes')->row();
            if($query != null) {
                $datos = array(
                    "monto" => $data['inpMonto'],
                    "id_cliente" => $query->id,
                    "id_vendedor" => $this->session->idUsuario);
                $this->db->insert('recargas', $datos);

                $datos2 = array(
                    "titulo" => "Recarga exitosa!",
                    "mensaje" => "Se ha recargado un monto de $".$data['inpMonto'],
                    "estatus" => 1
                );
                $this->db->insert('notificaciones', $datos2);

                $this->db->select('clientes.saldo');
                $this->db->where('id',$query->id);
                $saldo =  $this->db->get('clientes')->row();
                $saldo = $saldo->saldo + $data['inpMonto'];

                $this->db->where('id',$query->id);
                $saldoCliente = array("saldo" => $saldo);
                $this->db->update('clientes', $saldoCliente);

                if($this->db->affected_rows() > 0) {
                    return array('exito' => true, 'msg' => '');
                }
                else {
                    return array('exito' => false, 'msg' => '<li>No se guardo el modulo en la base de datos, intente de nuevo</li>');
                }
            }
            else {
                return array('exito' => false, 'msg' => '<li>No se encuentra registrado ese usuario</li>');
            }
        }
        else {
            return array('exito' => false, 'msg' => '<li>El pin es incorrecto</li>');
        }
	}
    
    	public function obtenerRecargas() {
         $this->db->select('CONCAT(clientes.nombre," ",clientes.apellidopaterno," ",clientes.apellidomaterno) as nombre,recargas.fecha, recargas.id, recargas.monto');   
         $this->db->join('clientes', 'recargas.id_cliente = clientes.id');      
         $this->db->where('recargas.id_vendedor', $this->session->idVendedor);    
        $query = $this->db->get('recargas');
        //echo $this->db->last_query();
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
}