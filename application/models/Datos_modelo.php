<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datos_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }
    
    public function obtenerDatos($id) {
        if($this->session->idPerfil == 5){
        $this->db->select('vendedores.imagen,clientes.nombre,CONCAT(clientes.apellidopaterno," ",clientes.apellidomaterno) as apellido,clientes.saldo,clientes.id,clientes.telefono,usuarios.correo');
        $this->db->from('clientes');
        $this->db->join('usuarios','clientes.id_usuario = usuarios.id');
        $this->db->join('vendedores','clientes.id_usuario = vendedores.id_usuario');
        }
        else if($this->session->idPerfil == 2){
            $this->db->select('empresas.logotipo as imagen,clientes.nombre,CONCAT(clientes.apellidopaterno," ",clientes.apellidomaterno) as apellido,clientes.saldo,clientes.id,clientes.telefono,usuarios.correo, empresas.disponibilidad');
            $this->db->from('clientes');
            $this->db->join('usuarios','clientes.id_usuario = usuarios.id');
            $this->db->join('empresas','clientes.id_usuario = empresas.id_usuario');
        }
        else{
            $this->db->select('clientes.nombre,CONCAT(clientes.apellidopaterno," ",clientes.apellidomaterno) as apellido,clientes.saldo,clientes.id,clientes.telefono,usuarios.correo');
            $this->db->from('clientes');
            $this->db->join('usuarios','clientes.id_usuario = usuarios.id');
        }
		$this->db->where('usuarios.id', $id);
		$query = $this->db->get()->row();
		return $query;
    }
    
    public function cambiarDisponibilidad($disponibilidad) {
        if($disponibilidad == 'Abierto') {
            $disp = 'Cerrado';
        }
        else {
            $disp = 'Abierto';
        }
        $data = array('disponibilidad' => $disp);
        $this->db->where('id', $this->session->idEmpresa);
        $this->db->update('empresas', $data);
    }
}