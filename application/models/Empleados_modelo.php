<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleados_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
	}
	public function obtenerEmpleados($estatus) {
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
		} 
		$query = $this->db->get('empleados');
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
		$query = $this->db->get('empleados')->row();
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
		$this->db->update('empleados', $estado);
	}
	
	public function agregarEmpleados($data, $nombreArchivo) {
		$this->db->where('nombre', $data['inpNombreE']);
		$query = $this->db->get('empleados');
		if($query->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre del empleado ya se encuentra registrado</li>');
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
				"idperfil" => 5,
				"estatus" => 1
			);
			$this->db->insert('Usuarios', $datosUsuario);
		}
		$this->db->where('nombre', $data['inpNombre']);
		$query = $this->db->get('usuarios')->row();
		$datosEmpleados = array(
			'nombre' => $data['inpNombreE'],
			'apellidomaterno' => $data['inpMaterno'],
            'apellidopaterno' => $data['inpPaterno'],
			'domicilio' => $data['inpDomicilio'],
			'telefono' => $data['inpTelefono'],
			'estatus' => 1,
			'id_usuario' => $query->id
		);
		$this->db->insert('empleados', $datosEmpleados);
        $idRegistrado = $this->db->insert_id();
			if($this->db->affected_rows() > 0) {
                $imagenEmpleados = array("imagen" => 'assets/Empleados/'.$idRegistrado.'/'.$nombreArchivo);
                $this->db->where('id', $idRegistrado);
                $this->db->update('empleados', $imagenEmpleados);
				return array('exito' => true, 'msg' => $idRegistrado);
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo el empleado en la base de datos, intente de nuevo</li>');
			}
	}

	public function modificarEmpleados($data, $nombreArchivo = '') {
        $this->db->select('empleados.imagen');
        $this->db->where('id', $data['id']);
        $nombreArchivop = $this->db->get('empleados')->row();
		if($data['cambio'] == 0 && $data['inpNombreE'] == $data['oldNombre'] && $data['inpMaterno'] == $data['oldMaterno'] && $data['inpPaterno'] == $data['oldPaterno'] && $data['inpDomicilio'] == $data['oldDomicilio'] && $data['inpTelefono'] == $data['oldTelefono']) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombreE'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombreE']);
			$query = $this->db->get('empleados');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombreE']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
			if($data['cambio'] != 0) {
				$datos = array(
					'nombre' => $data['inpNombreE'],
                    'apellidomaterno' => $data['inpMaterno'],
                    'apellidopaterno' => $data['inpPaterno'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono'],
					'imagen' => 'assets/Empleados/'.$data['id'].'/'.$nombreArchivo
				);
                unlink($nombreArchivop->imagen);
			}
			else {
				$datos = array(
					'nombre' => $data['inpNombreE'],
                    'apellidomaterno' => $data['inpMaterno'],
                    'apellidopaterno' => $data['inpPaterno'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono']
				);
			}
			$this->db->where('id', $data['id']);
			$this->db->update('empleados', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		else if($data['cambio'] != 0 || $data['inpMaterno'] != $data['oldMaterno'] || $data['inpPaterno'] != $data['oldPaterno'] || $data['inpDomicilio'] != $data['oldDomicilio'] || $data['inpTelefono'] != $data['oldTelefono']) {
			if($data['cambio'] != 0) {
				$datos = array(
                    'apellidomaterno' => $data['inpMaterno'],
                    'apellidopaterno' => $data['inpPaterno'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono'],
					'imagen' => 'assets/Empleados/'.$data['id'].'/'.$nombreArchivo
				);
                unlink($nombreArchivop->imagen);
			}
			else {
				$datos = array(
				    'apellidomaterno' => $data['inpMaterno'],
                    'apellidopaterno' => $data['inpPaterno'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono']
				);
			}
			$this->db->where('id', $data['id']);
			$this->db->update('empleados', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
		}
	}
}