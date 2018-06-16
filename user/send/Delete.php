<?php
include('connect.php');
$query="delete from subcribe where sub_id=".$_GET['id'];
$res=mysql_query($query);
if($res)
{
//echo "heloo";
header('location:..\SendMail.php');
}
?>