<?php

	namespace LEANGA\Entities;

	use LEANGA\Handler_HTTP;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	use LEANGA\Handler_User;
	use LEANGA\LEANGAException;
	use PDO;
	
	class Handler_Familia extends Handler_HTTP
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
			$query->select(Handler_SQLBuilder::TABLE_FAMILIA);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			
			switch($filter){
				case 'i':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_FAMILIA	=>	$params['term']
						)			   
					));
					break;
				case 'e':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_ESTUDIANTE	=>	$params['term']
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
					'familia'=>array(
						'id_familia'	=>	$re['id_familia'],
						'id_estudiante'	=>	$re['id_estudiante'],
						'id_madre'		=>	$re['id_madre'],
						'id_padre'		=>	$re['id_padre'],
						'id_rl'			=>	$re['id_rl'],
						'id_salud'		=>	$re['id_salud'],
						'repre_permiso_cepna'		=>	$re['repre_permiso_cepna'],
						'repre_pq_otra_persona'		=>	$re['repre_pq_otra_persona'],
						'repre_parentesco'		=>	$re['repre_parentesco'],
						'repre_llamar_emergencia'		=>	$re['repre_llamar_emergencia'],
						'repre_telefono_emergencia'		=>	$re['repre_telefono_emergencia']
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
				
			if(!$this->user->isLogged())
				throw new LEANGAException("You don't have the needed permissions to perform this action");	
			
			
			if($this->getSingle(array('filter'=>'i','term'=>$params['id_estudiante'])))
				return array('e'=>2);	
			error_log(print_r($params,1));
			
			$fields = array(
					Handler_SQLBuilder::TABLE_FAMILIA_ID_ESTUDIANTE		=>	$params['id_estudiante'],	
					Handler_SQLBuilder::TABLE_FAMILIA_ID_MADRE		=>	$params['id_madre'],
					Handler_SQLBuilder::TABLE_FAMILIA_ID_PADRE			=>	$params['id_padre'],
					Handler_SQLBuilder::TABLE_FAMILIA_ID_RL		=>	$params['id_rl'],
			);
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->insert(Handler_SQLBuilder::TABLE_FAMILIA,$fields);
			if($id = $query->commit())
				return array('e'=>0,'id_familia'=>$id);
			else
				return false;
		}
		
		public function get(array $params = null){
			if(!$params)
				if($this->method == 'GET')
					$params = $this->get;
				else
					throw new LEANGAException("No parameters found to match this action"); 
			
			if(!$this->user->isLogged())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->select(Handler_SQLBuilder::TABLE_FAMILIA);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			$where = false;
			switch($filter){
				case 'i':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_FAMILIA	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 'e':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_ESTUDIANTE	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 'm':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_MADRE	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 'p':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_PADRE	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 'rl':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_RL	=>	"{$params['term']}%"
						)			   
					);
				case 's':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_FAMILIA_ID_SALUD	=>	"{$params['term']}%"
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
				$query->count(Handler_SQLBuilder::TABLE_FAMILIA);
				if(is_array($where))
					$query->where($where);
				$count = $query->commit();
				$count = $count->fetch(PDO::FETCH_ASSOC);
				$count = $count['count'];
				$return = array('e'=>0,'familias'=>array(),'total'=>$count);
				while($re = $res->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
					$return['familias'][]=array(		
						'id_familia'	=>	$re['id_familia'],
						'id_estudiante'	=>	$re['id_estudiante'],
						'id_madre'		=>	$re['id_madre'],
						'id_padre'		=>	$re['id_padre'],
						'id_rl'			=>	$re['id_rl'],
						'id_salud'		=>	$re['id_salud'],
						'repre_permiso_cepna'		=>	$re['repre_permiso_cepna'],
						'repre_pq_otra_persona'		=>	$re['repre_pq_otra_persona'],
						'repre_parentesco'		=>	$re['repre_parentesco'],
						'repre_llamar_emergencia'		=>	$re['repre_llamar_emergencia'],
						'repre_telefono_emergencia'		=>	$re['repre_telefono_emergencia']
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

			
			if(!$this->user->isLogged())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
				
			if($client = $this->getSingle(array('filter'=>'i','term'=>$params['id_familia']))){
				
				$fields = array(
				Handler_SQLBuilder::TABLE_FAMILIA_ID_SALUD	=>	$params['id_salud'],
				);
				
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_FAMILIA,$fields);
				$query->where(array(
					Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
						Handler_SQLBuilder::TABLE_FAMILIA_ID_FAMILIA =>	$params['id_familia']
					)
				));
				if($query->commit())
					return array('e'=>0,'id_familia'=>$params['id_familia']);
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
			$query->delete(Handler_SQLBuilder::TABLE_FAMILIA);
			$query->where(array(
				Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
					Handler_SQLBuilder::TABLE_FAMILIA_ID_FAMILIA =>	$params['id_familia']
				)
			));
			$query->commit();
			
			return array('e'=>0, 'id_familia'=>$params['id_familia']);
		}
		
		//Repre Legal

		public function repre_legal_update(array $params = null){
			if(!$params)
				if($this->method == 'PUT')
					$params = $this->put;
				else
					throw new LEANGAException("No parameters found to match this action");

			
			if(!$this->user->isLogged())
				throw new LEANGAException("You don't have the needed permissions to perform this action");
				
			if($client = $this->getSingle(array('filter'=>'i','term'=>$params['id_familia']))){
				
				$fields = array(
				
				Handler_SQLBuilder::TABLE_FAMILIA_REPRE_PERMISO_CEPNA		=>	$params['repre_permiso_cepna'],		
				Handler_SQLBuilder::TABLE_FAMILIA_REPRE_PQ_OTRA_PERSONA		=>	$params['repre_pq_otra_persona'],		
				Handler_SQLBuilder::TABLE_FAMILIA_REPRE_PARENTESCO		=>	$params['repre_parentesco'],		
				Handler_SQLBuilder::TABLE_FAMILIA_REPRE_LLAMAR_EMERGENCIA		=>	$params['repre_llamar_emergencia'],	
				Handler_SQLBuilder::TABLE_FAMILIA_REPRE_TELEFONO_EMERGENCIA		=>	$params['repre_telefono_emergencia'],
				);
				
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_FAMILIA,$fields);
				$query->where(array(
					Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
						Handler_SQLBuilder::TABLE_FAMILIA_ID_FAMILIA =>	$params['id_familia']
					)
				));
				if($query->commit())
					return array('e'=>0,'id_familia'=>$params['id_familia']);
				else return false;
			}
			return false;
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