<?php
include 'config/config.php';
include 'functions.php';

/*
 * for remote system B 
 * We GET request for get changed ids
 * Check based on update_at field which are updated based 
 * if any fields in the row gets change 
 * 
 */

$update_at = date('Y-m-d H:i:s',strtotime( date('Y-m-d H:i:s').'-1 day'));
$sql = "SELECT id FROM incoming_products where update_at >= '".$update_at."'";
$result = $conn->query($sql);
$i=0;
foreach($result as $res){
	$ids[$i] = $res['id'];
}
if(!empty($ids)){
	return implode(',',$ids);
} else {
	return false;
}
?>