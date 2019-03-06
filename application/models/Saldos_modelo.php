<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saldos_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function obtenerEmpresas() {
        $this->db->select('empresas.id, empresas.nombre');
        $query = $this->db->get('empresas');
        return $query->result();
    }
    
    public function obtenerVendedores() {
        $this->db->select('vendedores.id, CONCAT(vendedores.nombre, " ",vendedores.apellidopaterno, " ", vendedores.apellidomaterno) as nombre');
        $query = $this->db->get('vendedores');
        return $query->result();
    }

    public function obtenerClientesC(){
        $this->db->select('usuarios.id, CONCAT(clientes.nombre, " " , clientes.apellidopaterno, " ", clientes.apellidomaterno) as nombre');
        $this->db->join('usuarios', 'usuarios.id = clientes.id_usuario');
        $query = $this->db->get('clientes');
        return $query->result();
    }

    public function obtenerClientesR(){
        $this->db->select('clientes.id, CONCAT(clientes.nombre, " " , clientes.apellidopaterno, " ", clientes.apellidomaterno) as nombre');
        //$this->db->join('usuarios', 'usuarios.id = clientes.id_usuario');
        $query = $this->db->get('clientes');
        return $query->result();
    }

    public function buscarEmpresa($data) {
        if ($data['idEmpresa'] == 0) {
            $this->db->select('pedidos.id, empresas.nombre, pedidos.fecha, CONCAT(clientes.nombre, " ",clientes.apellidopaterno, " ", clientes.apellidomaterno) as cliente, pedidos.total');
            $this->db->from('pedidos');
            $this->db->join('clientes', 'clientes.id_usuario = pedidos.idusuario');
            $this->db->join('empresas', 'empresas.id = pedidos.idempresa');
            $this->db->order_by("empresas.nombre", "asc");
            $this->db->where('pedidos.fecha >=', $data['fechaInicio']);
            $this->db->where('pedidos.fecha <=', $data['fechaFinal']);
            $this->db->where('pedidos.estatus !=', 'Cancelado');
            $this->db->where('pedidos.estatus !=', 'Eliminado');
        }else {
            $this->db->select('pedidos.id, empresas.nombre, pedidos.fecha, CONCAT(clientes.nombre, " ",clientes.apellidopaterno, " ", clientes.apellidomaterno) as cliente, pedidos.total');
            $this->db->from('pedidos');
            $this->db->join('clientes', 'clientes.id_usuario = pedidos.idusuario');
            $this->db->join('empresas', 'empresas.id = pedidos.idempresa');
            $this->db->where('pedidos.idempresa', $data['idEmpresa']);
            $this->db->where('pedidos.fecha >=', $data['fechaInicio']);
            $this->db->where('pedidos.fecha <=', $data['fechaFinal']);
            $this->db->where('pedidos.estatus !=', 'Cancelado');
            $this->db->where('pedidos.estatus !=', 'Eliminado');
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarVendedor($data) {
        $this->db->select('recargas.id, recargas.fecha, CONCAT(clientes.nombre, " ",clientes.apellidopaterno, " ", clientes.apellidomaterno) as cliente, recargas.monto');
        $this->db->from('recargas');
        $this->db->join('clientes', 'clientes.id = recargas.id_cliente');
        $this->db->where('recargas.id_empleado', $data['idVendedor']);
        $this->db->where('recargas.fecha >=', $data['fechaInicio']);
        $this->db->where('recargas.fecha <=', $data['fechaFinal']);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarClienteCompra($data){
        $this->db->select('pedidos.id, pedidos.fecha, empresas.nombre, pedidos.total, pedidos.estatus');
        $this->db->from('pedidos');
        $this->db->join('empresas', 'empresas.id = pedidos.idempresa');
        $this->db->where('pedidos.estatus != "Solicitado"');
        $this->db->where('pedidos.estatus != "Cancelado"');
        $this->db->where('pedidos.estatus != "Eliminado"');
        $this->db->where('pedidos.idusuario', $data['idUsuario']);
        $this->db->where('pedidos.fecha >=', $data['fechaInicio']);
        $this->db->where('pedidos.fecha <=', $data['fechaFinal']);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarClienteRecarga($data){
        $this->db->select('recargas.id, recargas.fecha, CONCAT(vendedores.nombre, " " , vendedores.apellidopaterno) as nombre, recargas.monto');
        $this->db->from('recargas');
        $this->db->join('vendedores', 'vendedores.id = recargas.id_empleado');
        $this->db->where('recargas.id_cliente', $data['idCliente']);
        $this->db->where('recargas.fecha >=', $data['fechaInicio']);
        $this->db->where('recargas.fecha <=', $data['fechaFinal']);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarCliente($data) {
        $this->db->select('clientes.id_usuario');
        $this->db->where('clientes.id', $data['idCliente']);
        $idUsuario = $this->db->get('clientes')->row();
        
        $query = $this->db->query(
            'SELECT pedidos.id, pedidos.fecha, " " AS recarga, pedidos.total AS pedido
            FROM clientes
            INNER JOIN pedidos ON pedidos.`idusuario` = clientes.`id_usuario`
            WHERE pedidos.idusuario = "'.$idUsuario->id_usuario.'"
            AND pedidos.fecha >= "'.$data['fechaInicio'].'" 
            AND pedidos.fecha <= "'.$data['fechaFinal'].'" 
            AND pedidos.estatus != "Cancelado"
            AND pedidos.estatus != "Eliminado"
            UNION
            SELECT recargas.id, recargas.fecha, recargas.monto, " " AS total
            FROM clientes
            INNER JOIN recargas ON recargas.id_cliente = clientes.`id`
            WHERE recargas.id_cliente = "'.$data['idCliente'].'"
            AND recargas.fecha >= "'.$data['fechaInicio'].'" 
            AND recargas.fecha <= "'.$data['fechaFinal'].'" 
            ORDER BY fecha ASC'
        );
        return $query->result();
    }
    
    public function obtenerTotalRecargas($data) {
        $this->db->select_sum('recargas.monto');
        $this->db->where('recargas.id_cliente', $data['idCliente']);
        $this->db->where('recargas.fecha <', $data['fechaInicio']);
        $query = $this->db->get('recargas')->row();
        return $query;
    }
    
    public function obtenerTotalPedidos($data) {
        $this->db->select('clientes.id_usuario');
        $this->db->where('clientes.id', $data['idCliente']);
        $idUsuario = $this->db->get('clientes')->row();

        $this->db->select_sum('pedidos.total');
        $this->db->where('pedidos.idusuario', $idUsuario->id_usuario);
        $this->db->where('pedidos.fecha <', $data['fechaInicio']);
        $this->db->where('pedidos.estatus !=', 'Cancelado');
        $this->db->where('pedidos.estatus !=', 'Eliminado');
        $query = $this->db->get('pedidos')->row();
        return $query;
    }
    

    public function nombreEmpresa($id){
        $this->db->select('empresas.nombre as nombre');
        $this->db->where('empresas.id', $id);
        $query = $this->db->get('empresas');
        return $query->result();
    }

    public function nombreVendedor($id){
        $this->db->select('CONCAT(vendedores.nombre, " " , vendedores.apellidopaterno , " " , vendedores.apellidomaterno) as nombre');
        $this->db->where('vendedores.id', $id);
        $query = $this->db->get('vendedores');
        return $query->result();
    }

    public function nombreUsuarioCompra($id){ //este es con el id del usuario
        $this->db->select('CONCAT(clientes.nombre, " " , clientes.apellidopaterno, " ", clientes.apellidomaterno) as nombre');
        $this->db->where('clientes.id_usuario', $id);
        $query = $this->db->get('clientes');
        return $query->result();
    }
    
    public function nombreUsuarioRecarga($id){ //este es con el id del cliente
        $this->db->select('CONCAT(clientes.nombre, " " , clientes.apellidopaterno , " " , clientes.apellidomaterno) as nombre');
        $this->db->where('clientes.id', $id);
        $query = $this->db->get('clientes');
        return $query->result();
    }

    
}