<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login($usuario,$contraseña){
		$this->db->select('usuarios.*');
		$this->db->join('perfiles', 'perfiles.id = usuarios.perfil_id');
		$this->db->where('perfiles.estatus', 1);
		$this->db->where('usuarios.nombre_usuario', $usuario);
		$this->db->where('usuarios.estatus', 1);
		$this->db->where('usuarios.contraseña', md5($contraseña));
	    $query = $this->db->get('usuarios');
	    //echo $this->db->last_query();
	    if ($query->num_rows() > 0) {
	    	$resultado = $query->row();
	    	$s_usuario = array(
		    		'id_usuario' 		=> $resultado->id,
		    		'usuario'	 		=> $resultado->nombre_usuario,
		    		'contraseña'		=> $resultado->contraseña,
		    		'id_perfil'		=> $resultado->perfil_id
		    	);
	    	//s_id_institucion Si este campo queda vacio quiere decir que el que se logeo fue un represetante
	    	//s_id_represetante Si este campo queda vacio y el de arriba quiere decir que el es el administrador o una cuenta de sepyc
	    	//Si ambos estan llenos, esto quiere decir que es una institucion la que esta logueada.
	    	//Tambien esto nos podemos dar cuenta con id del perfil. Pero explico el porque algunos campos quedan vacios al entrar a los if de arriba.
	    	$this->session->set_userdata($s_usuario);
		  	return true;
		}
		else{
		  	return false;
		 }
	}
}
