<?php

	namespace LEANGA;
	use PDOStatement;
	use PDO;
	use LEANGA\LEANGAException;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	
	class Handler_User
	{

		private $id;
		private $name;
		private $token;
		private $hdb;
		private $logged;
		private $type;
		
		public function __construct($rawUser = null){
			$this->hdb 		= Handler_Database::getInstance();
			if(null!==$rawUser){
				if($rawUser instanceOf PDOStatement){
					$user = $rawUser->fetch(PDO::FETCH_ASSOC);
					$this->id 		= $user['id'];
					$this->name 	= $user['user'];
					$this->token 	= $user['token'];
					$this->type		= $user['tipo'];
					$this->logged 	= true;
					$this->updateLastOnline();
				}else{
					$this->logged 	= false;
					/*$this->id 		= $rawUser;
					$this->type		= 'client';*/
				}
			}else{
				$this->logged 	= false;
			}
		}
		
		private function updateLastOnline(){
			$where = array(
				Handler_SQLBuilder::OPERATOR_EQUAL => Array(
					Handler_SQLBuilder::TABLE_USERS_ID => $this->id,
				)
			);
			$fields = array(
				Handler_SQLBuilder::TABLE_USERS_LAST_ONLINE	=>	time()
			);
			$query = new Handler_SQLBuilder($this->hdb);
			$query->update(Handler_SQLBuilder::TABLE_USERS,$fields);
			$query->where($where);
			$this->hdb->updateTable($query);
		}
		
		public function getID(){
			return $this->id;
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function isLogged(){
			return $this->logged;
		}
		
		public function isRepresentante(){
			return $this->type == 3;
		}
		
		public function isEmpleado(){
			return $this->type == 2;
		}
		
		public function isAdmin(){
			return $this->type == 1;
		}
	
	
	}
?>