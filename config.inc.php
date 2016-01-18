<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "video_library";
try{
	$dbh= new PDO("mysql:host=$host;dbname=$database",$user,$pass);
	return $dbh;
}catch(PDOException $e){
	print "ERROR : ". $e->getMessage(). '<br />';
}
/* function ConnectPDO(){
	try{
		$dbh= new PDO("mysql:host=localhost;dbname=zuffs",'root','');
		return $dbh;
	}catch(PDOException $e){
		print "ERROR : ". $e->getMessage(). '<br />';
	}
}
 */
//$db = mysql_connect($host, $user, $pass) or die(mysql_error());
//mysql_select_db($database, $db) or die(mysql_error());
?>