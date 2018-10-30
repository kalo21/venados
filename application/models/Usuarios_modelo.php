<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_modelo extends CI_Model {

    public function __construct(){
        parent::__construct();
	}
	public function obtenerUsuarios($estatus) {
		
		$this->db->select('usuarios.id, usuarios.nombre, usuarios.correo, perfiles.nombre as nombre2, usuarios.estatus');
		$this->db->from('usuarios');
		$this->db->join('perfiles ', 'usuarios.idperfil = perfiles.id');
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('usuarios.	estatus', $estatus);
		}
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
}