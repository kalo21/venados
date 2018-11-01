<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles_modelo extends CI_Model{

	public function obtenerPerfiles() {
		$query = $this->db->get('Perfiles');
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
		$query = $this->db->get('Perfiles');
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
        //Consultar
        $this->db->where('id', $id);
        $registro = $this->db->get('Perfiles')->row();
        if($registro->estatus == $estatus){
            return array('exito' => false,'msg' => 'El dato no se actualizó porque el cambio ya se habia realizado');
        }
        //Actualizar
		$estado = array('estatus' => $estatus);
		$this->db->where('id', $id);
		$this->db->update('Perfiles', $estado);
        if($this->db->affected_rows() > 0){
            return array('exito' => true,'msg' => '');
        }
        else{
             return array('exito' => false,'msg' => 'No se modificó el estatus del perfil seleccionado');
        }
	}
	
	public function agregarPerfil($data) {
		$this->db->where('nombre', $data['inpNombre']);
		$aux = $this->db->get('Perfiles');
		if($aux->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre ya se encuentra registrado</li>');
		}
		else {
			$datos = array(
				"nombre" => $data['inpNombre'],
				"descripcion" => $data['inpDescripcion'],
				"estatus" => 1
			);
			$this->db->insert('Perfiles', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo el perfil en la base de datos, intente de nuevo</li>');
			}
		}
        
    }
	
	public function obtenerDatos($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('perfiles')->row();
		//echo $this->db->last_query();
		return $query;
	}
	
}