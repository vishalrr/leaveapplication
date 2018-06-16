<?php
session_start();
$email=$_REQUEST['email'];
$pass=$_REQUEST['password'];
mysql_connect("localhost","root","root");
mysql_select_db("mansa_project");
$str=mysql_query("SELECT * FROM `user` where email='$email' and password='$pass'");
$row=mysql_fetch_array($str);
if($email==$row['email'] && $pass==$row['password']){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $row['role'];
    if($row['role'] == 'admin'){
      header("location:admin/admin.php");
    }
    else{
      header("location:user/user.php");
    }
}
else{
    header("location:index.php");
}
?>
