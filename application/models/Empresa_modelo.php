<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
	}
	public function obtenerEmpresa($estatus) {
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
		} 
		$query = $this->db->get('empresas');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	public function obtenerUsuario($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('usuarios')->row();
		return $query;
	}

	public function obtenerDatos($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('empresas')->row();
		return $query;
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
		$this->db->update('empresas', $estado);
	}
	
	public function agregarEmpresa($data) {
		$this->db->where('nombre', $data['inpNombreEmpresa']);
		$query = $this->db->get('empresas');
		if($query->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre de la empresa ya se encuentra registrado</li>');
		}
		$this->db->where('nombre', $data['inpNombre']);
		$aux = $this->db->get('Usuarios');
		if($aux->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre ya se encuentra registrado</li>');
		}
		else {
			$datosUsuario = array(
				"nombre" => $data['inpNombre'],
				"contraseña" => password_hash($data['inpContrasena'], PASSWORD_DEFAULT),
				"correo" => $data['inpCorreo'],
				"idperfil" => 2,
				"estatus" => 1
			);
			$this->db->insert('Usuarios', $datosUsuario);
		}
		$this->db->where('nombre', $data['inpNombre']);
		$query = $this->db->get('usuarios')->row();
		$datosEmpresa = array(
			'nombre' => $data['inpNombre'],
			'razonsocial' => $data['inpRazonSocial'],
			'rfc' => $data['inpRFC'],
			'domicilio' => $data['inpDomicilio'],
			'telefono' => $data['inpTelefono'],
			'local' => $data['inpLocal'],
			'estatus' => 1,
			'id_usuario' => $query->id
		);
		$this->db->insert('empresas', $datosEmpresa);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo la empresa en la base de datos, intente de nuevo</li>');
			}
	}

	public function modificarEmpresa() {
		//TBA
		return;
	}

}