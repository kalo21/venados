<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/implementJwt.php';

class Api extends CI_Controller {
	private $perfil;
	function __construct() {

	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->objOfJwt = new implementJwt();
		parent::__construct();
		define("CLIENTE", 4);
		define("EMPLEADO", 5);
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}

		//Esta variable es para que no haga la autentificación para las funciones que contiene
		$noAuthRequiredUris = array("login","isThereAnEvent","decodeToken","send_notif","addUser");	
		if(substr($_SERVER['REQUEST_URI'], -1) != '/'){
			$UriExploded = explode("/", $_SERVER['REQUEST_URI']);
		}	
		else{	
			$uri = substr($_SERVER['REQUEST_URI'], 0, -1);
			$UriExploded = explode("/", $uri);
		}	
		$functionRequested = end( ($UriExploded) );
		$isAuthRequired = true;
		foreach ($noAuthRequiredUris as $element){
			if($functionRequested == $element){
				$isAuthRequired = false;
				break;
			}
		}


		if($isAuthRequired){
			try{
				$token = $this->input->request_headers()["Authorization"];
				$this->perfil = $this->objOfJwt->DecodeToken($token)->tipo_usuario;
			}
			catch(Exception $e){
				echo "Error de autentificación";
				die();
			}
		}

		$this->load->model('Api_model');
	}
	public function index(){
		echo "sirbp";
	}

	public function getStores(){
		if($this->perfil == CLIENTE){
			$idEvento = $this->input->get('idEvento');
			$stores = $this->Api_model->getStores($idEvento);
			echo json_encode($stores);
		}
		else{
			$this->printProhibitedAccess();
		}
		//$json= json_encode($stores);
		//$key = 'SuperSecretKeyss';
		 //To Encrypt: 
		 //echo $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $json , MCRYPT_MODE_ECB); 
		 //To Decrypt: 
		  //echo $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted, MCRYPT_MODE_ECB); 

	}

	public function addPedido(){
		if($this->perfil == CLIENTE){
			$json_str = file_get_contents('php://input');
			$json_obj = json_decode($json_str);
			
			echo $this->Api_model->addPedido($json_obj, true);
		}
		else{
			$this->printProhibitedAccess();
		}
	}
	/**
	 * Registro
	 */
	public function addUser(){
		$json_obj = json_decode(file_get_contents('php://input'));

		$usuario = $json_obj[0];
		$cliente = $json_obj[1];
		$apellidos = explode(" ",$cliente->apellidos);
		$apellidoMat = "";
		for($index = 1; $index < sizeof($apellidos); $index++)
			$apellidoMat.=$apellidos[$index]." ";
		$clienteDB = array(
			'nombre' => $cliente->nombre,
			'apellidopaterno' => $apellidos[0],
			'apellidomaterno'=>sizeof($apellidos) > 1?$apellidoMat:' ',
			'telefono' => $cliente->telefono,
			'saldo' => 0.0
		);
		if($usuario != ''){
			if(($msg = $this->Api_model->register($usuario,$clienteDB)) == 1){
				$id = $this->getIdByUser($usuario->nombre);
				$dataToken = array('id' => $id, 
								'nombre' => $usuario->nombre,
								'tipo_usuario'=>CLIENTE);
				$token = $this->objOfJwt->GenerateToken($dataToken);
				$response = array('id' => $id,
								'nombre' => $usuario->nombre,
								'tipo_usuario'=>'Cliente',
								'token' => $token);
				echo json_encode($response);
			}else{
				switch ($msg['code']) {
					case 1062:
						echo '{"error":"Ya existe un usuario con este nombre"}';
						break;
					
					default:
						echo '{"error":"Hubo un error en la conexión"}';
						break;
				}
			}
		}

	}

	public function getIdByUser($user){
		$id = $this->Api_model->getIdByUser($user)->id;
		return $id;
	}

	public function decodeToken(){
		$json_str = file_get_contents('php://input');
		echo json_encode($this->objOfJwt->DecodeToken($json_str));
	}

	public function login(){
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str);
		if($json_obj != ''){
			$data = $this->Api_model->getUser($json_obj);
			if (!(isset($data['code']))){
				$dataToken = array('id' => $data['id'], 
								   'nombre' => $data['nombre'],
								   'tipo_usuario'=>$data['idperfil']);
				$token = $this->objOfJwt->GenerateToken($dataToken);
				$response = array('id' => $data['id'],
								  'nombre' => $data['nombre'],
								  'tipo_usuario'=>$data['idperfil']==4?'Cliente':'Vendedor',
								  'token' => $token);
				echo json_encode($response);
			}else{
				switch ($data['code']) {
					case 150:
						echo '{"error":"'.$data['message'].'"}';
						break;
					case 151:
						echo '{"error":"'.$data['message'].'"}';
						break;
					default:
						echo '{"error":"Hubo un error en la conexión"}';
						break;
				}
			}
		}
	}

	
	public function getProducts(){
		if($this->perfil == CLIENTE){
			$id = $this->input->get('id');
			$productos = $this->Api_model->getProductos($id);
			echo json_encode($productos);
			//$this->load->view('welcome_message');
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function getPedidos(){
		if($this->perfil == CLIENTE){
			$idUser = $this->input->get('idUser');
			$pedidos = $this->Api_model->getPedidos($idUser);
			echo json_encode($pedidos);
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function getDetallesPedidos(){
		if($this->perfil == CLIENTE){
			$idPedido = $this->input->get('idPedido');
			$detalles = $this->Api_model->getDetallesPedidos($idPedido);
			echo json_encode($detalles);
		}
		else{
			$this->printProhibitedAccess();
		}
	}
	public function getUserData(){
		$idUser = $this->input->get('idUser');
		$userData = $this->Api_model->getUserData($idUser);
		echo json_encode($userData);
		//$this->load->view('welcome_message');
	}
	/**
	*/

	public function eliminarPedido(){
		if($this->perfil == CLIENTE){
			$idPedido = $this->input->get('idPedido');
			$response = $this->Api_model->eliminarPedido($idPedido);
			echo json_encode($response);
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function getUserSaldo(){
		if($this->perfil == CLIENTE){
			$idUser = $this->input->get('idUser');
			$userSaldo = $this->Api_model->getUserSaldo($idUser);
			echo json_encode($userSaldo);
		}
		else{
			$this->printProhibitedAccess();
		}
	}


	/**
	 * Envia notificaciones de la tienda al usuario
	 * Recibe por post 
	 * -store: El nombre de la tienda que lo manda 
	 * -message: EL mensaje que va a mandar
	 * -user: El nombre de usuario al que se le va a mandar
	 */
    function send_notif(){
		//Si viene desde la página
		
		if(sizeof($this->input->post()) > 0){
			//$title = $this->input->post("title");
			$message = $this->input->post("msg");
			$user = $this->input->post("user");
			$id = $this->input->post("id");
			$this->Api_model->saveNotification($message, $id);
			//Falta agregar unas cosas para que agregue la notificación a la bd.
		}
		//Si viene desde la app, para recargas
		else{
			$data = json_decode(file_get_contents('php://input'));
			$title = $data->title;
			$message = $data->msg;
			$client = $data->id_cliente;
			$datosCliente = $this->getUserByIdClient($client);
			$user = $datosCliente->nombre;
			$user_id = $datosCliente->id;
			$notificacion = array(
				'titulo'=>$title,
				'mensaje'=>$message,
				'estatus'=>1,
				'id_usuario'=>$user_id
			);
			$this->storeNotification($notificacion);
		}
        $content = array(
			"en" => "${message}",
			"es" => "${message}"
        );

        $fields = array(
			'app_id' => "9ba5748e-6561-4bdf-8c4c-77d4766fbde8",
            'filters' => array(array("field" => "tag", "key" => "email", "relation" => "=", "value" => "$user")),
			'contents' => $content,
			'priority' => '10',
			'android_channel_id' => '2d85d014-c228-47af-bed2-f7b47dc94f56'
		);
		$fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NDUxNTQ0OTItYmJmOS00ZDVhLWFjYjUtYzE2Mzg5YzkwODAy'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
       return $response;
	}
	
	public function getNotifications(){
		if($this->perfil == CLIENTE){
			$id_usuario = $this->input->get('id');
			echo json_encode($this->Api_model->getNotifications($id_usuario));
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function deleteNotifications(){
		if($this->perfil == CLIENTE){
			$idsNotif_str = $this->input->get('ids');
			$ids = explode(",", $idsNotif_str);
			$this->Api_model->deleteNotifications($ids);
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function recargarSaldo(){
		if($this->perfil == EMPLEADO){
			$data = json_decode(file_get_contents('php://input'))[0];
			$dataPin = array('user_id'=>$data->id_empleado, 'pin'=>$data->pin);
			$dataRecarga = array('id_cliente'=>$data->id_cliente, 'monto'=>$data->monto,'id_empleado'=>$data->id_empleado);
			if($this->verificarPin($dataPin)){
				echo json_encode($this->Api_model->recargarSaldo($dataRecarga));
			}
			else{
				echo json_encode("Pin incorrecto, por favor intente de nuevo.");
			}
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function verificarPin($data){
		return $this->Api_model->verificar_pin($data['pin'], $data['user_id']);
	}

	public function getHistorialRecargas(){
		if($this->perfil == EMPLEADO){
			$data = json_decode(file_get_contents('php://input'));
			echo json_encode($this->Api_model->get_historial_recargas($data->id_empleado, $data->limit,$data->offset));
		}
		else{
			$this->printProhibitedAccess();
		}
	}

	public function getUserByIdClient($id_cliente){
		return $this->Api_model->getUserByIdClient($id_cliente);
	}

	public function storeNotification($data){
		$this->Api_model->storeNotification($data);
	}

	public function isThereAnEvent(){
		date_default_timezone_set('America/Mazatlan');
		$date = date('Y-m-d H:i:s', time());
		$datos = $this->Api_model->isThereAnEvent($date);
		if(empty($datos)){
			echo -1;
		}
		else{
			echo $datos->id;
		}
	}

	public function printProhibitedAccess(){
		echo "No tiene permisos para acceder a este enlace.";
	}
}
