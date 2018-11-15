<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/implementJwt.php';

class Api extends CI_Controller {
	function __construct() {

	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    $method = $_SERVER['REQUEST_METHOD'];
	    if($method == "OPTIONS") {
	        die();
		}
		$this->objOfJwt = new implementJwt();
	    parent::__construct();
	}
	public function index(){
		echo "sirbp";
	}
	public function getStores(){
		$this->load->model('Api_model');
		$stores = $this->api_model->getStores();
		echo json_encode($stores);
		//$json= json_encode($stores);
		//$key = 'SuperSecretKeyss';
		 //To Encrypt: 
		 //echo $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $json , MCRYPT_MODE_ECB); 
		 //To Decrypt: 
		  //echo $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted, MCRYPT_MODE_ECB); 

	}


	public function addUser(){
		$this->load->model('api_model');
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str);
		if($json_obj != ''){
			if(($msg = $this->api_model->addUser($json_obj, true)) == 1){
				$id = $this->getIdByUser($json_obj[0]->nombre);
				$dataToken = array('id' => $id, 
								   'nombre' => $json_obj[0]->nombre);
				$token = $this->objOfJwt->GenerateToken($dataToken);
				$response = array('id' => $id,
							      'nombre' => $json_obj[0]->nombre,
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
		$this->load->model('api_model');
		$id = $this->api_model->getIdByUser($user)->id;
		return $id;
	}

	public function decodeToken(){
		$json_str = file_get_contents('php://input');
		echo json_encode($this->objOfJwt->DecodeToken($json_str));
	}

	public function login(){
		$this->load->model('api_model');
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str);
		if($json_obj != ''){
			$data = $this->api_model->getUser($json_obj);
			if (!(isset($data['code']))){
				$dataToken = array('id' => $data['id'], 
								   'nombre' => $data['nombre']);
				$token = $this->objOfJwt->GenerateToken($dataToken);
				$response = array('id' => $data['id'],
							      'nombre' => $data['nombre'],
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


	public function getProducts()
	{
		$id = $this->input->get('id');
		$this->load->model('api_model');
		$productos = $this->api_model->getProductos($id);
		echo json_encode($productos);
		//$this->load->view('welcome_message');
	}

	public function addPedido(){
		$this->load->model('api_model');
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str);
		echo $this->api_model->addPedido($json_obj, true);
	}

	/**
     * Create New Notification
     *
     * Creates adjacency list based on item (id or slug) and shows leafs related only to current item
     *
     * @param int $user_id Current user id
     * @param string $title Current title
     *
     * @return string $response
     */
    function send_notif(){
        $message = $this->input->post("msg");
		$user = $this->input->post("user");
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
}
