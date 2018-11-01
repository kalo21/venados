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

	public function agregarModulo($data) {
		$this->db->where('nombre', $data['inpNombre']);
		$aux = $this->db->get('modulos');
		if($aux->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre ya se encuentra registrado</li>');
		}
		else {
			$datos = array(
				"nombre" => $data['inpNombre'],
				"descripcion" => $data['inpDescripcion'],
				"ruta" => "index.php/".$data['inpNombre'],
				"icono" => $data['inpIcono'],
				"estatus" => 1
			);
			$this->db->insert('modulos', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo el modulo en la base de datos, intente de nuevo</li>');
			}
		}
        
    }
	
	public function obtenerDatos($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('modulos')->row();
		//echo $this->db->last_query();
		return $query;
	}
	
}