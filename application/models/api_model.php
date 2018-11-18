<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Api_model extends CI_Model {
	
	function __construct() {

	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    $method = $_SERVER['REQUEST_METHOD'];
	    if($method == "OPTIONS") {
	        die();
	    }
	    parent::__construct();
	}

	public function getStores(){
		$query = $this->db->select('empresas.id, empresas.nombre, empresas.descripcion, empresas.logotipo, empresas.estatus')->from('empresas, detallesevento')->where('empresas.estatus',1)->where('detallesevento.id_empresa=empresas.id')->where('detallesevento.id_evento',1)->get();
//		SELECT * FROM empresas, detallesevento WHERE empresas.id = detallesevento.id_empresa AND detallesevento.id_evento = 1

		return $query->result();
	}

	public function getUser($usuario){

		try{
			$q = $this->db
				->where(array('nombre'=>$usuario->user,'estatus'=>1))
				->where('(idperfil = 4 OR idperfil = 5)')
				->get('usuarios')->row();
			if(!is_null($q)){
				$encrypted_pass = $q->contraseña;
				if(password_verify($usuario->password, $encrypted_pass)){
					return (array) $q;
				}
				else{
					$obj = array('code'=>151, 'message'=>'Usuario o contraseña incorrecta.');
					return $obj;
				}
			}
			else{
				$obj = array('code'=>150, 'message'=>'No se encontró el usuario.');
				return $obj;
			}
		}
		catch(Exception $e){
		    return $this->db->error();
		}
	}

	public function register($usuario, $cliente){
		$usuario->contraseña = password_hash($usuario->contraseña, PASSWORD_DEFAULT);
		try{
			$this->db->trans_start();
		    if($this->db->insert('usuarios', $usuario)){
				$cliente['id_usuario'] = $this->db->insert_id();
				$this->db->insert('clientes', $cliente);
				$this->db->trans_complete();
		    	return 1;
		    }
		    else{
		    	return $this->db->error();
		    }
		}
		catch(Exception $e){
		    return $this->db->error();
		}

	}

	public function getIdByUser($user){
		return $this->db->select('id')->where('nombre',$user)->get('usuarios')->row();
	}

	public function addPedido($usuario){
		return $this->db->insert('pedidos', $usuario[0]);
	}

	public function getProductos($id){
		$q = $this->db->select('*')->from('productos')->where('idempresa',$id)->get();
		return $q->result();
	}

	public function getNotifications($idUser){
		$this->db->join('pedidos', 'pedidos.id = notificaciones.idpedido');
		$this->db->join('empresas', 'pedidos.idempresa = empresas.id');
		$this->db->where(array('pedidos.idusuario'=>$idUser, 'notificaciones.estatus'=>1));
		$this->db->select('notificaciones.id, empresas.nombre, pedidos.estatus, notificaciones.idpedido, notificaciones.mensaje, notificaciones.fecha, notificaciones.hora');
		$q = $this->db->get('notificaciones')->result();
		return $q;
	}

	public function deleteNotifications($ids){
		$this->db->where_in('id', $ids);
		$usuario = array('estatus'=>0);
		$this->db->update('notificaciones',$usuario);
	}
	
}