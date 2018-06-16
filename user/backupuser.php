<?php
ob_start();
include_once '../config.php';

session_start();
if(!$_SESSION['id'])
{
	header("location:../index.php");
}else{
  $sql_query = 'SELECT * FROM `user` where id = '.$_SESSION['id'].'';
  $res = mysqli_query($connec, $sql_query);
  $row=mysqli_fetch_array($res);

  $sql_des = 'SELECT * FROM `designations` where id = '.$row['designation'].'';
  $res_des = mysqli_query($connec, $sql_des);
  $row_des=mysqli_fetch_array($res_des);



  $user_query = 'SELECT * FROM  `user` AS u INNER JOIN  `user` AS m ON m.`Rep_per_id` = u.`id` WHERE m.id = '.$row[7].'';
  $res_user = mysqli_query($connec, $user_query);
  $user_info=mysqli_fetch_array($res_user);
}

if(isset($_POST['send-email']))
{
 // variables for input data
 $name = $_POST['name'];
 $designation = $_POST['designation'];
 $reporting_person = $_POST['reporting_person'];
 $leave_type = $_POST['leave_type'];
 $date = $_POST['date'];
 $days = $_POST['days'];
 $leaves_availed = $_POST['leaves_availed'];
 $department = $_POST['department'];
 $sql_email = 'SELECT * FROM `emails` where is_deleted = 0';
 $res_email = mysqli_query($connec, $sql_email);
 $arr = array();
 while($row_email=mysqli_fetch_array($res_email))
 {
    $arr[] = $row_email['email'];
  }
 $to = implode(",",$arr);
 $subject = "Leave Application from" . $name;
 $message = '
 <html>
 <body>
  <table>
    <tr>
      <th>Employee Name</th>
      <td>'.$name.'</td>
    </tr>
    <tr>
      <th>Designation</th>
      <td>'.$designation.'</td>
    </tr>
    <tr>
      <th>Reporting Person</th>
      <td>'.$reporting_person.'</td>
    </tr>
    <tr>
      <th>Type of Leave (Short Leave/ Full day/ Half day):</th>
      <td>'.$leave_type.'</td>
    </tr>
    <tr>
      <th>Date:</th>
      <td>'.$date.'</td>
    </tr>
    <tr>
      <th>No. of days:</th>
      <td>'.$days.'</td>
    </tr>
    <tr>
      <th>Leaves   Availed:</th>
      <td>'.$leaves_availed.'</td>
    </tr>
    <tr>
      <th>Department (.NET/ QA/ HR/iOS/Graphics):</th>
      <td>'.$department.'</td>
    </tr>
  </table>
</body>
</html>
';
$header = "From:".$_SESSION['email']." \r\n";
 //$header .= "Cc:afgh@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail ($to,$subject,$message,$header);
if( $retval == true ) {
  $msg = "Mail sent successfully...";
}else {
  $msg = "Mail could not be sent...";
}
}
?>
<!DOCTYPE>
<html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Application form </title>
  <link rel="stylesheet" href="user-style.css" type="text/css" />
  <link rel="stylesheet" href="../login.css">
    <link rel="stylesheet" href="../common/back.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
  <script src="user-validation.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <style>
        select.error, label.error {
         color:#FF0000;
       }

        .abc{
      border:2px solid !important;
      border-color:red !important;

     
     }

       .abcc{
      border:2px solid ;
      border-color:green ;

     
     }

 </style>


</head>
<body>
 <?php include("../layout/header.php"); ?>
 <center class="tb_cnter">


  <div class="container">
  <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
  <div class="col-md-2 col-sm-2 ">
    
  </div>
  <div class="tbl_body col-md-8 col-sm-8 col-xs-12 ">
   <?php if($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
      } ?>
    <form method="post" name="user" onsubmit="return validateFunction() ">
     <table class="table table-bordered">
       <thead>
         <tr class="first-chld">
      <th colspan="2">Application form</th>
</tr>
</thead>
      <tbody>
       <tr>
        <th>Employee Name</th>
        <td>
          <input type="text" name="name" id="name" onkeyup="validFname()" value="<?php echo $user_info[1]; ?>" readonly/>
          <span class="alert-danger" id="fname"></span></div>
        
        </td>
      </tr>
      <tr>
        <th>Designation</th>
        <td>
          <input type="text" name="designation" id="designation" onkeyup="validDesig()" value="<?php echo $row_des['name']; ?>" readonly/>
            <span class="alert-danger" id="desig"></span></div>
        </td>
      </tr>
      <tr>
        <th>Reporting Person</th>
        <td>
          <input type="text" name="reporting_person" id="reporting_person" onkeyup="validrepo()" value="<?php echo $user_info['name']; ?>" readonly/>
           <span class="alert-danger" id="lead"></span></div>
        </td>
      </tr>
      <tr>
        <th>Type of Leave</th>
        <td>
          <select name="leave_type" id="leave_type" required="">
            <option value="Short Leave">Short Leave</option>
            <option value="Full day">Full day</option>
            <option value="Half day">Half day</option>
          </select>
        </td>
      </tr>
      <tr>
        <th>Date</th>
        <td>
          <input type="text" name="date" id="datepicker">
           <span class="alert-danger" id="ldate"></span></div>
        </td>
      </tr>
      <tr>
        <th>No. of days</th>
        <td>
          <input type="text" name="days" id="days" onkeyup="validDays()" />
            <span class="alert-danger" id="lday"></span></div>
        </td>
      </tr>
      <tr>
        <th>Leaves Availed</th>
        <td>
          <input type="text" name="leaves_availed" id="leaves_availed" onkeyup="validLeaves()"/>
            <span class="alert-danger" id="lavail"></span></div>
        </td>
      </tr>
      <tr>
        <th>Department</th>
        <td>
          <select name="department" id="department">
           <option value=".NET">.NET</option>
           <option value="QA">QA</option>
           <option value="Designer/Graphics">Designer/Graphics</option>
           <option value="Node">Node</option>
           <option value="PHP">PHP</option>
         </select>
          <span class="alert-danger" id="urdepart"></span></div>
       </td>
     </tr>
     <tr style="text-align:center">
      <td colspan="2"><button class="btn btn-info blue_btn" id="submit_btn" type="submit" name="send-email"><strong>Send Mail</strong></button></td>
    </tr>
  </tbody>
</table>
</form>
</div>
  <div class="col-md-2 col-sm-2 "></div>

</div>
</center>

<?php include("../layout/footer.php"); ?>
</body>
</html>

<?php ob_flush(); ?>
