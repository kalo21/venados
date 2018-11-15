<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disponibilidad_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function obtenerProductos() {
        $this->db->where('idempresa', $this->session->idEmpresa);
        $query = $this->db->get('productos');
        return $query->result();
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
		$this->db->update('productos', $estado);
    }
    
}