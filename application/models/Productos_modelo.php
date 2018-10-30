<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_modelo extends CI_Model {

    public function __construct(){
        parent::__construct();
	}
	public function obtenerProductos($estatus) {
		
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
		}
		$query = $this->db->get('productos');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
}