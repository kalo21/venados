<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldos extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Saldos_modelo');
        $this->load->helper(array('funciones_generales_helper','url'));
        $this->load->library('Pdf');

    }

    public function index(){
    	if(validacion()) {
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Saldos");
            $data['empresas'] = $this->Saldos_modelo->obtenerEmpresas();
            $data['vendedores'] = $this->Saldos_modelo->obtenerVendedores();
            $data['clientesCompras']= $this->Saldos_modelo->obtenerClientesC();
            $data['clientesRecargas']= $this->Saldos_modelo->obtenerClientesR();
    		$this->load->view('Saldos/saldos_vista',$data);
        }
    }

    public function buscarEmpresa() {
        echo json_encode($this->Saldos_modelo->buscarEmpresa($this->input->post()));
    }

    public function buscarVendedor() {
        echo json_encode($this->Saldos_modelo->buscarVendedor($this->input->post()));
    }

    public function buscarCliente() {
        $data['movimientos'] = $this->Saldos_modelo->buscarCliente($this->input->post());
        $data['saldo'] = $this->Saldos_modelo->obtenerTotalRecargas($this->input->post()); 
        $data['pedidos'] = $this->Saldos_modelo->obtenerTotalPedidos($this->input->post());
        echo json_encode($data);
    }

    public function buscarClienteCompra(){
        echo json_encode($this->Saldos_modelo->buscarClienteCompra($this->input->post()));
    }

    public function buscarClienteRecarga(){
        echo json_encode($this->Saldos_modelo->buscarClienteRecarga($this->input->post()));
    }


    /**
     * Genera el documento pdf para el reporte
     * @param id = es el id de lo que se desea buscar
     * @param fechaInicio = es la fecha de inicio para la consulta del reporte
     * @param fechaFinal = es la fecha de fin para la consulta del reporte
     * @param tipo = es el tipo de reporte: {1: Reporte de empresas, 2: Reporte para vendedores, 3: Reporte para compras de los clientes, 4: Reportes para las recargas de los clientes}
     */
    public function imprimir($id, $fechaInicio, $fechaFinal, $tipo){
        if ($tipo == 1) { //Reporte de empresas
            $input = array(
                idEmpresa => $id,
                fechaInicio => $fechaInicio,
                fechaFinal => $fechaFinal
            );
            $data['nombre']= $this->Saldos_modelo->nombreEmpresa($id);
            $data['total'] = 0.0;
            $data['datos'] = $input;
            $data['registros'] = $this->Saldos_modelo->buscarEmpresa($input);
            $contenido = $this->load->view('Formatos/reporteEmpresas',$data, true);
            
        } else if($tipo == 2){ //Reporte para vendedores
            $input = array(
                idVendedor => $id,
                fechaInicio => $fechaInicio,
                fechaFinal => $fechaFinal
            );

            $data['nombre']= $this->Saldos_modelo->nombreVendedor($id);
            $data['total'] = 0.0;
            $data['datos'] = $input;
            $data['registros'] = $this->Saldos_modelo->buscarVendedor($input);
           $contenido = $this->load->view('Formatos/reporteVendedores',$data, true);

        }else if ($tipo == 3) { //Reporte para compras de los clientes
            $input = array(
                idUsuario => $id,
                fechaInicio => $fechaInicio,
                fechaFinal => $fechaFinal
            );

            $data['nombre']= $this->Saldos_modelo->nombreUsuarioCompra($id);
            $data['total'] = 0.0;
            $data['datos'] = $input;
            $data['registros'] = $this->Saldos_modelo->buscarClienteCompra($input);
           $contenido = $this->load->view('Formatos/reporteClienteCompras',$data, true);

        }else { //Reportes para las recargas de los clientes
            $input = array(
                idCliente => $id,
                fechaInicio => $fechaInicio,
                fechaFinal => $fechaFinal
            );

            $data['nombre']= $this->Saldos_modelo->nombreUsuarioRecarga($id);
            $data['total'] = 0.0;
            $data['datos'] = $input;
            $data['registros'] = $this->Saldos_modelo->buscarClienteRecarga($input);
           $contenido = $this->load->view('Formatos/reporteClienteRecarga',$data, true);
        }

        GenerarPDFLogo($contenido, "i", $id."-".$fechaInicio."-".$fechaFinal);
        
        
    }
    

}