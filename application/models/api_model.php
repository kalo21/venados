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
		$query = $this->db->select('empresas.id, empresas.nombre, empresas.descripcion, empresas.img_fondo, empresas.estatus')->from('empresas, detallesevento')->where('empresas.estatus',1)->where('detallesevento.id_empresa=empresas.id')->where('detallesevento.id_evento',1)->get();
		$query = $this->db->select('empresas.id, empresas.nombre, empresas.descripcion, empresas.img_fondo, empresas.estatus')->from('empresas, detallesevento')->where('empresas.estatus',1)->where('detallesevento.id_empresa=empresas.id')->where('detallesevento.id_evento',2)->get();
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

	public function addPedido($data){
		
	}

	public function getIdByUser($user){
		return $this->db->select('id')->where('nombre',$user)->get('usuarios')->row();
	}


	public function getProductos($id){
		$q = $this->db->select('*')->from('productos')->where(array('idempresa'=>$id, 'estatus' => 1))->get();
		return $q->result();
	}

	public function getNotifications($idUser){
		$this->db->where(array('notificaciones.id_usuario'=>$idUser, 'notificaciones.estatus'=>1));
		$this->db->order_by('id','desc');
		$q = $this->db->get('notificaciones')->result();
		return $q;
	}

	public function deleteNotifications($ids){
		$this->db->where_in('id', $ids);
		$usuario = array('estatus'=>0);
		$this->db->update('notificaciones',$usuario);
	}

	public function recargarSaldo($data){
		try{
			$this->db->trans_start();
			$this->db->select('vendedores.id');
			$this->db->join('usuarios','vendedores.id_usuario = usuarios.id');
			$this->db->where('usuarios.id',$data['id_empleado']);
			$q = $this->db->get('vendedores')->row();
			if($q !== null){
				$data['id_empleado'] = $q->id;
				if($this->db->insert('recargas', $data)){
					$this->db->set('clientes.saldo','`clientes`.`saldo` + '.$data['monto'], false);
					$this->db->where('clientes.id', $data['id_cliente']);
					$this->db->update('clientes');
					//echo $this->db->last_query();
					if($this->db->affected_rows()==0){
						return 'El usuario no existe, reingreselo e inténte de nuevo.';
					}
					$this->db->trans_complete();
					return 1;
				}
				else{
					return 'Error en la conexión, por favor inténtelo de nuevo.';
				}
			}
			else{
				return 'Error en la conexión, por favor inténtelo de nuevo.';
			}
		}
		catch(Exception $e){
		    return 'Error en la conexión, por favor inténtelo de nuevo.';
		}
	}
	/**
	 * Retorna true si coincide y false si no 
	 */
	public function verificar_pin($pin, $usuario_id){
		$this->db->select('vendedores.id');
		$this->db->where(array('vendedores.pin'=>$pin, 'vendedores.id_usuario'=>$usuario_id));
		if(is_null($this->db->get('vendedores')->row())){
			return false;
		}
		else{
			return true;
		}
	}

	public function get_historial_recargas($id_empleado, $limit, $offset){
		$this->db->select('vendedores.id');
		$this->db->join('usuarios', 'vendedores.id_usuario = usuarios.id');
		$this->db->where('vendedores.id_usuario',$id_empleado);
		$id_vendedor = $this->db->get('vendedores')->row()->id;
		$this->db->where('recargas.id_empleado',$id_vendedor);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('recargas', $limit, $offset);
		//echo $this->db->last_query();
		return $query->result();
	}

	public function getUserByIdClient($id_cliente){
		$this->db->select('usuarios.nombre, usuarios.id');
		$this->db->join("usuarios", "usuarios.id = clientes.id_usuario");
		$this->db->where("clientes.id", $id_cliente);
		return	 $this->db->get('clientes')->row();
	}

	public function storeNotification($data){
		$this->db->insert('notificaciones',$data);
	}
	
	public function getUserData($idUser){
		try{
			$query = $this->db->select('usuarios.correo, clientes.*')->from('clientes, usuarios')->where('usuarios.estatus',1)->where('usuarios.id', $idUser)->where('usuarios.id = clientes.id_usuario')->get();
			return $query->result();
		}catch (Exception $e) {
			return $this->db->error();
		}
	}

	public function getPedidos($idUser){
		try {
			$query = $this->db->select('empresas.nombre, pedidos.id, pedidos.idempresa, pedidos.total, pedidos.estatus')->from('pedidos, empresas')->where('pedidos.estatus != "Eliminado"')->where('idusuario', $idUser)->where('empresas.id = pedidos.idempresa')->get();
			return $query->result();
			
		} catch (Exception $e) {
			return $this->db->error();
		}
	}

	public function getDetallesPedidos($idPedido){
		try {
			$query = $this->db->select('productos.nombre, productos.imagen, detallepedidos.*')->from('detallepedidos, productos')->where('detallepedidos.idpedido', $idPedido)->where('productos.id = detallepedidos.idproducto')->get();
			return $query->result();
			
		} catch (Exception $e) {
			return $this->db->error();
		}
	}

	public function getUserSaldo($idUser){
		try {
			$query = $this->db->select('saldo')->from('clientes, usuarios')->where('clientes.id_usuario', $idUser)->where('usuarios.id = clientes.id_usuario')->get();
			return $query->result();
		} catch (Exception $e) {
			return $this->db->error();
		}
	}

	public function eliminarPedido($idPedido){
		try {
			$this->db->trans_begin();
			$this->db->where('pedidos.id', $idPedido);
	        $data = array( 'estatus' => 'Eliminado');
	        $this->db->update('pedidos', $data);

			if ($this->db->trans_status() == FALSE){
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return true;
			}
			
			
		} catch (Exception $e) {
			return $this->db->error();
		}
	}

	public function isThereAnEvent($fecha){
		$this->db->where(array('eventos.fecha_inicial <=' => $fecha, 'eventos.fecha_fin >=' => $fecha, 'status' => 1));
		$this->db->limit(1);
		$q = $this->db->get('eventos');
		return $q->row();
	}
}