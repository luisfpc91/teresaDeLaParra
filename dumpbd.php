<?php

	$db_name='teresadelaparra';
	$pdo = new PDO("mysql:dbname=$db_name;host=localhost;chatset=utf8","luisfpc91","21001146",array());
	
	
	$query = "SHOW TABLES";
	$tables=$pdo->query($query);
	$i=0;
	$switch=$dec="";
	while($table=$tables->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
		$table = $table["Tables_in_$db_name"];
		//echo "//table $table<br>";
		$i++;
		
		//echo "//table $table<br>";
		$dec.="//table $table<br>";
		$dec.='const TABLE_'.strtoupper($table)."=$i;<br>";
		
		$switch.='case self::TABLE_'.strtoupper($table).":<br>";
		$switch.="return '$table';<br>";
		$query="DESCRIBE $table";
		$res=$pdo->query($query);
		$fields=Array();
		while($re=$res->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){
			$i++;
			$switch.='case self::TABLE_'.strtoupper($table).'_'.strtoupper($re['Field']).":<br>";
			$switch.="return '{$re['Field']}';<br>";
			$dec.='const TABLE_'.strtoupper($table).'_'.strtoupper($re['Field'])."=$i;<br>";
		}
		$dec.="<br><br>";
		
		
	}
	echo $dec;
	echo $switch;
?>