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
			$this->load->view('Empresa/empresa_imagen_modal');
		}
		else {
			$data['datos'] = $this->Empresa_modelo->obtenerDatos($id);
			$this->load->view('Empresa/empresa_visual_modal',$data);
		}
    }

    public function modificarImagen($id){
        $data['datos'] = $this->Empresa_modelo->obtenerDatos($id);
		$this->load->view('Empresa/empresa_dividir_modal',$data);
    }

    public function modificarTexto($id){
        $data['datos'] = $this->Empresa_modelo->obtenerDatos($id);
		$this->load->view('Empresa/empresa_modal',$data);
    }

    public function formularioinformacion(){
        $this->load->view('Empresa/empresa_informacion_modal');
    }

    public function formulariousuario(){
        $this->load->view('Empresa/empresa_usuario_modal');
    }

    public function agregarUsuario(){
        $this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inpApellidoPaterno', 'Apellido paterno', 'required');
        $this->form_validation->set_rules('inpApellidoMaterno', 'Apellido materno', 'required');
        $this->form_validation->set_rules('inpNombreU', 'Usuario', 'required');
		$this->form_validation->set_rules('inpContrasena', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inpVerificar', 'Verificiar contraseña', 'trim|required|matches[inpContrasena]');
        $this->form_validation->set_rules('inpCorreo', 'Correo', 'trim|required|valid_email|is_unique[usuarios.correo]'); 
        if($this->form_validation->run() == TRUE){
            echo json_encode($this->Empresa_modelo->agregarUsuario($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }

    public function agregarInfo(){
        $this->form_validation->set_rules('inpNombreE', 'Nombre de empresa', 'required|is_unique[empresas.nombre]');
        $this->form_validation->set_rules('inpDescripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('inpRazonSocial', 'Razón social', 'required');
		$this->form_validation->set_rules('inpRFC', 'RFC', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empresa', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empresa', 'numeric');
        $this->form_validation->set_rules('inpLocal', 'Local', 'required');
        if($this->form_validation->run() == TRUE){
            echo json_encode($this->Empresa_modelo->agregarInfo($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }

    public function agregarImagen(){
        $idEmpresa = $this->input->post('idEmpresa');
        mkdir('./assets/Empresas/'.$idEmpresa, 0777,true);
        $config = [
            "upload_path" => './assets/Empresas/'.$idEmpresa,
            'allowed_types' => "png|jpg|jpeg"
        ];
        $this->load->library("upload",$config);
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if($this->upload->do_upload('fotoV')){
                $dataV = array("upload_data" => $this->upload->data());
                $nombreArchivopV = $dataV['upload_data']['file_name'];    
                $id = ($this->Empresa_modelo->agregarImagen($idEmpresa,$nombreArchivop,$nombreArchivopV));
                if($id['exito']) {
                    mkdir('./assets/Empresas/'.$idEmpresa.'/Productos',0777,true);
                }
                echo json_encode($id);
            }
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
            rmdir('./assets/Empresas/'.$idEmpresa);
        }
           
    }

	public function agregarEmpresa() {
        mkdir('./assets/Empresas/abc', 0777,true);
        $config = [
            "upload_path" => "./assets/Empresas/",
            'allowed_types' => "png|jpg|jpeg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de empresa', 'required|is_unique[empresas.nombre]');
        $this->form_validation->set_rules('inpDescripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('inpRazonSocial', 'Razón social', 'required');
		$this->form_validation->set_rules('inpRFC', 'RFC', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empresa', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empresa', 'numeric');
		$this->form_validation->set_rules('inpLocal', 'Local', 'required');
		$this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpContrasena', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inpVerificar', 'Verificiar contraseña', 'trim|required|matches[inpContrasena]');
		$this->form_validation->set_rules('inpCorreo', 'Correo', 'trim|required|valid_email|is_unique[usuarios.correo]');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if($this->upload->do_upload('fotoV')){
                $dataV = array("upload_data" => $this->upload->data());
                $nombreArchivopV = $dataV['upload_data']['file_name'];    
                if ($this->form_validation->run() == TRUE) {
                    $id = $this->Empresa_modelo->agregarEmpresa($this->input->post(), $nombreArchivop,$nombreArchivopV);
                    if($id['exito']) {
                        mkdir('./assets/Empresas/abc/Productos',0777,true);
                        rename('./assets/Empresas/abc','./assets/Empresas/'.$id['msg']);
                        rename('./assets/Empresas/'.$nombreArchivopV, './assets/Empresas/'.$id['msg'].'/'.$nombreArchivopV);
                        rename('./assets/Empresas/'.$nombreArchivop, './assets/Empresas/'.$id['msg'].'/'.$nombreArchivop);
                    }
                    else {
                        rmdir('./assets/Empresas/abc');
                        unlink('./assets/Empresas/'.$nombreArchivopV);
                        unlink('./assets/Empresas/'.$nombreArchivop);
                    }
                    echo json_encode($id);
                }
                else {
                    echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                    rmdir('./assets/Empresas/abc');
                    unlink('./assets/Empresas/'.$nombreArchivopV);
                    unlink('./assets/Empresas/'.$nombreArchivop);
                }
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
                rmdir('./assets/Empresas/abc');
            }
           
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
            rmdir('./assets/Empresas/abc');
        }
        
    }
    
    public function ModificarImg(){
        $config = [
            "upload_path" => "./assets/Empresas/".$this->input->post('id'),
            'allowed_types' => "png|jpg|jpeg"
        ];
        $this->load->library("upload",$config);
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if($this->upload->do_upload('fotoV')){
                $dataV = array("upload_data" => $this->upload->data());
                $nombreArchivopV = $dataV['upload_data']['file_name'];
                echo json_encode($this->Empresa_modelo->modificarEmpresa($this->input->post(),$nombreArchivop , $nombreArchivopV));
            }
        }
        else if($this->upload->do_upload('foto')  && $this->input->post('cambio') != 0) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            echo json_encode($this->Empresa_modelo->modificarEmpresaLogo($this->input->post(), $nombreArchivop));
        }
        else if($this->upload->do_upload('fotoV') && $this->input->post('cambioV') != 0){
            $dataV = array("upload_data" => $this->upload->data());
            $nombreArchivopV = $dataV['upload_data']['file_name'];
            echo json_encode($this->Empresa_modelo->modificarEmpresaFondo($this->input->post(),$nombreArchivopV));
        }
    }

    public function modificarTxt(){
        $this->form_validation->set_rules('inpNombreE', 'Nombre de empresa', 'required');
        $this->form_validation->set_rules('inpDescripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('inpRazonSocial', 'Razón social', 'required');
		$this->form_validation->set_rules('inpRFC', 'RFC', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empresa', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empresa', 'numeric');
        $this->form_validation->set_rules('inpLocal', 'Local', 'required');
        if ($this->form_validation->run() == TRUE) {
            echo json_encode($this->Empresa_modelo->modificarEmpresaTexto($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }
    

	public function modificarEmpresa() {
        $config = [
            "upload_path" => "./assets/Empresas/".$this->input->post('id'),
            'allowed_types' => "png|jpg|jpeg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de empresa', 'required');
        $this->form_validation->set_rules('inpDescripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('inpRazonSocial', 'Razón social', 'required');
		$this->form_validation->set_rules('inpRFC', 'RFC', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empresa', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empresa', 'numeric');
        $this->form_validation->set_rules('inpLocal', 'Local', 'required');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if($this->upload->do_upload('fotoV')){
                $dataV = array("upload_data" => $this->upload->data());
                $nombreArchivopV = $dataV['upload_data']['file_name'];
                if ($this->form_validation->run() == TRUE) {
                    echo json_encode($this->Empresa_modelo->modificarEmpresa($this->input->post(),$nombreArchivop , $nombreArchivopV));
                }
                else {
                    echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                }
            }
        }
        else if($this->upload->do_upload('foto')  && $this->input->post('cambio') != 0) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() == TRUE) {
                echo json_encode($this->Empresa_modelo->modificarEmpresaLogo($this->input->post(), $nombreArchivop));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
        else if($this->upload->do_upload('fotoV') && $this->input->post('cambioV') != 0){
            $dataV = array("upload_data" => $this->upload->data());
            $nombreArchivopV = $dataV['upload_data']['file_name'];
            if ($this->form_validation->run() == TRUE) {
                echo json_encode($this->Empresa_modelo->modificarEmpresaFondo($this->input->post(),$nombreArchivopV));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
        else if($this->input->post('cambioV') == 0 && $this->input->post('cambio') == 0){
            if ($this->form_validation->run() == TRUE) {
                echo json_encode($this->Empresa_modelo->modificarEmpresaTexto($this->input->post()));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
	}
}