<?php
require_once('LEANGA/autoload.php');
use LEANGA\Handler_Database;
use LEANGA\Handler_User;
use LEANGA\Handler_Session;


session_start();
$page = $_GET['c'];

if($page == "logout"){
	$_SESSION = array();
	session_destroy();
	header('location:/index');
}

$nombre = $page;
$nombre2 = "";
switch($nombre){
		case '':
			$nombre2 = 'E.E.I. Coelgio Teresa de la Parra';
			break;
		case 'index':
			$nombre2 = 'E.E.I. Coelgio Teresa de la Parra';
			break;
		case 'quienes_somos':
			$nombre2 = '¿Quienes somos?';
			break;
		case 'resena_historica':
			$nombre2 = 'Reseña historica';
			break;
		case 'contacto':
			$nombre2 = 'Contacto';
			break;
		case 'inicio':
			$nombre2 = 'Inicio Sistema';
			break;	
		case 'registro_representantes':
			$nombre2 = 'Registro del representante';
			break;
		case 'registro_estudiante':
			$nombre2 = 'Registro del estudiante';
			break;
		case 'registro_salud':
			$nombre2 = 'Registro de salud';
			break;
		case 'usuario':
			$nombre2 = 'Usuarios';
			break;
		case 'reportes':
			$nombre2 = 'Reportes';
			break;	
}

$hdb = Handler_Database::getInstance();
$hs = new Handler_Session();
$user = $hs->returnUser();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/app.css" rel="stylesheet">
		<link href="css/toastr.css" rel="stylesheet">
		<link href="css/default.css" rel="stylesheet">
		<link href="css/default.date.css" rel="stylesheet">
		<link href="css/default.time.css" rel="stylesheet">
		<link href="files/images/cabeza.jpg" rel="shortcut icon" >
		<link href="css/slippry.css" rel="stylesheet" />
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap_min.js" type="text/javascript"></script>
		<script src="js/toastr.js" type="text/javascript"></script>
		<script src="js/pagination.js" type="text/javascript"></script>
		<script src="js/picker.js" type="text/javascript"></script>
		<script src="js/picker_time.js" type="text/javascript"></script>
		<script src="js/picker_date.js" type="text/javascript"></script>
		<script src="js/slippry.min.js" type="text/javascript"></script>
		<script src="//use.edgefonts.net/cabin;source-sans-pro:n2,i2,n3,n4,n6,n7,n9.js"></script>
		<script src="js/app<?php  echo $page ? ".$page" : ""  ?>.js"></script>
		<title><?php echo $nombre2?></title>	
	</head>
	<body>
		<?php
			require_once 'sections/navbar.php';
			require_once 'pages/pages.php';
			require_once 'sections/modals.php';
		?>
	</body>

</html>