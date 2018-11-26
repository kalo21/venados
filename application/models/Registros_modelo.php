<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registros_modelo extends CI_Model{
	
	public function __construct(){
        parent::__construct();
    }

    public function obtenerTotalEmpresas($fechas) {
        $this->db->select('empresas.id, empresas.nombre');
        $this->db->where('empresas.estatus', 1);
        $empresas = $this->db->get('empresas');
        $total = 0;
        foreach($empresas->result() as $empresa) {
            $this->db->select('pedidos.total');
            $this->db->where('pedidos.idempresa', $empresa->id);
            $this->db->where('pedidos.fecha >=', $fechas['fechaInicio']);
            $this->db->where('pedidos.fecha <=', $fechas['fechaFinal']);
            $this->db->where('pedidos.estatus !=', 'Cancelado');
            $this->db->where('pedidos.estatus !=', 'Eliminado');
            $aux = $this->db->get('pedidos');
            foreach($aux->result() as $monto) {
                $total += $monto->total;
            }
            $data[] = array(
                'id'       => $empresa->id,
                'nombre'   => $empresa->nombre,
                'total'    => $total
            );
            $total = 0;
        }
        return $data;
    }

    public function obtenerTotalVendedores($fechas) {
        $this->db->select('vendedores.id, vendedores.nombre, vendedores.apellidopaterno, vendedores.apellidomaterno');
        $this->db->where('vendedores.estatus', 1);
        $vendedores = $this->db->get('vendedores');
        $total = 0;
        foreach($vendedores->result() as $vendedor) {
            $this->db->select('recargas.monto');
            $this->db->where('recargas.id_vendedor', $vendedor->id);
            $this->db->where('date(recargas.fecha) >=', $fechas['fechaInicio']);
            $this->db->where('date(recargas.fecha) <=', $fechas['fechaFinal']);
            $aux = $this->db->get('recargas');
            foreach($aux->result() as $monto) {
                $total += $monto->monto;
            }
            $data[] = array(
                'id'       => $vendedor->id,
                'nombre'   => $vendedor->nombre.' '.$vendedor->apellidopaterno.' '.$vendedor->apellidomaterno,
                'total'    => $total
            );
            $total = 0;
        }
        return $data;
    }
}