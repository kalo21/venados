<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->Model("Perfiles_modelo");
        $this->load->Model("Modulos_modelo");
        $this->load->Model('Carreras_modelo');
        $this->load->Model('Categorias_modelo');
        
    }
    public function informacionInicial($titulo){
        $data['imagen'] = "desarollador.png";
        $data['nombre'] = "Administrador - ".$this->session->userdata('usuario');
        $data['titulo'] = $titulo;
        return $data;
    }
    public function validacion(){
        $url = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"],"index.php"));//--TOMO EL URL A QUE SE QUIERE ACCEDER
        if($this->session->userdata('id_perfil') == true){//-- SI EL 's_id_usuario' EXISTE EN LA SESSION QUIERE DECIR QUE SI HUBO ALGUIEN LOGUEADO
            if($this->Modulos_modelo->validarPerfil($this->session->userdata('id_perfil'),$url)==true){//--VALIDA QUE EL PERFIL LOGUEADO LE PERTENECE EL MODULO AL QUE DESEA ACCEDER.
              return true;
            }
            else{
              header('Location: '.base_url().'index.php/Inicio/index');
            }
        }
        else{
          header('Location: '.base_url().'index.php/Inicio/index');
        }
      }
    public function index(){
        /*if($this->session->userdata('id_perfil') == '1'){*/
            $data['informacion'] = $this->informacionInicial("Perfiles");
            $data['modulos'] = $this->Modulos_modelo->obtenerModulosXPerfil($this->session->userdata('id_perfil'));
            $this->load->view('Administrador/inicio',$data);
        /*}*/
       /* else{
            header('Location: '.base_url().'index.php/Inicio/index');
        }*/
    }
    
    //**PERFILES PERFILES***//
    // Vista de perfiles de usuario administrador 
    public function perfil(){
        if($this->validacion()){
            $data['informacion'] = $this->informacionInicial("Perfiles");
            $data['modulos'] = $this->Modulos_modelo->obtenerModulosXPerfil($this->session->userdata('id_perfil'));
            $this->load->view('Administrador/perfil_vista',$data);
        }
    	
    }
    //Vista del modal cargado para asignar o eliminar modulos //La validacion es muy sencilla solo debe de verificar si esta logueado o no. Porque el submodulo del modulo pefiles.
    public function agregarModulos_modal($id_perfil){
        $data['id_perfil'] = $id_perfil;
        $data['modulosx'] = $this->Modulos_modelo->modulosXPerfil($id_perfil);
        $this->load->view('Administrador/listado_modulos',$data);
    }
    public function formularioPerfiles($id = ''){
        if (empty($id)) {
            $this->load->view('Administrador/formularioPerfiles_vista');
        }
        else{
            $resultado['perfiles'] = $this->Perfiles_modelo->obtenerPerfilesPorId($id);
            $this->load->view('Administrador/formularioPerfiles_vista', $resultado);
        }
        
    }
    //Funciones CRUD PERFILES
    public function obtenerPerfilesPorEstado($estatus){
    	$usuarios = $this->Perfiles_modelo->obtenerPerfilesPorEstado($estatus);
    	echo json_encode($usuarios);
    }

    public function cambiarEstatusPerfil(){
        $id = $this->input->post('id');
        $estatus = $this->input->post('estatus');
    	$usuarios = $this->Perfiles_modelo->cambiarEstatusPerfil($id, $estatus);
    	echo $usuarios;
    }

    public function agregarPerfil(){
        if($this->input->is_ajax_request()){ // solo se puede entrar por ajax 
            $nombre = $this->input->post('txtnombre');
            $descripcion = $this->input->post('txtdescripcion');
            //Validaciones
            $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
            $this->form_validation->set_rules('txtdescripcion', 'Descripción', 'required');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id' => '',
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'estatus' => 1
                );
                $resultado = $this->Perfiles_modelo->agregarPerfil($data);
                echo $resultado;
            }
            else{
                echo validation_errors('<li>', '</li>');
            }
        }
        else{
            show_404();
        }

    }

    public function editarPerfil(){
        if($this->input->is_ajax_request()){ // solo se puede entrar por ajax 
            $nombre = $this->input->post('txtnombre');
            $descripcion = $this->input->post('txtdescripcion');
            $id = $this->input->post('id');
            //Validaciones
            $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
            $this->form_validation->set_rules('txtdescripcion', 'Descripción', 'required');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                );
                $resultado = $this->Perfiles_modelo->editarPerfil($id,$data);
                echo $resultado;
            }
            else{
                echo validation_errors('<li>', '</li>');
            }
        }
        else{
            show_404();
        }

    }
    //**ACABA TODO LO REFERENTE A PERFILES**//
    //**EMPIEZA MODULOS MODULOS **//
    //Vistas
    public function modulo(){
        if($this->validacion()){
            $data['informacion'] = $this->informacionInicial("Perfiles");
            $data['modulos'] = $this->Modulos_modelo->obtenerModulosXPerfil($this->session->userdata('id_perfil'));
            $this->load->view('Administrador/modulo_vista',$data);
        }
        
    }
    public function formularioModulos($id = ''){
        $resultado['padres'] = $this->Modulos_modelo->obtenerModulosPadres();
        if (empty($id)) {
            $this->load->view('Administrador/formularioModulos_vista',$resultado);
        }
        else{
            $resultado['info'] = $this->Modulos_modelo->obtenerModulosPorId($id);
            $this->load->view('Administrador/formularioModulos_vista', $resultado);
        }
        
    }
    //Funciones CRUD PERFILES
    public function obtenerModulosPorEstado($estatus){
        $usuarios = $this->Modulos_modelo->obtenerModulosPorEstado($estatus);
        echo json_encode($usuarios);
    }
    
    public function asignarModuloPerfil(){
        if($this->input->is_ajax_request()) {
          $id_perfil = $this->input->post("id_perfil"); 
          $id_modulo = $this->input->post("id_modulo"); 
          $datos = array(
                'id_perfil'      => $id_perfil,
                'id_modulo'      => $id_modulo
          );
          echo $this->Perfiles_modelo->agregarModulo($datos);
        }
        else{
          show_404();
        }
      }
    public function eliminarModuloPerfil(){
        if ($this->input->is_ajax_request()) {
          $id_perfil = $this->input->post("id_perfil"); 
          $id_modulo = $this->input->post("id_modulo"); 
          echo $this->Perfiles_modelo->eliminarModulo($id_perfil,$id_modulo);
       }
        else{
          show_404();
        }
      }
    public function agregarModulo(){
        if($this->input->is_ajax_request()){ // solo se puede entrar por ajax 
            $nombre = $this->input->post('txtnombre');
            $descripcion = $this->input->post('txtdescripcion');
            $icono = $this->input->post('txticono');
            $padre = $this->input->post('txtopciones');
            $enlace = $this->input->post("txtenlace");
            $ruta = $this->input->post("txtruta");

            $this->form_validation->set_rules('txtnombre','Nombre','required');
            $this->form_validation->set_rules('txtdescripcion','Descripcion','required');
            if($padre == "on"){
                $padre = 1;
                $ruta="";
                $enlace="";
              }
              else{
                $this->form_validation->set_rules('txtruta','Ruta','required');
                $padre = 0; 
              } 
            $this->form_validation->set_rules('txticono','Icono','required');
            //print_r($this->input->post());
           if ($this->form_validation->run() === TRUE) {
               $datos = array(
                      'id'               => '',
                      'nombre'           => $nombre,
                      'descripcion'      => $descripcion,
                      'ruta'             => $ruta,
                      'estatus'          => 1,
                      'padre'            =>$padre,
                      'enlace'           =>$enlace,
                      'icono'            =>$icono
                );
                $resultado = $this->Modulos_modelo->agregarModulo($datos);
                echo $resultado;
            }
            else{
                echo validation_errors('<li>', '</li>');
            }
        }
        else{
            show_404();
        }

    }
    public function cambiarEstatusModulo(){
        $id = $this->input->post('id');
        $estatus = $this->input->post('estatus');
        $modulos = $this->Modulos_modelo->cambiarEstatusModulo($id, $estatus);
        echo $modulos;
    }
    public function cambiarEstatusModuloHijo(){
        $id = $this->input->post('id');
        $modulos = $this->Modulos_modelo->cambiarEstatusModuloHijo($id);
        echo $modulos;
    }
    public function cambiarEnlaceModuloHijo(){
        $id = $this->input->post('id');
        $modulos = $this->Modulos_modelo->cambiarEnlaceModuloHijo($id);
        echo $modulos;
    }
    
    
    public function editarModulo(){
        if($this->input->is_ajax_request()){ // solo se puede entrar por ajax 
            $nombre = $this->input->post('txtnombre');
            $descripcion = $this->input->post('txtdescripcion');
            $icono = $this->input->post('txticono');
            $padre = $this->input->post('txtopciones');
            $enlace = $this->input->post("txtenlace");
            $ruta = $this->input->post("txtruta");
            $id = $this->input->post('id');
            $this->form_validation->set_rules('txtnombre','Nombre','required');
            $this->form_validation->set_rules('txtdescripcion','Descripcion','required');
            if($padre == "on"){
                $padre = 1;
                $ruta="";
                $enlace="";
              }
              else{
                $this->form_validation->set_rules('txtruta','Ruta','required');
                $padre = 0; 
              } 
            $this->form_validation->set_rules('txticono','Icono','required');
            //print_r($this->input->post());
           if ($this->form_validation->run() === TRUE) {
               $datos = array(
                      'nombre'           => $nombre,
                      'descripcion'      => $descripcion,
                      'ruta'             => $ruta,
                      'padre'            => $padre,
                      'enlace'           => $enlace,
                      'icono'            => $icono
                );
                $resultado = $this->Modulos_modelo->editarModulo($id,$datos);
                echo $resultado;
            }
            else{
                echo validation_errors('<li>', '</li>');
            }
        }
        else{
            show_404();
        }

    }
    //**ACABA TODO LO REFERENTE A MODULOS**//
    //
    //**INICIA CON LOS USUARIOS 
    //
    public function usuarios(){
    	if($this->validacion()){
    		$data['informacion'] = $this->informacionInicial('Usuarios');
    		$data['modulos'] = $this->Modulos_modelo->obtenerModulosXPerfil($this->session->userdata('id_perfil'));
    		$this->load->view('Administrador/usuarios_vista', $data);
    	}
    	
    }

    public function obtenerUsuarios($estado){

    }
    
    // ===========================================================================================
    // 					MODULO DE CARRERAS
    // VISTA

    public function carreras(){
    	if($this->validacion()){
    		$data['informacion'] = $this->informacionInicial('Carreras');
    		$data['modulos'] = $this->Modulos_modelo->obtenerModulosXPerfil($this->session->userdata('id_perfil'));
    		$this->load->view('Administrador/carreras_vista', $data);
    	}
    }

    public function obtenerCarreras($estado){
    	if($this->input->is_ajax_request()){
    		$resultado = $this->Carreras_modelo->obtenerCarreras($estado);
    		echo json_encode($resultado);
    	}else{
    		show_404();
    	}
    }
    // Funciones CRUD de carreras
    public function formularioCarreras($id = ''){

    	if (empty($id)) {
            $this->load->view('Administrador/formularioCarreras_vista');
        }
        else{
            $resultado['carreras'] = $this->Carreras_modelo->obtenerCarreraEditar($id);
            $this->load->view('Administrador/formularioCarreras_vista', $resultado);
        }
    }

    public function agregarCarrera(){
    	if($this->input->is_ajax_request()){
            $nombre = $this->input->post('txtnombre');
            $abreviatura = $this->input->post('txtabreviatura');

            $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
            $this->form_validation->set_rules('txtabreviatura', 'Abreviatura', 'required');
            if($this->form_validation->run() == TRUE){
                $data = array(
                    'id' => '',
                    'descripcion' => $nombre,
                    'abreviatura' => $abreviatura,
                    'estatus' => 1
                );
                $resultado = $this->Carreras_modelo->agregarCarrera($data);
                echo $resultado;
            }else{
                echo validation_errors('<li>', '</li>');
            }
            
        }else{
            show_404();
        }
    }

    public function editarCarrera(){
    	if ($this->input->is_ajax_request()) {
    		$nombre = $this->input->post('txtnombre');
            $abreviatura = $this->input->post('txtabreviatura');
            $id = $this->input->post('id');
            $devieja = $this->input->post('devieja');
            //Validación
            $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
            $this->form_validation->set_rules('txtabreviatura', 'Abreviatura', 'required');
            if($this->form_validation->run() == TRUE){
            	$data = array(
                    'descripcion' => $nombre,
                    'abreviatura' => $abreviatura
                );
                $resultado = $this->Carreras_modelo->editarCarrera($id, $data, $devieja);
                echo $resultado;
            }else{
            	echo validation_errors('<li>', '</li>');
            }
    	}else{
    		show_404();	
    	}
    }

    public function cambiarEstatusCarrera(){
    	$id = $this->input->post('id');
        $estatus = $this->input->post('estatus');
    	$resultado = $this->Carreras_modelo->cambiarEstatusCarrera($id, $estatus);
    	echo $resultado;
    }

    //==============================================================================================================
    //              MODULO DE CATEGORIAS

    public function categorias(){
        if ($this->validacion()) {
            $data['informacion'] = $this->informacionInicial('Categorias');
            $data['modulos'] = $this->Modulos_modelo->obtenerModulosXPerfil($this->session->userdata('id_perfil'));
            $this->load->view('Administrador/categorias_vista', $data);
        }
    }

    public function obtenerCategorias($estado){
        if($this->input->is_ajax_request()){
            $resultado = $this->Categorias_modelo->obtenerCategorias($estado);
            echo json_encode($resultado);
        }else{
            show_404();
        }
    }

    //  FUNCIONES CRUD DE CATEGORIAS
    public function formularioCategorias($id = ''){

        if (empty($id)) {
            $this->load->view('Administrador/formularioCategoria_vista');
        }
        else{
            $resultado['categoria'] = $this->Categorias_modelo->obtenerCategoriaEditar($id);
            print_r($resultado);
            $this->load->view('Administrador/formularioCategoria_vista', $resultado);
        }
    }

    public function agregarCategoria(){
        if($this->input->is_ajax_request()){
            $nombre = $this->input->post('txtnombre');

            $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
            if($this->form_validation->run() == TRUE){
                $data = array(
                    'id' => '',
                    'descripcion' => $nombre,
                    'estatus' => 1
                );
                $resultado = $this->Categorias_modelo->agregarCategoria($data);
                echo $resultado;
            }else{
                echo validation_errors('<li>', '</li>');
            }
            
        }else{
            show_404();
        }
    }

    public function editarCategoria(){
        if ($this->input->is_ajax_request()) {
            $nombre = $this->input->post('txtnombre');
            $id = $this->input->post('id');
            $devieja = $this->input->post('devieja');
            //Validación
            $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
            if($this->form_validation->run() == TRUE){
                $data = array(
                    'descripcion' => $nombre,
                );
                $resultado = $this->Categorias_modelo->editarCategoria($id, $data, $devieja);
                echo $resultado;
            }else{
                echo validation_errors('<li>', '</li>');
            }
        }else{
            show_404(); 
        }
    }
}