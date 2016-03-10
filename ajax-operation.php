<?php
require_once('config.inc.php');
require_once('functions.php');
if($_POST['data'] && isset($_POST['datalio'])){
	$name = $_POST['data'];
	$id   = $_POST['datalio'];

	$data = array('category_name'=>$name);
	$fil = array('category_id'=>$id);
	UpdatePDO('video_category',$data,$fil);
}
?>