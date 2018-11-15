<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('informacionInicial')){
	function informacionInicial($titulo){
        $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
         switch ($ci->session->userdata('idPerfil')) {
            case '1':
                $data['imagen'] = "desarollador.png";
                $data['nombre'] = "Administrador - ".$ci->session->userdata('nombre');
                break;
            case '2':
                $data['imagen'] = $ci->session->userdata('imagen');
                $data['nombre'] = "Empresa - ".$ci->session->userdata('nombreEmpresa');
                break;
            case '3':
                $data['imagen'] = "sistemas.png";
                $data['nombre'] = "Sistemas - ".$ci->session->userdata('nombre');
                break;
            case '4':
                $data['imagen'] = "cliente.png";
                $data['nombre'] = "Cliente - ".$ci->session->userdata('nombre');
                break;
            case '5':
                $data['imagen'] = "cliente.png";
                $data['nombre'] = "Empleado - ".$ci->session->userdata('nombre');
                break;
            default:
                $data['imagen'] = "hacker.png";
                $data['nombre'] = "Infiltrado - ".$ci->session->userdata('nombre');
                break;
        }
        $data['titulo'] = $titulo;
        return $data;
    }
}
if(!function_exists('validacion')){
    function validacion(){
        $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
        $url = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"],"index.php"));//--TOMO EL URL A QUE SE QUIERE ACCEDER
        $ci->load->Model('Modulos_modelo');
        if($ci->session->userdata('idPerfil') == true){//-- SI EL 'id_usuario' EXISTE EN LA SESSION QUIERE DECIR QUE SI HUBO ALGUIEN LOGUEADO
            if($ci->Modulos_modelo->validarPerfil($ci->session->userdata('idPerfil'),$url)==true){//--VALIDA QUE EL PERFIL LOGUEADO LE PERTENECE EL MODULO AL QUE DESEA ACCEDER.
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
}
if(!function_exists('modulos')){
    function modulos(){
        $ci =& get_instance();//asignamos a $ci el super objeto de codeigniter//$ci será como $this
        $ci->load->model('Modulos_modelo');
        return $ci->Modulos_modelo->obtenerModulosXPerfil($ci->session->userdata('idPerfil'));
    }

        
}
//end application/helpers/inicio_helper.php