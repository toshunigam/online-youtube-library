<?php
require_once('config.inc.php');
if($_POST['data']){
	$name = $_POST['data'];
	$id   = $_POST['datalio'];

	$query= "UPDATE video_category SET category_name=:name WHERE category_id=:cat_id";
	$res  = $dbh->prepare($query);
	$res->bindValue(':name',$name);
	$res->bindValue(':cat_id',$id);
	$res->execute();
}
?>