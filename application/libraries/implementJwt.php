<?php 
	require APPPATH . '/libraries/JWT.php';
	/**
	 * 
	 */
	class implementJwt
	{
		private $key = "ADQWDWLD6DW46D5QD$!#ASDADSDA989789561231879879";
		public function GenerateToken($data){
			return JWT::encode($data, $this->key);
		}

		public function DecodeToken($jwt){
			return JWT::decode($jwt, $this->key,array('HS256'));
		}
	}
 ?>