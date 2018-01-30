<?php

	namespace LEANGA;
	use PDO;
	use LEANGA\LEANGAException;
	use LEANGA\Handler_SQLBuilder;
	
	class Handler_Database extends PDO
	{ 

		private $driver		=	'mysql';
		private $host		=	'localhost';
		private $dbname		=	'teresadelaparra';
		private $user		=	'root';
		private $pass		=	'';
		private $chatset	=	'utf8';
		private $sql;
		

		public static $INSTANCE = null;
		
		
		public static function getInstance(){
			if(null === self::$INSTANCE)
				self::$INSTANCE = new Handler_Database();
			return self::$INSTANCE;
		}
		
		public function getLastQuery(){
			return $this->sql;
		}
		
		public function __construct($options = array()) {
			$dsn = "{$this->driver}:dbname={$this->dbname};host={$this->host};chatset={$this->chatset}";
			try {
				parent::__construct ( $dsn, $this->user, $this->pass, $options );
			} catch ( PDOLEANGAException $ex ) {
				throw new LEANGAException($ex->getCode(), $ex->getMessage()); 
			}
		}
		
		private function runQuery($sql){
			$this->sql=$sql;
			if($result=$this->query($this->sql))
				return $result;
			else if($this->errorCode()){
				echo $this->sql;
				throw new LEANGAException(implode(" ",$this->errorInfo())); 
			}
		}
		
		public function deleteTable(Handler_SQLBuilder $query){
			return $this->runQuery($query->getSQL());
		}
		  
		public function selectTable(Handler_SQLBuilder $query){
			$result=$this->runQuery($query->getSQL());
			if($result->rowCount()>0)
				return $result;
			else
				return false;
		}
		
		public function updateTable(Handler_SQLBuilder $query){
			$stmt=$this->prepare($query->getSQL());
			if($stmt->execute(array_values($query->getValues()))){
				return true;
			}
			else if($this->errorCode()){
				throw new LEANGAException(implode(" ",$this->errorInfo())); 
			}else return false;
		}
		
		public function insertTable(Handler_SQLBuilder $query){
			$stmt=$this->prepare($query->getSQL());
			if($stmt->execute(array_values($query->getValues()))){
				return $this->lastInsertId();
			}
			else if($stmt->errorCode()){
				throw new LEANGAException(implode(" ",$stmt->errorInfo())); 
			}else return false;
		}

	
	
	}
?>