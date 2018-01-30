<?php
	if(local!='pQouCy9SDQ3f'){
		exit();}
	
	use LEANGA\Handler_SQLBuilder;
	
	
	$name		= $_POST['name']; 
	$password	= $_POST['password']; 
	
	$where = array(
		Handler_SQLBuilder::OPERATOR_EQUAL => Array(
			Handler_SQLBuilder::TABLE_USERS_USER => $name
		)
	);
	$query = new Handler_SQLBuilder($db);
	$query->select(Handler_SQLBuilder::TABLE_USERS);
	$query->where($where);	
		
		
		
	if($usr=$db->selectTable($query)){
		$usr = $usr->fetch(PDO::FETCH_ASSOC);
		$pass = $usr['password'];
		if(password_verify($password,$pass)){
			$token = password_hash($pass.time().$password,PASSWORD_DEFAULT);
			$_SESSION['session'] = $token;
			$fields = array(
				Handler_SQLBuilder::TABLE_USERS_TOKEN => $token
			);
			$query = new Handler_SQLBuilder($db);
			$query->update(Handler_SQLBuilder::TABLE_USERS,$fields);
			$query->where($where);
			$db->updateTable($query);
			$return=array("e"=>0);
		}else{
			$return=array("e"=>2);
		}
		
	}else{
		$return=array("e"=>1);
	}
		
		
?>