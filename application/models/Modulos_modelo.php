<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulos_modelo extends CI_Model{
	
	public function obtenerModulo() {
		$query = $this->db->get('modulos');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	/*function obtenerModulosPorEstado($estatus){
		if($estatus == 0 || $estatus == 1)
			$this->db->where('estatus', $estatus);
		$resultado = $this->db->get('modulos')->result();
		return $resultado;
	}
	function obtenerModulosPadres(){
		$this->db->where('estatus', 1);
		$this->db->where('padre', 1);
		$resultado = $this->db->get('modulos')->result();
		return $resultado;
	}
	function agregarModulo($data){
		$this->db->where('nombre', $data['nombre']);
		$nomExiste = $this->db->get('modulos');
		if ($nomExiste->num_rows()>0) {
			return 2;
		}
		else{
			$this->db->insert('modulos', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else{
				return false;
			}
		}
	}
	function obtenerModulosPorId($id){
		$this->db->where('id', $id);
		$resultado = $this->db->get('modulos')->result();
		return $resultado;
	}
	
	function cambiarEstatusModuloHijo($id){
		$this->db->where('enlace', $id);
		$this->db->set('estatus', 0);
		$this->db->update('modulos');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}
	function cambiarEnlaceModuloHijo($id){
		$this->db->where('enlace', $id);
		$this->db->set('enlace', 0);
		$this->db->update('modulos');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}
	function cambiarEstatusModulo($id, $estatus){
		$this->db->where('id', $id);
		$this->db->set('estatus', $estatus);
		$this->db->update('modulos');
		if ($this->db->affected_rows() > 0) {
			$this->db->where('enlace', $id);
			$this->db->where('estatus', 1);
			$nomExiste = $this->db->get('modulos');
			if ($nomExiste->num_rows()>0) {
				return 2;
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	public function validarPerfil($idPerfil,$ruta){
    	$this->db->select('*');
    	$this->db->join('modulos', 'modulos.id = perfiles_modulos.id_modulo');
        $this->db->where('perfiles_modulos.id_perfil', $idPerfil);
        $this->db->where('modulos.ruta', $ruta);
		$query = $this->db->get('perfiles_modulos');
		if ($query->num_rows() > 0) {
		  return true;
		}
		else{
		  return false;
		 }
    }
	
	function editarModulo($id,$data){*/
		/*$this->db->where('nombre', $data['nombre']);
		$nomExiste = $this->db->get('modulos');
		if ($nomExiste->num_rows()>0) {
			return 2;
		}
		else{*/
/*			$this->db->where('id', $id);
			$this->db->update('modulos',$data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else{
				return false;
			}
		//}
	}

	public function modulosXPerfil($idPerfil){
        $query = $this->db->query("SELECT * , (SELECT 'si' FROM perfiles_modulos WHERE perfiles_modulos.`id_modulo` = modulos.id AND perfiles_modulos.`id_perfil` = $idPerfil) tiene FROM modulos;");
        return $query->result();
    }
    public function obtenerModulosXPerfil($id){
        $this->db->select('*');
        $this->db->join('modulos', 'modulos.id = perfiles_modulos.id_modulo');
        $this->db->where('perfiles_modulos.id_perfil',$id);
        $this->db->where('modulos.estatus',1);
        $this->db->order_by("modulos.nombre asc");
        return $this->db->get('perfiles_modulos')->result();
        
    }
*/
}