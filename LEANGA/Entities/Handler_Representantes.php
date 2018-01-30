<?php

	namespace LEANGA\Entities;

	use LEANGA\Handler_HTTP;
	use LEANGA\Handler_Database;
	use LEANGA\Handler_SQLBuilder;
	use LEANGA\Handler_User;
	use LEANGA\LEANGAException;
	use PDO;
	
	class Handler_Representantes extends Handler_HTTP
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
			$query->select(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			
			switch($filter){
				case 'i':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID	=>	$params['term']
						)			   
					));
					break;
				case 'c':
					$query->where(array(
						Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CI	=>	$params['term']
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
					'representante'=>array(
						'repre_id'			=>	$re['repre_id'],
						'repre_apellido'	=>	$re['repre_apellido'],
						'repre_nombre'		=>	$re['repre_nombre'],
						'repre_ci'			=>	$re['repre_ci'],
						'repre_nacionalidad'	=>	$re['repre_nacionalidad'],
						'repre_estado'		=>	$re['repre_estado'],
						'repre_municipio'	=>	$re['repre_municipio'],
						'repre_ciudad'		=>	$re['repre_ciudad'],
						'repre_fechaN'		=>	$re['repre_fechaN'],
						'repre_estado_civil'	=>	$re['repre_estado_civil'],
						'repre_direccion'	=>	$re['repre_direccion'],
						'repre_telefono_casa'	=>	$re['repre_telefono_casa'],
						'repre_celular'		=>	$re['repre_celular'],
						'repre_viveCon_hijo'	=>	$re['repre_viveCon_hijo'],
						'repre_nivel_educacion'	=>	$re['repre_nivel_educacion'],
						'repre_titulo'		=>	$re['repre_titulo'],
						'repre_trabajo'		=>	$re['repre_trabajo'],
						'repre_direccion_trabajo'	=>	$re['repre_direccion_trabajo'],
						'repre_telefono_trabajo'	=>	$re['repre_telefono_trabajo'],
						'repre_ingreso_mensual'		=>	$re['repre_ingreso_mensual'],
						'repre_status'		=>	$re['repre_status']
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
			
			
			if($this->getSingle(array('filter'=>'c','term'=>$params['repre_ci'])))
				return array('e'=>2);	
			
			/*error_log(print_r($params,1));
			$dob = explode('-',$params['repre_fechaN']);
			$day = $dob[0];
			$month = $dob[1];
			$year = $dob[2];
			
			
			$timestamp = strtotime($params['hijo_fechaN']);
			$ya = time();
			$diferencia = $ya - $timestamp;
			$edad = round($diferencia/31536000);
			
			error_log(print_r($edad,1));*/
				
			$fields = array(
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_APELLIDO		=>	$params['repre_apellido'],	
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_NOMBRE		=>	$params['repre_nombre'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CI			=>	$params['repre_ci'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_NACIONALIDAD		=>	$params['repre_nacionalidad'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO		=>	$params['repre_estado'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_MUNICIPIO	=>	$params['repre_municipio'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CIUDAD		=>	$params['repre_ciudad'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_FECHAN			=>	$params['repre_fechaN'],			
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO_CIVIL	=>	$params['repre_estado_civil'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION	=>	$params['repre_direccion'],	
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_CASA	=>	$params['repre_telefono_casa'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CELULAR		=>	$params['repre_celular'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_VIVECON_HIJO		=>	$params['repre_viveCon_hijo'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_NIVEL_EDUCACION	=>	$params['repre_nivel_educacion'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TITULO		=>	$params['repre_titulo'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TRABAJO		=>	$params['repre_trabajo'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION_TRABAJO	=>	$params['repre_direccion_trabajo'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_TRABAJO	=>	$params['repre_telefono_trabajo'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_INGRESO_MENSUAL		=>	$params['repre_ingreso_mensual'],	
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_STATUS		=>	$params['repre_status'],	
			);
			
			$query = new Handler_SQLBuilder($this->hdb);
			$query->insert(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES,$fields);
			if($id = $query->commit())
				return array('e'=>0,'repre_id'=>$id);
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
			$query->select(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
			$filter = array_key_exists('filter',$params) ? $params['filter'] : '';
			$where = false;
			switch($filter){
				case 'i':
					$where=array(
						Handler_SQLBuilder::OPERATOR_LIKE	=>	array(
							Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID	=>	"{$params['term']}%"
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
				$query->count(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
				if(is_array($where))
					$query->where($where);
				$count = $query->commit();
				$count = $count->fetch(PDO::FETCH_ASSOC);
				$count = $count['count'];
				$return = array('e'=>0,'representantes'=>array(),'total'=>$count);
				while($re = $res->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
					$return['representantes'][]=array(		
						'repre_id'			=>	$re['repre_id'],
						'repre_apellido'	=>	$re['repre_apellido'],
						'repre_nombre'		=>	$re['repre_nombre'],
						'repre_ci'			=>	$re['repre_ci'],
						'repre_nacionalidad'	=>	$re['repre_nacionalidad'],
						'repre_estado'		=>	$re['repre_estado'],
						'repre_municipio'	=>	$re['repre_municipio'],
						'repre_ciudad'		=>	$re['repre_ciudad'],
						'repre_fechaN'		=>	$re['repre_fechaN'],
						'repre_estado_civil'	=>	$re['repre_estado_civil'],
						'repre_direccion'	=>	$re['repre_direccion'],
						'repre_telefono_casa'	=>	$re['repre_telefono_casa'],
						'repre_celular'		=>	$re['repre_celular'],
						'repre_viveCon_hijo'	=>	$re['repre_viveCon_hijo'],
						'repre_nivel_educacion'	=>	$re['repre_nivel_educacion'],
						'repre_titulo'		=>	$re['repre_titulo'],
						'repre_trabajo'		=>	$re['repre_trabajo'],
						'repre_direccion_trabajo'	=>	$re['repre_direccion_trabajo'],
						'repre_telefono_trabajo'	=>	$re['repre_telefono_trabajo'],
						'repre_ingreso_mensual'		=>	$re['repre_ingreso_mensual'],
						'repre_status'		=>	$re['repre_status']
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
				
			if($client = $this->getSingle(array('filter'=>'i','term'=>$params['repre_id']))){
				
				$fields = array(
				
				Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_APELLIDO		=>	$params['repre_apellido'],	
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_NOMBRE		=>	$params['repre_nombre'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CI			=>	$params['repre_ci'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_NACIONALIDAD		=>	$params['repre_nacionalidad'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO		=>	$params['repre_estado'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_MUNICIPIO	=>	$params['repre_municipio'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CIUDAD		=>	$params['repre_ciudad'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_FECHAN			=>	$params['repre_fechaN'],			
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ESTADO_CIVIL	=>	$params['repre_estado_civil'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION	=>	$params['repre_direccion'],	
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_CASA	=>	$params['repre_telefono_casa'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_CELULAR		=>	$params['repre_celular'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_VIVECON_HIJO		=>	$params['repre_viveCon_hijo'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_NIVEL_EDUCACION	=>	$params['repre_nivel_educacion'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TITULO		=>	$params['repre_titulo'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TRABAJO		=>	$params['repre_trabajo'],		
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_DIRECCION_TRABAJO	=>	$params['repre_direccion_trabajo'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_TELEFONO_TRABAJO	=>	$params['repre_telefono_trabajo'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_INGRESO_MENSUAL		=>	$params['repre_ingreso_mensual'],
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_STATUS		=>	$params['repre_status'],	
				);
				
				$query = new Handler_SQLBuilder($this->hdb);
				$query->update(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES,$fields);
				$query->where(array(
					Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
						Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID =>	$params['repre_id']
					)
				));
				if($query->commit())
					return array('e'=>0,'repre_id'=>$params['repre_id']);
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
			$query->delete(Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES);
			$query->where(array(
				Handler_SQLBuilder::OPERATOR_EQUAL	=>	array(
					Handler_SQLBuilder::TABLE_REGISTRO_REPRESENTANTES_REPRE_ID =>	$params['repre_id']
				)
			));
			$query->commit();
			
			return array('e'=>0, 'repre_id'=>$params['repre_id']);
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