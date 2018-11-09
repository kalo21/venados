<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Empresa_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Empresa");
    		$this->load->view('Empresa/empresa_vista',$data);
        }
    }
	public function obtenerEmpresa($estatus) {
		echo json_encode($this->Empresa_modelo->obtenerEmpresa($estatus));
	}
	public function cambiarEstado() {
		$this->Empresa_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
	}

	public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Empresa/empresa_modal');
		}
		else {
			$data['datos'] = $this->Empresa_modelo->obtenerDatos($id);
			$data['usuario'] = $this->Empresa_modelo->obtenerUsuario($data['datos']->id_usuario);
			$this->load->view('Empresa/empresa_modal',$data);
		}
	}

	public function agregarEmpresa() {
            mkdir('./assets/Empresas/abc', 0777,true);
        $config = [
            "upload_path" => "./assets/Empresas/",
            'allowed_types' => "png|jpg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de empresa', 'required|is_unique[empresas.nombre]');
		$this->form_validation->set_rules('inpRazonSocial', 'Razón social', 'required');
		$this->form_validation->set_rules('inpRFC', 'RFC', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empresa', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empresa', 'required');
		$this->form_validation->set_rules('inpLocal', 'Local', 'required');
		$this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpContrasena', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inpVerificar', 'Verificiar contraseña', 'trim|required|matches[inpContrasena]');
		$this->form_validation->set_rules('inpCorreo', 'Correo', 'trim|required|valid_email|is_unique[usuarios.correo]');
        if($this->upload->do_upload('foto')) {
            $this->load->library("upload",$config);
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                $id = $this->Empresa_modelo->agregarEmpresa($this->input->post(), $nombreArchivop);
                if($id['exito']) {
                    mkdir('./assets/Empresas/abc/Productos',0777,true);
                    rename('./assets/Empresas/abc','./assets/Empresas/'.$id['msg']);
                    rename('./assets/Empresas/'.$nombreArchivop, './assets/Empresas/'.$id['msg'].'/'.$nombreArchivop);
                }
                else {
                    rmdir('./assets/Empresas/abc');
                    unlink('./assets/Empresas/'.$nombreArchivop);
                }
                echo json_encode($id);
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                rmdir('./assets/Empresas/abc');
                unlink('./assets/Empresas/'.$nombreArchivop);
            }
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
            rmdir('./assets/Empresas/abc');
        }
        
	}

	public function modificarEmpresa() {
        $config = [
            "upload_path" => "./assets/Empresas/".$this->input->post('id'),
            'allowed_types' => "png|jpg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de empresa', 'required');
		$this->form_validation->set_rules('inpRazonSocial', 'Razón social', 'required');
		$this->form_validation->set_rules('inpRFC', 'RFC', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empresa', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empresa', 'required');
		$this->form_validation->set_rules('inpLocal', 'Local', 'required');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                echo json_encode($this->Empresa_modelo->modificarEmpresa($this->input->post(), $nombreArchivop));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
        else {
            if($this->input->post('cambio') == 0) {
                if ($this->form_validation->run() === TRUE) {
                    echo json_encode($this->Empresa_modelo->modificarEmpresa($this->input->post()));
                }
                else {
                    echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                }   
            }
        }
	}

}

