<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
	}
	public function obtenerEmpresa($estatus) {
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
		} 
		$query = $this->db->get('empresas');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	public function cambiarEstado($id, $estatus) {
		if($estatus == 1) {
			$estatus = 0;
		}
		else {
			$estatus = 1;
		}
		$estado = array('estatus' => $estatus);
		$this->db->where('id', $id);
		$this->db->update('empresas', $estado);
	}
}