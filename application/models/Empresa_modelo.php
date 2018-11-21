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
        $query->descripcion =  str_replace('-',',', $query->descripcion);
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
	
	public function agregarEmpresa($data, $nombreArchivo,$nombreArchivoV) {
		$this->db->where('nombre', $data['inpNombreE']);
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
			'nombre' => $data['inpNombreE'],
			'razonsocial' => $data['inpRazonSocial'],
            'descripcion' => str_replace(',','-',$data['inpDescripcion']),
			'rfc' => $data['inpRFC'],
			'domicilio' => $data['inpDomicilio'],
			'telefono' => $data['inpTelefono'],
			'local' => $data['inpLocal'],
			'estatus' => 1,
			'id_usuario' => $query->id
		);
		$this->db->insert('empresas', $datosEmpresa);
        $idRegistrado = $this->db->insert_id();
			if($this->db->affected_rows() > 0) {
				$imagenEmpresa = array("logotipo" => 'assets/Empresas/'.$idRegistrado.'/'.$nombreArchivo,
				"img_fondo" => 'assets/Empresas/'.$idRegistrado.'/'.$nombreArchivoV);
                $this->db->where('id', $idRegistrado);
                $this->db->update('empresas', $imagenEmpresa);
				return array('exito' => true, 'msg' => $idRegistrado);
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo la empresa en la base de datos, intente de nuevo</li>');
			}
	}

	public function modificarEmpresa($data,$nombreArchivo,$nombreArchivoV){
		$this->db->select('empresas.logotipo,empresas.img_fondo');
        $this->db->where('id', $data['id']);
		$Archivo = $this->db->get('empresas')->row();

		if($data['cambio'] == 0 && $data['cambioV'] == 0 && $data['inpNombreE'] == $data['oldNombre'] && $data['inpDescripcion'] == $data['oldDescripcion'] && $data['inpRazonSocial'] == $data['oldRazonSocial'] && $data['inpRFC'] == $data['oldRFC'] && $data['inpDomicilio'] == $data['oldDomicilio'] && $data['inpTelefono'] == $data['oldTelefono'] && $data['inpLocal'] == $data['oldLocal']) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombreE'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombreE']);
			$query = $this->db->get('empresas');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombreE']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
			else {
				$datos = array(
					'nombre' => $data['inpNombreE'],
					'descripcion' => str_replace(',','-',$data['inpDescripcion']),
					'razonsocial' => $data['inpRazonSocial'],
                    'rfc' => $data['inpRFC'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono'],
                    'local' => $data['inpLocal'],
					'logotipo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo,
					'img_fondo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivoV

				);
                unlink($Archivo->logotipo);
                unlink($Archivo->img_fondo);
			}
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		if($data['cambio'] > 0 && $data['cambioV'] > 0){
			$datos = array(
				'descripcion' => str_replace(',','-',$data['inpDescripcion']),
				'razonsocial' => $data['inpRazonSocial'],
				'rfc' => $data['inpRFC'],
				'domicilio' => $data['inpDomicilio'],
				'telefono' => $data['inpTelefono'],
				'local' => $data['inpLocal'],
				'logotipo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo,
				'img_fondo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivoV
			);
			unlink($Archivo->logotipo);
			unlink($Archivo->img_fondo);
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		if($data['cambio'] > 0){
			$datos = array(
				'descripcion' => str_replace(',','-',$data['inpDescripcion']),
				'razonsocial' => $data['inpRazonSocial'],
				'rfc' => $data['inpRFC'],
				'domicilio' => $data['inpDomicilio'],
				'telefono' => $data['inpTelefono'],
				'local' => $data['inpLocal'],
				'logotipo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo
			);
			unlink($Archivo->logotipo);
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		if($data['cambioV'] > 0){
			$datos = array(
				'descripcion' => str_replace(',','-',$data['inpDescripcion']),
				'razonsocial' => $data['inpRazonSocial'],
				'rfc' => $data['inpRFC'],
				'domicilio' => $data['inpDomicilio'],
				'telefono' => $data['inpTelefono'],
				'local' => $data['inpLocal'],
				'img_fondo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivoV
			);
			unlink($Archivo->img_fondo);
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
	}

	public function modificarEmpresaLogo($data,$nombreArchivo){
		$this->db->select('empresas.logotipo');
        $this->db->where('id', $data['id']);
		$Archivo = $this->db->get('empresas')->row();

		if($data['cambio'] == 0 && $data['cambioV'] == 0 && $data['inpNombreE'] == $data['oldNombre'] && $data['inpDescripcion'] == $data['oldDescripcion'] && $data['inpRazonSocial'] == $data['oldRazonSocial'] && $data['inpRFC'] == $data['oldRFC'] && $data['inpDomicilio'] == $data['oldDomicilio'] && $data['inpTelefono'] == $data['oldTelefono'] && $data['inpLocal'] == $data['oldLocal']) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombreE'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombreE']);
			$query = $this->db->get('empresas');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombreE']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
			else {
				$datos = array(
					'nombre' => $data['inpNombreE'],
					'descripcion' => str_replace(',','-',$data['inpDescripcion']),
					'razonsocial' => $data['inpRazonSocial'],
                    'rfc' => $data['inpRFC'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono'],
                    'local' => $data['inpLocal'],
					'logotipo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo
				);
                unlink($Archivo->logotipo);
			}
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		if($data['cambio'] > 0){
			$datos = array(
				'descripcion' => str_replace(',','-',$data['inpDescripcion']),
				'razonsocial' => $data['inpRazonSocial'],
				'rfc' => $data['inpRFC'],
				'domicilio' => $data['inpDomicilio'],
				'telefono' => $data['inpTelefono'],
				'local' => $data['inpLocal'],
				'logotipo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo
			);
			unlink($Archivo->logotipo);
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
	}

	public function modificarEmpresaFondo($data,$nombreArchivo){
		$this->db->select('empresas.img_fondo');
        $this->db->where('id', $data['id']);
		$Archivo = $this->db->get('empresas')->row();

		if($data['cambio'] == 0 && $data['cambioV'] == 0 && $data['inpNombreE'] == $data['oldNombre'] && $data['inpDescripcion'] == $data['oldDescripcion'] && $data['inpRazonSocial'] == $data['oldRazonSocial'] && $data['inpRFC'] == $data['oldRFC'] && $data['inpDomicilio'] == $data['oldDomicilio'] && $data['inpTelefono'] == $data['oldTelefono'] && $data['inpLocal'] == $data['oldLocal']) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombreE'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombreE']);
			$query = $this->db->get('empresas');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombreE']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
			else {
				$datos = array(
					'nombre' => $data['inpNombreE'],
					'descripcion' => str_replace(',','-',$data['inpDescripcion']),
					'razonsocial' => $data['inpRazonSocial'],
                    'rfc' => $data['inpRFC'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono'],
                    'local' => $data['inpLocal'],
					'img_fondo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo
				);
                unlink($Archivo->img_fondo);
			}
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
		if($data['cambioV'] > 0){
			$datos = array(
				'descripcion' => str_replace(',','-',$data['inpDescripcion']),
				'razonsocial' => $data['inpRazonSocial'],
				'rfc' => $data['inpRFC'],
				'domicilio' => $data['inpDomicilio'],
				'telefono' => $data['inpTelefono'],
				'local' => $data['inpLocal'],
				'img_fondo' => 'assets/Empresas/'.$data['id'].'/'.$nombreArchivo
			);
			unlink($Archivo->img_fondo);
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
	}

	public function modificarEmpresaTexto($data){
		if($data['cambio'] == 0 && $data['cambioV'] == 0 && $data['inpNombreE'] == $data['oldNombre'] && $data['inpDescripcion'] == $data['oldDescripcion'] && $data['inpRazonSocial'] == $data['oldRazonSocial'] && $data['inpRFC'] == $data['oldRFC'] && $data['inpDomicilio'] == $data['oldDomicilio'] && $data['inpTelefono'] == $data['oldTelefono'] && $data['inpLocal'] == $data['oldLocal']) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombreE'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombreE']);
			$query = $this->db->get('empresas');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombreE']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
			else {
				$datos = array(
					'nombre' => $data['inpNombreE'],
					'descripcion' => str_replace(',','-',$data['inpDescripcion']),
					'razonsocial' => $data['inpRazonSocial'],
                    'rfc' => $data['inpRFC'],
                    'domicilio' => $data['inpDomicilio'],
                    'telefono' => $data['inpTelefono'],
                    'local' => $data['inpLocal']
				);
			}
			$this->db->where('id', $data['id']);
			$this->db->update('empresas', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
			}
		}
	}
}