<?php
	require_once("../LEANGA/autoload.php");
	
	use LEANGA\Handler_Database;
	use LEANGA\Handler_User;
	use LEANGA\Handler_Session;
	
	$page=$_GET['a'];
	$format=$_GET['t'];
	if(array_key_exists('b',$_GET))
		$subpage = $_GET['b'];
	else $subpage = "";
	
	session_start();
	$hdb = Handler_Database::getInstance();
	$hs = new Handler_Session();
	$user = $hs->returnUser();
	
	
	switch($page){
		case 'app':
			require_once('husk/app.php');
			break;
		case 'bootstrap':
			readfile('husk/bootstrap.js');
			break;
		case 'bootstrap_min':
			readfile('husk/bootstrap.min.js');
			break;
		case 'jquery':
			readfile('husk/jquery.js');
			break;
		case 'pagination':
			readfile('husk/jquery_twbsPagination_min.js');
			break;
		case 'picker':
			readfile('husk/picker.js');
			break;
		case 'picker_time':
			readfile('husk/picker_time.js');
			break;
		case 'picker_date':
			readfile('husk/picker_date.js');
			break;
		case 'npm':
			readfile('husk/npm.js');
			break;
		case 'toastr':
			readfile('husk/toastr.js');
			break;
		case 'slippry':
			readfile('husk/slippry.min.js');
			break;	
		default:
			http_response_code(404);
			break;
	}
?>