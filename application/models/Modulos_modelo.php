<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulos_modelo extends CI_Model{
	
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

	public function agregarModulo($data) {
		$this->db->where('nombre', $data['inpNombre']);
		$aux = $this->db->get('modulos');
		if($aux->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre ya se encuentra registrado</li>');
		}
		else {
			$datos = array(
				"nombre" => $data['inpNombre'],
				"descripcion" => $data['inpDescripcion'],
				"ruta" => "index.php/".$data['inpNombre'],
				"icono" => $data['inpIcono'],
				"estatus" => 1
			);
			$this->db->insert('modulos', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo el modulo en la base de datos, intente de nuevo</li>');
			}
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
        $registro = $this->db->get('modulos')->row();
        if($registro->estatus == $estatus){
            return array('exito' => false,'msg' => 'El dato no se actualizó porque el cambio ya se habia realizado');
        }
        //Actualizar
		$estado = array('estatus' => $estatus);
		$this->db->where('id', $id);
		$this->db->update('modulos', $estado);
        if($this->db->affected_rows() > 0){
            return array('exito' => true,'msg' => '');
        }
        else{
             return array('exito' => false,'msg' => 'No se modificó el estatus del perfil seleccionado');
        }
	}
	
	public function modificarmodulo($data) {
		if($data['inpNombre'] == $data['oldNombre'] && $data['inpDescripcion'] == $data['oldDescripcion'] ) {
			return array('exito' => false, 'msg' =>'No se actualizaron los datos porque no hubo cambios');
		}
		if($data['inpNombre'] != $data['oldNombre']) {
			$this->db->where('nombre', $data['inpNombre']);
			$query = $this->db->get('modulos');
			if($query->num_rows() > 0) {
				$query = $query->row();
				if($query->nombre === $data['inpNombre']) {
					return array('exito' => false, 'msg' => 'El nombre insertado ya se encuentra utilizado');
				}	
			}
				$datos = array(
					'nombre' => $data['inpNombre'],
					'descripcion' => $data['inpDescripcion'],
					'icono' => $data['inpIcono']
				);
				$this->db->where('id', $data['id']);
				$this->db->update('modulos', $datos);
				if($this->db->affected_rows() > 0) {
					return array('exito' => true, 'msg' => '');
				}
				else {
					return array('exito' => false, 'msg' => 'No se actualizo la base de datos');
				}
		}
	}
	
	public function obtenerDatos($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('modulos')->row();
		//echo $this->db->last_query();
		return $query;
	}
	public function modulosXPerfil($idPerfil){
        $query = $this->db->query("SELECT * , (SELECT 'si' FROM perfilesmodulos WHERE perfilesmodulos.`idmodulo` = modulos.id AND perfilesmodulos.`idperfil` = $idPerfil) tiene FROM modulos;");
        return $query->result();
    }

    public function validarPerfil($idPerfil,$ruta){
    	$this->db->join('modulos', 'modulos.id = perfilesmodulos.idmodulo');
        $this->db->where('perfilesmodulos.idperfil', $idPerfil);
        $this->db->where('modulos.ruta', $ruta);
		$query = $this->db->get('perfilesmodulos');
		if ($query->num_rows() > 0) {
		  	return true;
		}
		else{
		  	return false;
		 }
    }
    public function obtenerModulosXPerfil($id){
        $this->db->select('*');
        $this->db->join('modulos', 'modulos.id = perfilesmodulos.idmodulo');
        $this->db->where('perfilesmodulos.idperfil',$id);
        $this->db->where('modulos.estatus',1);
        $this->db->order_by("modulos.nombre asc");
        return $this->db->get('perfilesmodulos')->result();
        
    }
	
}