<?php

	namespace LEANGA;
	use PDOStatement;
	use PDO;
	use LEANGA\LEANGAException;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	use LEANGA\Handler_User;
	
	class Handler_Session
	{

		private $session;
		private $headers;
		private $post;
		private $get;
		private $hdb;
		private $token;
		private $def = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
		private $alphabet= "87eqoJu2pgQRYF4kN-rysIbBSaOEzV3xT0iwWDCUtv9fZLXnlAjH16MmPGK_dc5h";
		
		public function __construct(){
			$this->hdb 		= Handler_Database::getInstance();
			$this->post		= $_POST;
			$this->get		= $_GET;
			$this->session	= $_SESSION;
			$this->headers	= apache_request_headers();
		}
		
		public function returnUser(){
			if(array_key_exists('session',$this->session)){
				$user = $this->sessionLogin();
			}else if(array_key_exists('Intent',$this->headers)){
				$user = $this->headerLogin();
			}else if(array_key_exists('token',$this->post)){
			
			
			}else if(array_key_exists('token',$this->get)){
			
			
			}else{
				$user = new Handler_User(null);
			}
			return $user;
		}
		
		private function decodeString($string){
			$encoded = strtr($string, $this->alphabet,  $this->def);
			return base64_decode($encoded);
		}
		
		public function getToken(){
			return $this->token;
		}
		
		
		private function findMobileID(){

			$fields=array(
				Handler_SQLBuilder::OPERATOR_EQUAL => Array(
					//Handler_SQLBuilder::TABLE_DEVICES_IMEI		=>	$this->decodeString($this->headers['Authim']),
					Handler_SQLBuilder::TABLE_DEVICES_UNIQUEID	=>	$this->decodeString($this->headers['Authdid']),
					Handler_SQLBuilder::TABLE_DEVICES_BRAND		=>	$this->decodeString($this->headers['Authbr']),
					Handler_SQLBuilder::TABLE_DEVICES_MODEL		=>	$this->decodeString($this->headers['Authmo']),
					Handler_SQLBuilder::TABLE_DEVICES_OS		=>	$this->decodeString($this->headers['Authos']),
					Handler_SQLBuilder::TABLE_DEVICES_VERSION	=>	$this->headers['Authvc'],
					Handler_SQLBuilder::TABLE_DEVICES_SERIAL	=>	$this->decodeString($this->headers['Authsr']),
					Handler_SQLBuilder::TABLE_DEVICES_FINGERPRINT=>	$this->decodeString($this->headers['Authfp'])
				)
			);

			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_DEVICES);
			$query->where($fields);
			
			if($client=$this->hdb->selectTable($query)){
				$upt = array(
					Handler_SQLBuilder::TABLE_DEVICES_LAST_ONLINE => time(),
					Handler_SQLBuilder::TABLE_DEVICES_GOOGLE_ID	=>	$this->decodeString($this->headers['Googleid'])
				);
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_DEVICES,$upt);
				$query->where($fields);
				$this->hdb->updateTable($query);
				$client = $client->fetch(PDO::FETCH_ASSOC);
				return $client['id'];
			}else{
				$fields=$fields[Handler_SQLBuilder::OPERATOR_EQUAL];
				$fields[Handler_SQLBuilder::TABLE_DEVICES_LAST_ONLINE] = time();
				$fields[Handler_SQLBuilder::TABLE_DEVICES_GOOGLE_ID] = $this->decodeString($this->headers['Googleid']);
				$query = new Handler_SQLBuilder($this->hdb);
				$query->insert(Handler_SQLBuilder::TABLE_DEVICES,$fields);
				return $this->hdb->insertTable($query);
			}

		}
		
		private function headerLogin(){
			$device_id = $this->findMobileID();
			switch($this->headers['Intent']){
				case 'login':
					$user = $this->decodeString($this->headers['User']);
					$pass = $this->decodeString($this->headers['Pass']);
					$where = array(
						Handler_SQLBuilder::OPERATOR_EQUAL => Array(
							Handler_SQLBuilder::TABLE_USERS_USER => $user
						)
					);
					$query = new Handler_SQLBuilder($this->hdb);
					$query->select(Handler_SQLBuilder::TABLE_USERS);
					$query->where($where);	
					
					if($user=$this->hdb->selectTable($query)){
						$usr = $user->fetch(PDO::FETCH_ASSOC);
						$password = $usr['password'];
						$old_token = $usr['token'];
						if(password_verify($pass,$password)){
							$user = new Handler_User($this->hdb->selectTable($query));
							
							$token = time()."_".password_hash(time().$old_token.$device_id,PASSWORD_DEFAULT);
							
							$where = array(
								Handler_SQLBuilder::OPERATOR_EQUAL => Array(
									Handler_SQLBuilder::TABLE_USER_DEVICE_DEVICE	=>	$device_id
								)
							);
							
							$fields = array(
								Handler_SQLBuilder::TABLE_USER_DEVICE_ACTIVE	=>	0,
								Handler_SQLBuilder::TABLE_USER_DEVICE_LOGGED_OUT=>	time()
							);
							
							$query = new Handler_SQLBuilder($this->hdb);
							$query->update(Handler_SQLBuilder::TABLE_USER_DEVICE,$fields);
							$query->where($where);
							
							$this->hdb->updateTable($query);
							
							$fields = array(
								Handler_SQLBuilder::TABLE_USER_DEVICE_DEVICE	=>	$device_id,
								Handler_SQLBuilder::TABLE_USER_DEVICE_USER		=>	$user->getID(),
								Handler_SQLBuilder::TABLE_USER_DEVICE_TOKEN		=>	$token,
								Handler_SQLBuilder::TABLE_USER_DEVICE_ACTIVE	=>	1,
								Handler_SQLBuilder::TABLE_USER_DEVICE_LOGGED_IN	=>	time()
							);
							error_log(print_r($fields,1));
							$query = new Handler_SQLBuilder($this->hdb);
							$query->insert(Handler_SQLBuilder::TABLE_USER_DEVICE,$fields);
							
							$this->hdb->insertTable($query);
							$this->token = $token;
							return $user;
						}else{
							return new Handler_User(null);
						}
					}else{
						return new Handler_User(null);
					}
					break;
				case 'request':
					$token = $this->decodeString($this->headers['Token']);
					$where = array(
						Handler_SQLBuilder::OPERATOR_EQUAL => Array(
							Handler_SQLBuilder::TABLE_USER_DEVICE_TOKEN => $token,
							Handler_SQLBuilder::TABLE_USER_DEVICE_ACTIVE=>	1,
							Handler_SQLBuilder::TABLE_USER_DEVICE_DEVICE=>	$device_id
						)
					);
					$query = new Handler_SQLBuilder($this->hdb);
					$query->select(Handler_SQLBuilder::TABLE_USER_DEVICE,array('c'=>Handler_SQLBuilder::ALL));
					$query->leftJoin(Handler_SQLBuilder::TABLE_USERS,array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=> array(
							Handler_SQLBuilder::TABLE_USERS_ID	=> Handler_SQLBuilder::TABLE_USER_DEVICE_USER
						)
					),'a');
					$query->where($where,'a');
					if($user = $this->hdb->selectTable($query)){
						return new Handler_User($user);
					}else{
						return new Handler_User(null);
					}
					break;
			}
		
			$device_id = findMobileID();
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_USERS);
		
			
		}
		
		private function sessionLogin(){
			$where = Array(
				Handler_SQLBuilder::OPERATOR_EQUAL => Array(
					Handler_SQLBuilder::TABLE_USERS_TOKEN => $this->session['session']
				)
			);
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_USERS);
			$query->where($where);
			if($users=$this->hdb->selectTable($query))
				return new Handler_User($users);
			else
				return new Handler_User(null);
		}
		
	}
?>