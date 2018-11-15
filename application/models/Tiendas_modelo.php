<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiendas_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function infoEmpresas() {
        $this->db->select('empresas.id, empresas.nombre, empresas.descripcion, empresas.img_fondo');
        $query = $this->db->get('empresas');
        return $query->result();
    }

    public function obtenerProductos($id) {
        $this->db->select('productos.id, productos.nombre, productos.descripcion, productos.precio, productos.imagen');
        $this->db   ->where('idempresa', $id);
        $this->db->where('estatus', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }

    public function infoProducto($id) {
        $this->db->select('productos.id, productos.nombre, productos.descripcion, productos.precio, productos.imagen');
        $this->db->where('id', $id);
        $query = $this->db->get('productos');
        return $query->result();
    }
}
	