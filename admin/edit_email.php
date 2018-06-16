<?php
include_once '../config.php';

session_start();
if(!$_SESSION['id'])
{
	header("location:../index.php");
}
$sql_query="SELECT * FROM user WHERE role='admin'";
$result_set=mysqli_query($connec,$sql_query);
$row = mysqli_fetch_array($result_set);
if(isset($_POST['btn-update']))
{

       $email = $_POST['email'];
       $password = md5($_POST['password']); 

       $query=  "SELECT * FROM `user` where email='".$row['email']."' and password='".$password."'" ;
       $str=mysqli_query($connec, $query);
       $rows=mysqli_fetch_array($str);
       if($rows){

            $sql_query_up = 'UPDATE `user` SET email="'.$email.'" where id = '.$rows['id'].'';
            if(mysqli_query($connec,$sql_query_up))
            {
              ?>
                <script type="text/javascript">
                alert('Your Email has changed successfully...');
                window.location.href='admin.php';
                </script>
                <?php
            }else{
              ?>
                <script type="text/javascript">
                alert('Something went wrong..');
                </script>
                <?php
            }

       }else{
          $errormsg = "Error : Password did not matched to your account, please try again...";
       }      
 // sql query execution function
}

?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Email</title>
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

 <div class="container" style="height: 100%;">
 <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
        <div class="row centered-form editpg_form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Your Email</h3>
            </div>
            <div class="panel-body frm_bdy">
              <form role="form" action="" method="POST">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                    <div class="form-group">
                      <input type="email" name="name" placeholder="" value="<?php echo $row['email']; ?>" class="form-control input-sm" readonly >
                    </div>
                  </div>
                </div>
                 <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 any-padding">

                <div class="form-group">
                  <input type="email" name="email" placeholder="Change Email" class="form-control input-sm" required>
                </div>
                </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                    <div class="form-group">
                      <input type="password" name="password" placeholder="Password" class="form-control input-sm" required="">
                    </div>
                  </div>
                 
                </div>

                 <div class="row">
                 <div class="col-md-12">      
             
                      <button type="submit" class="btn btn-info btn-block btn_updt" name="btn-update" style="background-color: #BC423B;"><strong>UPDATE</strong></button>
        
                  </div>
                  </div>

              </form>
              <span class="alert-danger"><?php if($errormsg){
                echo $errormsg;
                } ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include("../layout/footer.php"); ?>






</body>
</html>
