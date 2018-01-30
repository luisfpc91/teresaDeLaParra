<?php
	require_once("../LEANGA/autoload.php");
	
	use LEANGA\Handler_Database;
	use LEANGA\Handler_User;
	use LEANGA\Handler_Session;
	use LEANGA\Entities\Handler_Usuario;
	use LEANGA\Entities\Handler_Estudiante;
	use LEANGA\Entities\Handler_Representantes;
	use LEANGA\Entities\Handler_Salud;
	use LEANGA\Entities\Handler_Familia;
	use LEANGA\Entities\Handler_Reportes;
	
	
	$page=$_GET['a'];
	$format=$_GET['t'];
	session_start();
	if($db=Handler_Database::getInstance()){
		$hs = new Handler_Session();
		$user = $hs->returnUser();
		if($user->isLogged()){
			switch($page){
				case 'usuarios':
					$usuario = new Handler_Usuario($user,$db);
					$return = $usuario->autoRun();
					if(!$return)
						$return = array('e'=>1);
					break;
				case 'estudiante':
					$usuario = new Handler_Estudiante($user,$db);
					$return = $usuario->autoRun();
					if(!$return)
						$return = array('e'=>1);
					break;
				case 'hijoSingle':
					$usuario = new Handler_Estudiante($user,$db);
					$return = $usuario->getSingle();
					if(!$return)
						$return = array('e'=>1);
					break;	
				case 'representante':
					$usuario = new Handler_Representantes($user,$db);
					$return = $usuario->autoRun();
					if(!$return)
						$return = array('e'=>1);
					break;
				case 'repreSingle':
					$usuario = new Handler_Representantes($user,$db);
					$return = $usuario->getSingle();
					if(!$return)
						$return = array('e'=>1);
					break;	
				case 'rl_update':
					$usuario = new Handler_Familia($user,$db);
					$return = $usuario->repre_legal_update();
					if(!$return)
						$return = array('e'=>1);
					break;			
				case 'familia':
					$usuario = new Handler_Familia($user,$db);
					$return = $usuario->autoRun();
					if(!$return)
						$return = array('e'=>1);
					break;
				case 'familiaSingle':
					$usuario = new Handler_Familia($user,$db);
					$return = $usuario->getSingle();
					if(!$return)
						$return = array('e'=>1);
					break;		
				case 'salud':
					$usuario = new Handler_Salud($user,$db);
					$return = $usuario->autoRun();
					if(!$return)
						$return = array('e'=>1);
					break;	
				default:
					http_response_code(204);
					$return=array('e'=>-1);
					break;
			}
		}else{
			switch($page){
				case 'login':
					DEFINE('local','pQouCy9SDQ3f');
					require_once('husk/login.php');
					break;
				case 'contacto':
					DEFINE('local','pQoRCy9SDQ3f');
					require_once('husk/contacto.php');
					break;
				default:
					$return=array("e"=>11);
					break;
			}
		}
	}else{
		$return=array("e"=>3);
	}	
	switch($format){
		case '.xml':
			break;
		default:
			header('Content-Type: application/json');
			$return=json_encode($return);
			break;
	}
	echo $return;
?>