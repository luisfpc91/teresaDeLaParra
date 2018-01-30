<?php
if(null===$user || !$user->isLogged()){
	switch($page){
		case '':
			require_once('husk/welcome.html');
			break;
		case 'index':
			require_once('husk/welcome.html');
			break;
		case 'quienes_somos':
			require_once('husk/quienes_somos.php');
			break;
		case 'resena_historica':
			require_once('husk/resena_historica.php');
			break;
		case 'contacto':
			require_once('husk/contacto.php');
			break;
	}
}else{
	switch($page){
		case 'inicio':
			DEFINE('local','qweYZP1jVUqn');
			require_once('husk/index.php');
			break;	
		case 'registro_representantes':
			DEFINE('local','p3isYZP1jVUqn');
			require_once('husk/registro_representantes.php');
			break;
		case 'registro_estudiante':
			DEFINE('local','p3isvwP1jVUqn');
			require_once('husk/registro_estudiante.php');
			break;
		case 'registro_salud':
			DEFINE('local','p3isvwQ1jVUqn');
			require_once('husk/registro_salud.php');
			break;
		case 'usuario':
			DEFINE('local','p3isFPP1jVUqn');
			require_once('husk/usuario.php');
			break;
		case 'reportes':
			DEFINE('local','D3isLPP1jVUqn');
			require_once('husk/reportes.php');
			break;			
		case 'logout':
			$_SESSION = array();
			session_destroy();
			header('location:/');
			break;	
	}
}
	
?>