<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos_modelo extends CI_Model {

    public function __construct(){
        parent::__construct();
	}
	public function obtenerProductos($estatus) {
		
		if($estatus == 1 || $estatus == 0) {
			$this->db->where('estatus', $estatus);
		}
		$query = $this->db->get('productos');
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
		$estado = array('estatus' => $estatus);
		$this->db->where('id', $id);
		$this->db->update('productos', $estado);
	}
	public function agregarProducto($data) {
		$this->db->where('nombre', $data['inpNombre']);

		$aux = $this->db->get('productos');
		if($aux->num_rows() > 0) {
			return array('exito' => false, 'msg' => '<li>El nombre ya se encuentra registrado</li>');
		}
		else {
			$datos = array(
				"nombre" => $data['inpNombre'],
				"descripcion" => $data['inpDescripcion'],
				"precio" => $data['inpPrecio'],
				//"imagen" => $data['inpImagen'],
				"estatus" => 1,
				"idempresa" => 2
			);
			$this->db->insert('productos', $datos);
			if($this->db->affected_rows() > 0) {
				return array('exito' => true, 'msg' => '');
			}
			else {
				return array('exito' => false, 'msg' => '<li>No se guardo el producto en la base de datos, intente de nuevo</li>');
			}
		}
        
	}
	public function obtenerDatos($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('productos')->row();
		//echo $this->db->last_query();
		return $query;
	}
}