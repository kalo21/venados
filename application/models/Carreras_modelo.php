<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carreras_modelo extends CI_Model
{
	
	function obtenerCarreras($estatus){
		if ($estatus == 3) {
			return $this->db->get('carreras')->result();
		}else{
			$this->db->where('estatus', $estatus);
			return $this->db->get('carreras')->result();
		}	
	}

	function obtenerCarreraEditar($id){
		$this->db->where('id', $id);
		return $this->db->get('carreras')->result();
	}

	function agregarCarrera($data){
		$this->db->where('descripcion', $data['descripcion']);
		$descExiste = $this->db->get('carreras');
		if($descExiste->num_rows()>0){
			return 2;
		}else{
			$this->db->insert('carreras', $data);
			if($this->db->affected_rows()>0){
				return true;
			}else{
				return false;
			}
		}
	}

	function editarCarrera($id, $data, $devieja){
		if($devieja == $data['descripcion']){
			$this->db->where('id', $id);
			$this->db->update('carreras', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}else{
				return false;
			}
		}
		else{
			$this->db->where('descripcion', $data['descripcion']);
			$descExiste = $this->db->get('carreras');
			if($descExiste->num_rows() > 0){
				return 2;
			}else{
				$this->db->where('id', $id);
				$this->db->update('carreras', $data);
				if ($this->db->affected_rows() > 0) {
					return true;
				}else{
					return false;
				}
			}
		}
		
	}

	function cambiarEstatusCarrera($id, $estatus){
		$this->db->where('id', $id);
		$this->db->set('estatus', $estatus);
		$this->db->update('carreras');
		if ($this->db->affected_rows()>0) {
			return true;
		}else{
			return false;
		}
	}
}