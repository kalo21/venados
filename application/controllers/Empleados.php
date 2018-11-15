<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
		$this->load->model('Empleados_modelo');
		$this->load->helper(array('funciones_generales_helper','url'));
    }
    public function index(){
    	if(validacion()){
            $data['modulos'] = modulos();
            $data['informacion'] = informacionInicial("Venados | Empleados");
    		$this->load->view('Empleados/empleados_vista',$data);
        }
    }
	public function obtenerEmpleados($estatus) {
		echo json_encode($this->Empleados_modelo->obtenerEmpleados($estatus));
	}
	public function cambiarEstado() {
		$this->Empleados_modelo->cambiarEstado($this->input->post('id'), $this->input->post('estatus'));
	}

	public function formulario($id = '') {
		if(empty($id)) {
			$this->load->view('Empleados/empleados_modal');
		}
		else {
			$data['datos'] = $this->Empleados_modelo->obtenerDatos($id);
			$data['usuario'] = $this->Empleados_modelo->obtenerUsuario($data['datos']->id_usuario);
			$this->load->view('Empleados/empleados_modal',$data);
		}
	}

	public function agregarEmpleados() {
        mkdir('./assets/Empleados/abc', 0777,true);
        $config = [
            "upload_path" => "./assets/Empleados/",
            'allowed_types' => "png|jpg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de empleado', 'required|is_unique[empleados.nombre]');
        $this->form_validation->set_rules('inpMaterno', 'Apellido materno', 'required');
		$this->form_validation->set_rules('inpPaterno', 'Apellido paterno', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empleado', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empleados', 'numeric');
		$this->form_validation->set_rules('inpNombre', 'Nombre', 'required');
		$this->form_validation->set_rules('inpContrasena', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inpVerificar', 'Verificiar contraseña', 'trim|required|matches[inpContrasena]');
		$this->form_validation->set_rules('inpCorreo', 'Correo', 'trim|required|valid_email|is_unique[usuarios.correo]');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                $id = $this->Empleados_modelo->agregarEmpleados($this->input->post(), $nombreArchivop);
                if($id['exito']) {
                    rename('./assets/Empleados/abc','./assets/Empleados/'.$id['msg']);
                    rename('./assets/Empleados/'.$nombreArchivop, './assets/Empleados/'.$id['msg'].'/'.$nombreArchivop);
                }
                else {
                    rmdir('./assets/Empleados/abc');
                    unlink('./assets/Empleados/'.$nombreArchivop);
                }
                echo json_encode($id);
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                rmdir('./assets/Empleados/abc');
                unlink('./assets/Empleados/'.$nombreArchivop);
            }
        }
        else {
            echo json_encode(array('exito' => false, 'msg' => $this->upload->display_errors()));
            rmdir('./assets/Empleados/abc');
        }
        
	}

	public function modificarEmpleados() {
        $config = [
            "upload_path" => "./assets/Empleados/".$this->input->post('id'),
            'allowed_types' => "png|jpg|jpeg"
        ];
        $this->load->library("upload",$config);
		$this->form_validation->set_rules('inpNombreE', 'Nombre de empleado', 'required');
        $this->form_validation->set_rules('inpMaterno', 'Apellido materno', 'required');
		$this->form_validation->set_rules('inpPaterno', 'Apellido paterno', 'required');
		$this->form_validation->set_rules('inpDomicilio', 'Domicilio de empleado', 'required');
		$this->form_validation->set_rules('inpTelefono', 'Teléfono de empleados', 'numeric');
        if($this->upload->do_upload('foto')) {
            $data = array("upload_data" => $this->upload->data());
            $nombreArchivop = $data['upload_data']['file_name'];
            if ($this->form_validation->run() === TRUE) {
                echo json_encode($this->Empleados_modelo->modificarEmpleados($this->input->post(), $nombreArchivop));
            }
            else {
                echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
            }
        }
        else {
            if($this->input->post('cambio') == 0) {
                if ($this->form_validation->run() === TRUE) {
                    echo json_encode($this->Empleados_modelo->modificarEmpleados($this->input->post()));
                }
                else {
                    echo json_encode(array('exito' => false, 'msg' => validation_errors('<li>', '</li>')));
                }   
            }
        }
	}
}