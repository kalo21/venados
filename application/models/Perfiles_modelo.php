<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles_modelo extends CI_Model{

	public function obtenerPerfiles() {
		$query = $this->db->get('perfiles');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	
	public function obtenerPerfil($estatus) {
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
			
		} 
		$query = $this->db->get('perfiles');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function obtenerPerfilesPorEstado($estatus){
		if($estatus == 0 || $estatus == 1)
			$this->db->where('estatus', $estatus);
		$resultado = $this->db->get('perfiles')->result();
		return $resultado;
	}

	function obtenerPerfilesPorId($id){
		$this->db->where('id', $id);
		$resultado = $this->db->get('perfiles')->result();
		return $resultado;
	}

	function cambiarEstatusPerfil($id, $estatus){
		$this->db->where('id', $id);
		$this->db->set('estatus', $estatus);
		$this->db->update('perfiles');
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
	
	function editarPerfil($id,$data){
		$this->db->where('nombre', $data['nombre']);
		$nomExiste = $this->db->get('perfiles');
		if ($nomExiste->num_rows()>0) {
			return 2;
		}
		else{
			$this->db->where('id', $id);
			$this->db->update('perfiles',$data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else{
				return false;
			}
		}
	}
	function agregarPerfil($data){
		$this->db->where('nombre', $data['nombre']);
		$nomExiste = $this->db->get('perfiles');
		if ($nomExiste->num_rows()>0) {
			return 2;
		}
		else{
			$this->db->insert('perfiles', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else{
				return false;
			}
		}
	}
	public function agregarModulo($data){
	  $this->db->insert('perfiles_modulos', $data);
      if ($this->db->affected_rows() > 0) {
        return true;
      }
      else{
        return false;
      }
	}
	
	public function eliminarModulo($id_perfil,$id_modulo){
	  $this->db->where('id_perfil',$id_perfil);
	  $this->db->where('id_modulo',$id_modulo);
	  $this->db->delete('perfiles_modulos');
      if ($this->db->affected_rows() > 0) {
        return true;
      }
      else{
        return false;
      }
	}
}