<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos_model extends CI_Model{

	public function obtenerEventos($estatus) {
		
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('status', $estatus);
		}

		$query = $this->db->get('eventos');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	public function agregarEvento($datos){
		$this->db->insert('eventos', $datos);
		if($this->db->affected_rows() > 0) {
			return array('exito' => true, 'msg' => 'todo bien baby');
		}
		else {
			return array('exito' => false, 'msg' => '<li>No se guardo el producto en la base de datos, intente de nuevo</li>');
		}
		//echo $this->db->last_query();
	}
}