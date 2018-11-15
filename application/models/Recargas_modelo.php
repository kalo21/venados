<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recargas_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
	}
    public function agregarRecargas($data) {
        $this->db->where('nombre',$data['inpUsuario']);
        $query = $this->db->get('usuarios')->row();
        if($query != null) {
            $datos = array("monto" => $data['inpMonto'],"id_usuario" => $query->id, "id_empleado" => $this->session->idUsuario);
            $this->db->insert('recargas', $datos);
            if($this->db->affected_rows() > 0) {
                return array('exito' => true, 'msg' => '');
            }
            else {
                return array('exito' => false, 'msg' => '<li>No se guardo el modulo en la base de datos, intente de nuevo</li>');
            }
        }
        else {
            return array('exito' => false, 'msg' => '<li>No se encuentra registrado ese usuario</li>');
        }
	}
    
    	public function obtenerRecargas() {
        
        $this->db->select('usuarios.nombre, empleados.nombre as nombreVendedor, recargas.id, recargas.monto');    
        $this->db->from('recargas');    
        $this->db->join('usuarios', 'recargas.id_usuario = usuarios.id');    
        $this->db->join('empleados', 'recargas.id_empleado = empleados.id_usuario');    
        $this->db->where('recargas.id_empleado', $this->session->idUsuario);    
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
}