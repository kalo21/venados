<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function obtenerNotificaciones() {
        $this->db->select('notificaciones.id, notificaciones.titulo, notificaciones.mensaje, date_format(`fecha`, "%d-%m-%Y %H:%i") AS `fecha`');
        $this->db->where('id_usuario', $this->session->idUsuario);
        $this->db->where('estatus', 1);
        $query = $this->db->get('notificaciones');
        return $query->result();
    }

    public function eliminarNotificacion($id) {
        $data = array('estatus' => 'Eliminado');
        $this->db->where('notificaciones.id', $id);
        $this->db->update('notificaciones', $data);
    }
}