<?php
	include_once '../config.php';

	session_start();
	if(!$_SESSION['id'])
	{
		header("location:../index.php");
	}

	if(isset($_POST['btn-save']))
	{
	 // variables for input data
	 $name = $_POST['name'];
	 $email = $_POST['email'];
	 $password = $_POST['password'];

	 // sql query for inserting data into database
	 $sql_query = "INSERT INTO `user`(`name`,`email`,`password`,`role`) VALUES('$name','$email','$password', 'user')";
	 // sql query execution function
	 if(mysqli_query($connec,$sql_query))
	 {
?>
  <script type="text/javascript">
  alert('Data Is Inserted Successfully ');
  window.location.href='admin.php';
  </script>
  <?php
 }
 else
 {
?>
  <script type="text/javascript">
  alert('Error occured while inserting your data');
  </script>
<?php
 }
 // sql query execution function
 }
?>
<!DOCTYPE>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add User</title>
	<link rel="stylesheet" href="admin-style.css" type="text/css" />
	<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script src="add-user-validation.js"></script>
	<style>
		select.error, label.error {
			color:#FF0000;
		}
	</style>
	</head>
	<body>
		<center>
		<div id="header">
		  <div id="content">
		     <label style="float:left">Add User</label>
		     <label style="float:right"><a href="../logout_session.php">LOGOUT</a></label>
		  </div>
		</div>
		<div id="body">
		   <div id="content">
		      <form name="addUser" method="post">
		        <table align="center">
		          <tr>
		              <td><input type="text" name="name" id="name" placeholder="Name" /></td>
		          </tr>
		          <tr>
		              <td><input type="email" name="email" id="email" placeholder="Email" /></td>
		          </tr>
		          <tr>
		              <td><input type="password" name="password" id="password" placeholder="Password" /></td>
		          </tr>
		          <tr>
		             <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
		          </tr>
		        </table>
		      </form>
		    </div>
		</div>
		</center>
	</body>
</html>
