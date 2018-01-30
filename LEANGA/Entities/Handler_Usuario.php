<?php

	namespace LEANGA\Entities;

	use LEANGA\Handler_HTTP;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	use LEANGA\Handler_User;
	use LEANGA\LEANGAException;
	use PDO;
	
	class Handler_Usuario extends Handler_HTTP
	{
		private $hdb;
		private $user;
		
		
		
		public function __construct(Handler_User $user, Handler_Database $hdb)
		{
			parent::__construct();
			$this->user = $user;
			$this->hdb = $hdb;
		}
		
		public function getSingle(array $params = null){
			if(!$params)
				if($this->method == 'GET')
					$params = $this->get;
				else
					throw new LEANGAException("No parameters found to match this action"); 
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_USERS);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			
			switch($filter){
				case 'i':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_USERS_ID	=>	$params['term']
						)			   
					));
					break;
				case 'u':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_USERS_USER	=>	$params['term']
						)			   
					));
					break;
				default:
					throw new LEANGAException("You need to apply a filther to use this endpoint"); 
					break;
			}
			
			if($res = $query->commit()){
				$re = $res->fetch(PDO::FETCH_ASSOC);
				$return = array('e'=>0,
					'usuario'=>array(
						'id'	=>	$re['id'],
						'user'	=>	$re['user'],
						'nombre'	=>	$re['nombre'],
						'tipo'	=>	$re['tipo']
					)
				);
				return $return;
			}else
				return false;
		}
		
		public function insert(array $params = null){
			if(!$params)
				if($this->method == 'POST')
					$params = $this->post;
				else
					throw new LEANGAException("No parameters found to match this action");
				
			if(!$this->user->isAdmin() && !$this->user->isEmpleado())
				throw new LEANGAException("You don't have the needed permissions to perform this action");	
			
			
			if($this->getSingle(array('filter'=>'u','term'=>$params['user'])))
				return array('e'=>2);	
			
			$fields = array(
				Handler_SQLBuilder::TABLE_USERS_USER		=>	$params['user'],	
				Handler_SQLBuilder::TABLE_USERS_NOMBRE		=>	$params['nombre'],
				Handler_SQLBuilder::TABLE_USERS_PASSWORD	=>	password_hash($params['password'],PASSWORD_DEFAULT),
				Handler_SQLBuilder::TABLE_USERS_TIPO			=>	$params['tipo'],		
			);
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->insert(Handler_SQLBuilder::TABLE_USERS,$fields);
			if($id = $query->commit())
				return array('e'=>0,'id'=>$id);
			else
				return false;
			
		}
		
		public function get(array $params = null){
			if(!$params)
				if($this->method == 'GET')
					$params = $this->get;
				else
					throw new LEANGAException("No parameters found to match this action"); 
			
			if(!$this->user->isAdmin() && !$this->user->isEmpleado())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_USERS);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			$where = false;
			switch($filter){
				case 'u':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_USERS_USER	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 'n':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_USERS_NOMBRE	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 't':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_USERS_TIPO	=>	"{$params['term']}%"
						)			   
					);
					break;
				default:
					break;
			}
			if(is_array($where))
				$query->where($where);
			$query->limit(array($params['start'],$params['max']));
			if($res = $query->commit()){
				$query = new Handler_SQLBuilder($this->hdb);
				$query->count(Handler_SQLBuilder::TABLE_USERS);
				if(is_array($where))
					$query->where($where);
				$count = $query->commit();
				$count = $count->fetch(PDO::FETCH_ASSOC);
				$count = $count['count'];
				$return = array('e'=>0,'usuarios'=>array(),'total'=>$count);
				while($re = $res->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
					$return['usuarios'][]=array(
						'id'	=>	$re['id'],
						'user'	=>	$re['user'],
						'nombre'	=>	$re['nombre'],
						'tipo'	=>	$re['tipo']
					);
				}
				return $return;
			}else
				return false;
		}
		
		public function update(array $params = null){
			if(!$params)
				if($this->method == 'PUT')
					$params = $this->put;
				else
					throw new LEANGAException("No parameters found to match this action");

			
			if(!$this->user->isAdmin() && !$this->user->isEmpleado())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
				
			if($client = $this->getSingle(array('filter'=>'i','term'=>$params['id']))){
				
				if(($t = $this->getSingle(array('filter'=>'u','term'=>$params['user']))) && $t['usuario']['id']!=$params['id']){
					return array('e'=>2);
				}
				
			
				$fields = array(
					Handler_SQLBuilder::TABLE_USERS_USER	=>	$params['user'],	
					Handler_SQLBuilder::TABLE_USERS_NOMBRE	=>	$params['nombre'],
					Handler_SQLBuilder::TABLE_USERS_PASSWORD	=>	password_hash($params['password'],PASSWORD_DEFAULT),
					Handler_SQLBuilder::TABLE_USERS_TIPO	=>	$params['tipo'],
				);
				
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_USERS,$fields);
				$query->where(array(
					Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
						Handler_SQLBuilder::TABLE_USERS_ID =>	$params['id']
					)
				));
				if($query->commit())
					return array('e'=>0,'id'=>$params['id']);
				else return false;
			}
			return false;
		}
		
		public function delete(array $params = null){
			if(!$params)
				if($this->method == 'DELETE')
					$params = $this->delete;
				else
					throw new LEANGAException("No parameters found to match this action");
			
			if(!$this->user->isAdmin())
				throw new LEANGAException("You don't have the needed permissions to perform this action");	
				
			$query = new Handler_SQLBuilder($this->hdb);
			$query->delete(Handler_SQLBuilder::TABLE_USERS);
			$query->where(array(
				Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
					Handler_SQLBuilder::TABLE_USERS_ID =>	$params['id']
				)
			));
			$query->commit();
			
			return array('e'=>0, 'id'=>$params['id']);
		}
		
		public function autoRun(){
			switch($this->method){
				case 'DELETE':
					return $this->delete();
				case 'GET':
					return $this->get();
				case 'POST':
					return $this->insert();
				case 'PUT':
					return $this->update();
			}
		}
		
	}
?>