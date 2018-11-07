<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    	$this->load->model('Usuarios_modelo');
    	$this->load->helper(array('funciones_generales_helper','url'));
	}
	
	public function index() {
		if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Usuarios");
            $this->load->view('Usuarios/usuario_vista',$data);
        }
		
	}
	public function obtenerUsuarios($estatus) {
		echo json_encode($this->Usuarios_modelo->obtenerUsuarios($estatus));
	}
	
	public function agregarUsuario() {
        $this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
        $this->form_validation->set_rules('inpContrasena', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inpVerificar', 'Verificiar contraseña', 'trim|required|matches[inpContrasena]');
        $this->form_validation->set_rules('inpCorreo', 'Correo', 'trim|required|valid_email|is_unique[usuarios.correo]');
        $this->form_validation->set_rules('inpPerfil', 'Perfil', 'required');
        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Usuarios_modelo->agregarUsuario($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
    }
	
	public function formulario($id = '') {
		$datos['perfiles'] = $this->Usuarios_modelo->obtenerPerfiles();
		if(empty($id)) {
			$this->load->view('Usuarios/usuario_modal', $datos);
		}
		else {
			$data['datos'] = $this->Usuarios_modelo->obtenerDatos($id);
			$data = $data + $datos;
			$this->load->view('Usuarios/usuario_modal',$data);
		}
	}

	public function modificarUsuario() {
		$this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpDescripcion', 'Descripción', 'required');
        if ($this->form_validation->run() === TRUE) {
			echo json_encode($this->Usuarios_modelo->modificarUsuario($this->input->post()));
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
        }
	}
}