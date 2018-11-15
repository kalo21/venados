<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Vendedores_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Vendedores");
    		$this->load->view('Vendedores/vendedores_vista',$data);
        }
    }
	public function obtenervendedores($estatus) {
		echo json_encode($this->Vendedores_modelo->obtenerVendedores($estatus));
	}
	public function cambiarEstado() {
		$this->Vendedores_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
	}

	public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Vendedores/vendedores_modal');
		}
		else {
			$data['datos'] = $this->Vendedores_modelo->obtenerDatos($id);
			$data['usuario'] = $this->Vendedores_modelo->obtenerUsuario($data['datos']->id_usuario);
			$this->load->view('Vendedores/vendedores_modal',$data);
		}
	}

	public function agregarVendedores() {
        mkdir('./assets/Vendedores/abc', 0777,true);
        $config = [
            "upload_path" => "./assets/Vendedores/",
            'allowed_types' => "png|jpg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de vendedor', 'required|is_unique[vendedores.nombre]');
        $this->form_validation->set_rules('inpMaterno', 'Apellido materno', 'required');
		$this->form_validation->set_rules('inpPaterno', 'Apellido paterno', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de vendedor', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono del vendedor', 'numeric');
		$this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpContrasena', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inpVerificar', 'Verificiar contraseña', 'trim|required|matches[inpContrasena]');
		$this->form_validation->set_rules('inpCorreo', 'Correo', 'trim|required|valid_email|is_unique[usuarios.correo]');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                $id = $this->Vendedores_modelo->agregarVendedores($this->input->post(), $nombreArchivop);
                if($id['exito']) {
                    rename('./assets/Vendedores/abc','./assets/Vendedores/'.$id['msg']);
                    rename('./assets/Vendedores/'.$nombreArchivop, './assets/Vendedores/'.$id['msg'].'/'.$nombreArchivop);
                }
                else {
                    rmdir('./assets/Vendedores/abc');
                    unlink('./assets/Vendedores/'.$nombreArchivop);
                }
                echo json_encode($id);
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                rmdir('./assets/Vendedores/abc');
                unlink('./assets/Vendedores/'.$nombreArchivop);
            }
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
            rmdir('./assets/Vendedores/abc');
        }
        
	}

	public function modificarVendedores() {
        $config = [
            "upload_path" => "./assets/Vendedores/".$this->input->post('id'),
            'allowed_types' => "png|jpg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre del vendedor', 'required');
        $this->form_validation->set_rules('inpMaterno', 'Apellido materno', 'required');
		$this->form_validation->set_rules('inpPaterno', 'Apellido paterno', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio del vendedor', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono del vendedor', 'numeric');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                echo json_encode($this->Vendedores_modelo->modificarVendedores($this->input->post(), $nombreArchivop));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
        else {
            if($this->input->post('cambio') == 0) {
                if ($this->form_validation->run() === TRUE) {
                    echo json_encode($this->Vendedores_modelo->modificarVendedores($this->input->post()));
                }
                else {
                    echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                }   
            }
        }
	}
}