<?php
function dbRowInsert($table_name, $form_data){
	// retrieve the keys of the array (column titles)
	$fields = array_keys($form_data);

	// build the query
	$sql = "INSERT INTO ".$table_name."(`".implode('`,`', $fields)."`)VALUES('".implode("','", $form_data)."')";

	// run and return the query result resource
	return mysql_query($sql);
}
function Delete($table, $column, $key)
{
	global $dbh;
	$sql="DELETE FROM ".$table." WHERE ".$column."=:id";
	$res=$dbh->prepare($sql);
	$res->bindValue(':id', $key, PDO::PARAM_INT);
	$res->execute();
	return array('_affectedrows'=>$res->rowCount());
}
function InsertPDO($table_name, $form_data)
{
	// retrieve the keys of the array (column titles)
	global $dbh;
	$fields = array_keys($form_data);
	//$bindvalue=array();
	foreach($fields as $value)
		$bindvalue[] = ':'.$value;
	
	// build the query
	$sql = "INSERT INTO ".$table_name."(".implode(',', array_keys($form_data)).") VALUES(".implode(",", $bindvalue).")";
	$res=$dbh->prepare($sql);
	
	$bind_data=array_combine($bindvalue,$form_data);
	//print_r($bind_data);die;
	$res->execute($bind_data);
	return array('_affectedrows'=>$res->rowCount(),'_lastid'=>$dbh->lastInsertId());
}
function UpdatePDO($table_name, $form_data, $filter)
{
	// retrieve the keys of the array (column titles)
	global $dbh;
	$fields = array_keys($form_data);
	//$bindvalue=array();
	foreach($fields as $value)
		$bindvalue[] = ':'.$value;
	
	// build the query
	$sql = "UPDATE ".$table_name." SET ".implode(',', array_keys($form_data)).") WHERE ".implode(",", $bindvalue)."";
	$res=$dbh->prepare($sql);
	
}
// the where clause is left optional incase the user wants to delete every row!
function dbRowDelete($table_name, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;

    // run and return the query result resource
    return mysql_query($sql);
}
// again where clause is left optional
function dbRowUpdate($table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;

    // run and return the query result
    return mysql_query($sql);
}
// for video url
function ViewVideo($url, $urlname, $size = 1){
		if($size == 1) {		
		$width = 320; $height = 210;
	}else {
		$width = 640; $height = 360; //default size
	}
	$url = substr($url, strrpos($url, "=")+1);
	echo strrpos($url, "=");
		echo '<object width="'.$width.'" height="'.$height.'" >';
		echo '<param name="movie" value="//www.youtube.com/v/'.$url.'"></param>';
		echo '<param name="allowFullScreen" value="true"></param>';
		echo '<param name="allowscriptaccess" value="always"></param>';
		echo '<embed src="//www.youtube.com/v/'.$url.'" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" allowscriptaccess="always" allowfullscreen="true"></embed>';
		echo '</object>';

	}
//search result function ********************************************
function fulltextsearch($table, $fields, $match, $against, $user){
global $dbh;
$sql = "SELECT ".implode(',', $fields)." FROM ".$table." WHERE user_id=".$user." AND MATCH(".implode(',', $match).") AGAINST('".$against."' IN BOOLEAN MODE)";

$result = $dbh->query($sql);
return $result;
}
?>