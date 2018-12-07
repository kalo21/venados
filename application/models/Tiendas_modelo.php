<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiendas_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function infoEmpresas() {

        $fecha = date('Y-m-d H:i:s');
        $this->db->select('eventos.id');
        $this->db->where('eventos.fecha_inicial <=', $fecha);
        $this->db->where('eventos.fecha_fin >=', $fecha);
        $empresas = $this->db->get('eventos')->row();

        $this->db->select('empresas.id, empresas.nombre, empresas.descripcion, empresas.img_fondo');
        $this->db->from('empresas');
        $this->db->join('detallesevento', 'detallesevento.id_empresa = empresas.id');
        $this->db->where('detallesevento.id_evento', $empresas->id);
        $this->db->where('empresas.estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtenerProductos($id) {
        $this->db->select('productos.id, productos.nombre, productos.descripcion, productos.precio, productos.imagen');
        $this->db->where('idempresa', $id);
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

    public function nombreEmpresa($id) {
        $this->db->select('empresas.nombre');
        $this->db->where('id', $id);
        $nombreEmpresa = $this->db->get('empresas')->row();
        return $nombreEmpresa;
    }

}
	