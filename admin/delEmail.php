<?php
 include_once '../config.php';
 
$id=$_POST['id'];
$sql_query = 'UPDATE `emails` SET is_deleted = 1 where id = '.$id.'';
$result = mysqli_query($connec, $sql_query);
if($result){
	echo "true";
}

 ?>