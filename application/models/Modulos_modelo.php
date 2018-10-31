<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulos_modelo extends CI_Model{
	
	public function obtenerModulos($estatus) {
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
		}
		$query = $this->db->get('modulos');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
}