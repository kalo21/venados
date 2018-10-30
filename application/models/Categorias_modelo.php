<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_modelo extends CI_Model
{
	function obtenerCategorias($estatus){
		if ($estatus == 3) {
			return $this->db->get('categorias')->result();
		}else{
			$this->db->where('estatus', $estatus);
			return $this->db->get('categorias')->result();
		}	
	}

	function obtenerCategoriaEditar($id){
		$this->db->where('id', $id);
		return $this->db->get('categorias')->result();
	}

	function agregarCategoria($data){
		$this->db->where('descripcion', $data['descripcion']);
		$descExiste = $this->db->get('categorias');
		if($descExiste->num_rows()>0){
			return 2;
		}else{
			$this->db->insert('categorias', $data);
			if($this->db->affected_rows()>0){
				return true;
			}else{
				return false;
			}
		}
	}

	function editarCategoria($id, $data, $devieja){
		if($devieja == $data['descripcion']){
			$this->db->where('id', $id);
			$this->db->update('categorias', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}else{
				return false;
			}
		}
		else{
			$this->db->where('descripcion', $data['descripcion']);
			$descExiste = $this->db->get('categorias');
			if($descExiste->num_rows() > 0){
				return 2;
			}else{
				$this->db->where('id', $id);
				$this->db->update('categorias', $data);
				if ($this->db->affected_rows() > 0) {
					return true;
				}else{
					return false;
				}
			}
		}
		
	}
}