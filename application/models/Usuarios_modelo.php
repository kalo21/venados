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

	public function agregarUsuario($data) {
		$this->db->where('nombre', $data['inpNombre']);
		$aux = $this->db->get('Usuarios');
		if($aux->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre ya se encuentra registrado</li>');
		}
		else {
			$datos = array(
				"nombre" => $data['inpNombre'],
				"contraseña" => password_hash($data['inpContrasena'],PASSWORD_DEFAULT),
				"correo" => $data['inpCorreo'],
				"idperfil" => $data['inpPerfil'],
				"estatus" => 1
			);
			$this->db->insert('Usuarios', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo el Usuario en la base de datos, intente de nuevo</li>');
			}
		}
	}
	
	public function modificarUsuario($data) {
		if($data['inpNombre'] == $data['oldNombre'] && $data['inpDescripcion'] == $data['oldDescripcion']) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombre'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombre']);
			$query = $this->db->get('Usuarios');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombre']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
			$datos = array(
				'nombre' => $data['inpNombre'],
				'descripcion' => $data['inpDescripcion']
			);
			$this->db->where('id', $data['id']);
			$this->db->update('Usuarios', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		else if($data['inpDescripcion'] != $data['oldDescripcion']) {
			$datos = array(
				'descripcion' => $data['inpDescripcion']
			);
			$this->db->where('id', $data['id']);
			$this->db->update('Usuarios', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
		}
	}
	
	public function obtenerDatos($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('Usuarios')->row();
		return $query;
	}

	public function obtenerPerfiles() {
		$query = $this->db->get('perfiles');
		return $query->result();
	}

}