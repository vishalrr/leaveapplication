<?php
include_once '../config.php';

session_start();
if(!$_SESSION['id'])
{
	header("location:../index.php");
}


if(isset($_GET['edit_id']))
{

 $sql_query="SELECT * FROM user WHERE id=".$_GET['edit_id'];
 $result_set=mysqli_query($connec,$sql_query);

 $sql_query_all="SELECT * FROM user";
 $result_set_all=mysqli_query($connec,$sql_query_all);

 $sql_que = 'SELECT * FROM `designations` ORDER BY `name`';
 $result = mysqli_query($connec, $sql_que);

 $fetched_row=mysqli_fetch_array($result_set);
}
if(isset($_POST['btn-update']))
{
 // variables for input data
 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = md5($_POST['password']); 
 $des = $_POST['designation'];
 $under = $_POST['under'];
 $date = date('Y-m-d H:i:s');
 // variables for input data
if($_POST['password']){
 // sql query for update data into database
 $sql_query = 'UPDATE `user` SET name="'.$name.'",email="'.$email.'",password="'.$password.'",updated_at="'.$date.'",designation="'.$des.'",Rep_per_id="'.$under.'" where id = '.$_GET['edit_id'].'';
 // sql query for update data into database
}else{
  $sql_query = 'UPDATE `user` SET name="'.$name.'",email="'.$email.'",updated_at="'.$date.'",designation="'.$des.'",Rep_per_id="'.$under.'" where id = '.$_GET['edit_id'].'';
}
 // sql query execution function
 if(mysqli_query($connec,$sql_query))
 {
  ?>
  <script type="text/javascript">
  alert('Data Updated Successfully');
  window.location.href='admin.php';
  </script>
  <?php
 }
 else
 {
  ?>
  <script type="text/javascript">
  alert('error occured while updating data');
  </script>
  <?php
 }
 // sql query execution function
}
if(isset($_POST['btn-cancel']))
{
 header("location:admin.php");
}
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit User</title>
    <link rel="stylesheet" href="../common/back.css">
<link rel="stylesheet" href="admin-style.css" type="text/css" />
<link rel="stylesheet" href="../login.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <style type="text/css">
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    
     -webkit-text-fill-color: black !important;
}

  </style>
</head>
<body>
<?php include("../layout/header.php"); ?>

 <div class="container">
 <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
        <div class="row centered-form editpg_form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Edit User Here!</h3>
            </div>
            <div class="panel-body frm_bdy">
              <form role="form" action="" method="POST">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                    <div class="form-group">
                      <input type="text" name="name" placeholder="Name" value="<?php echo $fetched_row['name']; ?>" class="form-control input-sm" required >
                    </div>
                  </div>
                </div>
                 <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 any-padding">

                <div class="form-group">
                  <input type="email" name="email" placeholder="Email" value="<?php echo $fetched_row['email']; ?>" class="form-control input-sm" required>
                </div>
                </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                    <div class="form-group">
                      <input type="password" name="password" placeholder="Password" class="form-control input-sm" >
                    </div>
                  </div>
                 
                </div>
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                  <div class="form-group">
                     <select class="form-control" required="" name="designation">
                            <option value=""> ------------------- Select Designation ------------------- </option>
                            <?php  while($rows=mysqli_fetch_array($result))
                                    { ?>
               
                                  <option value="<?php echo $rows['id']; ?> " <?php
                                   if($fetched_row['designation'] == $rows['id']){
                                      echo "selected";
                                    } ?> > <?php echo $rows['name']; ?> </option>

                            <?php  } ?>             
                      </select>   
                    </div>
                  </div>
                 
                </div>   
                 <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                  <div class="form-group">
                     <select class="form-control" required="" name="under">
                            <option value=""> -------------  Select Employee Under  -------------- </option>
                            <?php  while($rows_all=mysqli_fetch_array($result_set_all))
                                    { ?>
               
                                  <option value="<?php echo $rows_all['id']; ?> " <?php
                                   if($fetched_row['Rep_per_id'] == $rows_all['id']){
                                      echo "selected";
                                    } ?> > <?php echo $rows_all['name']; ?> </option>

                            <?php  } ?>             
                      </select>   
                    </div>
                  </div>
                 
                </div>           
                 <div class="row">
                 <div class="col-md-12">      
                 <div class="col-xs-6 col-sm-6 col-md-6">
                 <button type="submit" class="btn btn-info btn-block btn_updt" name="btn-update"><strong>UPDATE</strong></button>
                 </div>
                   <div class="col-xs-6 col-sm-6 col-md-6">
          <button type="submit" class="btn btn-info btn-block btn_cancl" name="btn-cancel"><strong>Cancel</strong></button>
          </div>
               
              </div>
              </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include("../layout/footer.php"); ?>






</body>
</html>
