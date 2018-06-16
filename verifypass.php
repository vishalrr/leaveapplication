<?php
include_once 'config.php';
$sql_query="SELECT * FROM user WHERE role='admin'";
$result_set=mysqli_query($connec,$sql_query);
$row = mysqli_fetch_array($result_set);

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysql_escape_string($_GET['email']); 
    $hash = mysql_escape_string($_GET['hash']);
    $query =  "SELECT * FROM `user` where email='".$email."' and hash='".$hash."'" ;
    $str= mysqli_query($connec, $query);
    $row= mysqli_fetch_array($str); 
    if(empty($row)){

      $errormsg = "Something went wrong...";
    }else{

          if(isset($_POST['btn-update']))
          {
           // variables for input data
           $new_pass = md5($_POST['new_password']);
           $date = date('Y-m-d H:i:s');

           $sql_query = 'UPDATE `user` SET updated_at="'.$date.'",password="'.$new_pass.'" where id = '.$row['id'].'';

           if(mysqli_query($connec,$sql_query))
           {
            ?>
            <script type="text/javascript">
            alert('Password Updated Successfully');
            window.location.href='index.php';
            </script>
            <?php
           }
           else
           {
            $errormsg = "Something went wrong...";
           }
           // sql query execution function
          }

      }

?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Change password</title>
<link rel="stylesheet" href="common/back.css">
<link rel="stylesheet" href="admin-style.css" type="text/css" />
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

function myFunction() {
    var pass = document.getElementById("newpass").value;
    var repass = document.getElementById("rep_pass").value;
    if(pass != repass){
      alert("Password did not matched");
      return false;
    }
}

</script>
</head>
<body>
 <?php if($errormsg){
                echo "<h1>";
                echo $errormsg;
                echo "</hq>";
                exit;
  } ?>

<?php include("layout/header.php"); ?>

 <div class="container">
 <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
        <div class="row centered-form editpg_form" style="padding: 145px;">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title" style="color: #BC423B; text-decoration: bold;">Change Password</h3>
            </div>
            <div class="panel-body frm_bdy">
              <form role="form" action="" method="POST" onsubmit="myFunction()">        
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                    <div class="form-group">
                      <input type="password" id="newpass" name="new_password" placeholder="Type new password..." class="form-control input-sm" required="">
                    </div>
                  </div>
                 
                </div>
                  <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 any-padding">
                    <div class="form-group">
                      <input type="password" id="rep_pass" name="re_password" placeholder="Retype password..." class="form-control input-sm" required >
                    </div>
                  </div>
                 
                </div>
               
                 <div class="row">
                 <div class="col-md-12">      
                
                 <button type="submit" class="btn btn-info btn-block btn_updt" name="btn-update" style="background-color: #BC423B;"><strong>Change Password</strong></button>
        
                 
                   
                  </div>
                  </div>

              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include("layout/footer.php"); ?>

</body>
</html>
<?php }else{
      echo "<h1>Something went wrong...</h1>";
    }
  ?>


