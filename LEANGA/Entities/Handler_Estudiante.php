<?php

	namespace LEANGA\Entities;

	use LEANGA\Handler_HTTP;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	use LEANGA\Handler_User;
	use LEANGA\LEANGAException;
	use PDO;
	
	class Handler_Estudiante extends Handler_HTTP
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
			$query->select(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			
			switch($filter){
				case 'i':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ID	=>	$params['term']
						)			   
					));
					break;
				case 'c':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_CEDULA_ESCOLAR	=>	$params['term']
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
					'estudiante'=>array( 
						'hijo_id'		=>	$re['hijo_id'],
						'hijo_apellido'	=>	$re['hijo_apellido'],
						'hijo_nombre'	=>	$re['hijo_nombre'],
						'hijo_nacionalidad'		=>	$re['hijo_nacionalidad'],
						'hijo_peso'		=>	$re['hijo_peso'],
						'hijo_talla'	=>	$re['hijo_talla'],
						'hijo_sexo'		=>	$re['hijo_sexo'],
						'hijo_cedula_escolar'	=>	$re['hijo_cedula_escolar'],
						'hijo_direccion'		=>	$re['hijo_direccion'],
						'hijo_telefono'	=>	$re['hijo_telefono'],
						'hijo_estado'	=>	$re['hijo_estado'],
						'hijo_municipio'		=>	$re['hijo_municipio'],
						'hijo_ciudad'	=>	$re['hijo_ciudad'],
						'dob'		=>	"{$re['hijo_dia']}-{$re['hijo_mes']}-{$re['hijo_anho']}",
						'hijo_nivel'	=>	$re['hijo_nivel']
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
			
			
			if($this->getSingle(array('filter'=>'c','term'=>$params['hijo_cedula_escolar'])))
				return array('e'=>2);	
			error_log(print_r($params,1));
			
			$dob = explode('-',$params['hijo_fechaN']);
			$day = $dob[0];
			$month = $dob[1];
			$year = $dob[2];
			
			$timestamp = strtotime($params['hijo_fechaN']);
			$ya = time();
			$diferencia = $ya - $timestamp;
			$edad = round($diferencia/31536000);
			
			error_log(print_r($edad,1));
			
			$fields = array(
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_APELLIDO		=>	$params['hijo_apellido'],	
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NOMBRE		=>	$params['hijo_nombre'],
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NACIONALIDAD	=>	$params['hijo_nacionalidad'],	
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_PESO		=>	$params['hijo_peso'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_TALLA	=>	$params['hijo_talla'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_SEXO		=>	$params['hijo_sexo'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_CEDULA_ESCOLAR	=>	$params['hijo_cedula_escolar'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_DIRECCION	=>	$params['hijo_direccion'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_TELEFONO		=>	$params['hijo_telefono'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ESTADO		=>	$params['hijo_estado'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_MUNICIPIO	=>	$params['hijo_municipio'],		
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_CIUDAD		=>	$params['hijo_ciudad'],	
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ANHO		=>	$year,
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_MES		=>	$month,
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_DIA		=>	$day,
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NIVEL	=>	$params['hijo_nivel'],			
				Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_STATUS	=>	$params['hijo_status'],		
			);
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->insert(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE,$fields);
			if($id = $query->commit())
				return array('e'=>0,'hijo_id'=>$id);
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
			$query->select(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			$where = false;
			switch($filter){
				case 'a':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_APELLIDO	=>	"{$params['term']}%"
						)			   
					);
					break;
				case 'n':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NOMBRE	=>	"{$params['term']}%"
						)			   
					);
					break;	
				case 'c':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_CEDULA_ESCOLAR	=>	"{$params['term']}%"
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
				$query->count(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE);
				if(is_array($where))
					$query->where($where);
				$count = $query->commit();
				$count = $count->fetch(PDO::FETCH_ASSOC);
				$count = $count['count'];
				$return = array('e'=>0,'estudiantes'=>array(),'total'=>$count);
				while($re = $res->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
					$return['estudiantes'][]=array(		
						'hijo_id'		=>	$re['hijo_id'],
						'hijo_apellido'	=>	$re['hijo_apellido'],
						'hijo_nombre'	=>	$re['hijo_nombre'],
						'hijo_nacionalidad'		=>	$re['hijo_nacionalidad'],
						'hijo_edad'		=>	$re['hijo_edad'],
						'hijo_peso'		=>	$re['hijo_peso'],
						'hijo_talla'	=>	$re['hijo_talla'],
						'hijo_sexo'		=>	$re['hijo_sexo'],
						'hijo_cedula_escolar'	=>	$re['hijo_cedula_escolar'],
						'hijo_direccion'		=>	$re['hijo_direccion'],
						'hijo_telefono'	=>	$re['hijo_telefono'],
						'hijo_estado'	=>	$re['hijo_estado'],
						'hijo_municipio'		=>	$re['hijo_municipio'],
						'hijo_ciudad'	=>	$re['hijo_ciudad'],
						'dob'		=>	"{$re['hijo_dia']}-{$re['hijo_mes']}-{$re['hijo_anho']}",
						'hijo_nivel'	=>	$re['hijo_nivel']
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
				
			if($client = $this->getSingle(array('filter'=>'i','term'=>$params['hijo_id']))){
				
				if(($t = $this->getSingle(array('filter'=>'c','term'=>$params['hijo_cedula_escolar']))) && $t['estudiante']['hijo_id']!=$params['hijo_id']){
					return array('e'=>2);
				}
			
				$dob = explode('-',$params['dob']);
				$day = $dob[0];
				$month = $dob[1];
				$year = $dob[2];			
			
				$fields = array(
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_APELLIDO		=>	$params['hijo_apellido'],	
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NOMBRE		=>	$params['hijo_nombre'],
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NACIONALIDAD	=>	$params['hijo_nacionalidad'],
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_EDAD		=>	$params['hijo_edad'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_PESO		=>	$params['hijo_peso'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_TALLA	=>	$params['hijo_talla'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_SEXO		=>	$params['hijo_sexo'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_CEDULA_ESCOLAR	=>	$params['hijo_cedula_escolar'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_DIRECCION	=>	$params['hijo_direccion'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_TELEFONO		=>	$params['hijo_telefono'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ESTADO		=>	$params['hijo_estado'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_MUNICIPIO	=>	$params['hijo_municipio'],		
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_CIUDAD		=>	$params['hijo_ciudad'],	
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ANHO		=>	$year,
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_MES		=>	$month,
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_DIA		=>	$day,
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_NIVEL	=>	$params['hijo_nivel'],	
				);
				
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE,$fields);
				$query->where(array(
					Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
						Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ID =>	$params['hijo_id']
					)
				));
				if($query->commit())
					return array('e'=>0,'hijo_id'=>$params['hijo_id']);
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
			$query->delete(Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE);
			$query->where(array(
				Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
					Handler_SQLBuilder::TABLE_REGISTRO_ESTUDIANTE_HIJO_ID =>	$params['hijo_id']
				)
			));
			$query->commit();
			
			return array('e'=>0, 'hijo_id'=>$params['hijo_id']);
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