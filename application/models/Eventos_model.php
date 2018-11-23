<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos_model extends CI_Model{

	public function obtenerEventos($estatus) {
		
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('status', $estatus);
		}

		$query = $this->db->get('eventos');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	public function agregarEvento($datos, $file_nombre){

		$data = array(
			'nombre' => $datos['inpNombre'],
			'descripcion' => $datos['inpDescripcion'],
			'fecha_inicial' => $datos['fechaInicio'],
			'fecha_fin' => $datos['fechaFinal'],
			'imagen' => $file_nombre,
			'status' => 1
		);

		$this->db->insert('eventos', $data);
		if($this->db->affected_rows() > 0) {
			return array('exito' => true, 'msg' => 'todo bien baby');
		}
		else {
			return array('exito' => false, 'msg' => '<li>No se guardo el producto en la base de datos, intente de nuevo</li>');
		}
		//echo $this->db->last_query();
	}

	public function modificarEvento($datos, $file_nombre){
		$data = array(
			'nombre' => $datos['inpNombre'],
			'descripcion' => $datos['inpDescripcion'],
			'fecha_inicial' => $datos['inpInicioD'],
			'fecha_fin' => $datos['inpFinD'],
			'imagen' => $file_nombre,
			'status' => 1
		);
		$this->db->where('id', $datos['id']);
		$this->db->update('eventos', $data);
		if($this->db->affected_rows() > 0) {
			return array('exito' => true, 'msg' => 'todo bien baby');
		}
		else {
			return array('exito' => false, 'msg' => '<li>No se guardo el producto en la base de datos, intente de nuevo</li>');
		}
	}

	public function cambiarEstado($id, $status) {
		if($status == 1) {
			$status = 0;
		}
		else {
			$status = 1;
		}
		$estado = array('status' => $status);
		$this->db->where('id', $id);
		$this->db->update('eventos', $estado);
	}

	public function datosFormulario($id){
		$this->db->where('id', $id);
		$res = $this->db->get('eventos');
		if ($res->num_rows() > 0) {
			return $res->row();;
		}else{
			return false;
		}
	}
}