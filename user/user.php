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



  $user_query = 'SELECT * FROM  `user` AS u INNER JOIN  `user` AS m ON m.`Rep_per_id` = u.`id` WHERE u.id = '.$row[7].'';
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
 $reason = $_POST['reason'];
 $leaves_availed = $_POST['leaves_availed'];
 $department = $_POST['department'];
 $sql_email = 'SELECT * FROM `emails` where is_deleted = 0';
 $res_email = mysqli_query($connec, $sql_email);

 $today = date("F j, Y"); 


require 'send/PHPMailerAutoload.php';
 

$mail = new PHPMailer();


//Enable SMTP debugging.

$mail->SMTPDebug = 0;                           
 
//Set PHPMailer to use SMTP.
 
$mail->isSMTP();        
 
//Set SMTP host name                      
 
$mail->Host = "smtp.gmail.com";
 
//Set this to true if SMTP host requires authentication to send email
 
$mail->SMTPAuth = true;                      
 
//Provide username and password
 
$mail->Username = "mansatestrest123@gmail.com";             
 
$mail->Password = "vishal@123";                       
 
//If SMTP requires TLS encryption then set it
 
$mail->SMTPSecure = "tls";                       
 
//Set TCP port to connect to
 
$mail->Port = 587;                    
 
$mail->From = "mansatestrest123@gmail.com";
 
$mail->FromName = $name;
while($row_email=mysqli_fetch_array($res_email))
{
    $mail->addAddress($row_email['email']);
} 

 
$mail->isHTML();
 
$mail->Subject = "Leave Application";
 
$mail->Body = '<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://use.fontawesome.com/bc8520503f.js"></script>
  <style>
   .table th, .table td{
       border: 1px solid black;
       padding:5px;
       border-bottom: none;
       border-right: none;
       width: 50%;
   }
  </style>
</head>
<body>
  <table cellpadding="0" cellspacing="0" style="box-sizing: border-box; background:url(toyonderwash.jpg); padding:0;  box-shadow: 0 0 10px 0 rgba(0,0,0,.7); margin:0 auto; width: 100%;">
    <tbody>
      <tr>
        <td>
          <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box; margin: 0 auto;padding: 15px 50px;">
            <tbody>
              <tr style="width:100%;">
                <td style="width: 62%;">
                  <img src="http://mansainfotech.com/images/logo.gif" width="280px">
                </td>
                <td>
                  <p style="color:#B84236; font-weight: bold; font-size: 24px;
">Name : '.$name.'</p>
                   <p style="color:#B84236; font-size:17px;
                  "><span style="font-weight: bold; font-size: 24px;">Email : </span>'.$row['email'].'</p>
                </td>
              </tr>
            </tbody>
          </table>
          <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;margin:0  auto;  padding: 10px;">
            <tbody>
              <tr>
                <td width="33.33%">
                  <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;">
                    <tbody>
                      <tr>
                        <td style="border-bottom:1px solid #000; padding-bottom:5px;">
                        </td>
                      </tr>
                      <tr>
                        <td style="border-bottom:1px solid #000; padding-bottom:5px;">
                        </td>
                      </tr>
                      <tr>
                        <td style="border-bottom:1px solid #000; padding-bottom:5px;">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td width="33.33%" style="text-align:center; padding-top: 28px;">

                <span style="font-size: 20px; color:#b84236;"> Leave application for '.$days.' day'."'".'s <br>'.$today.'</span>
              
                  
                </td>
                <td width="33.33%">
                  <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;">
                    <tbody>
                      <tr>
                        <td style="border-bottom:1px solid #000; padding-bottom:5px;">
                        </td>
                      </tr>
                      <tr>
                        <td style="border-bottom:1px solid #000; padding-bottom:5px;">
                        </td>
                      </tr>
                      <tr>
                        <td style="border-bottom:1px solid #000; padding-bottom:5px;">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
          <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;margin:0  auto;  padding: 10px; ">
            <tbody>
            </tbody>
          </table>
          <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;margin:0  auto;  padding: 10px; ">
            <tbody>
              <tr>
                <td width="60%" style="background:#fff; padding:10px;">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    
                    </tbody>
                  
            
                  <h1 style="text-align: left; border-bottom: 2px solid black; display: inline-block; padding-bottom: 4px;">Application Details</h1>   
                  <table width="100%" cellpadding="0" cellspacing="0" class="table">
                    <tbody>                                       
                       <tr>
                        <td><p style="margin:0;padding:10px 0px;">Designation : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$designation.'</p></td>
                      </tr>
      
                      <tr>
                        <td><p style="margin:0;padding:10px 0px;">Reporting Person : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$reporting_person.'</p></td>
                      </tr>
                 
                      <tr>
                        <td><p style="margin:0;padding:10px 0px;">Type of Leave (Short Leave/ Full day/ Half day) : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$leave_type.'</p></td>
                      </tr>
                       <tr>
                        <td><p style="margin:0;padding:10px 0px;">Reason : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$reason.' </p></td>
                      </tr> 
                       <tr>
                        <td><p style="margin:0;padding:10px 0px;">Date : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$date.' </p></td>
                      </tr>
                      <tr>
                        <td class="td"><p style="margin:0;padding:10px 0px;">No. of days : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$days.' </p></td>
                      </tr>
                      <tr>
                        <td><p style="margin:0;padding:10px 0px;">Leaves Availed : </p></td>
                        <td style="border-right: 1px solid black;"><p style="margin:0;padding:10px 0px;">'.$leaves_availed.' </p></td>
                      </tr>
              
                      <tr>
                        <td class="td" style="border-bottom: 1px solid black; "><p style="margin:0;padding:10px 0px;">Department (.NET/ QA/ HR/iOS/Graphics) : </p></td>
                        <td class="td" style="border-bottom: 1px solid black;border-right: 1px solid black; "><p style="margin:0;padding:10px 0px;">'.$department.' </p></td>
                      </tr>                                         
                  
                    </tbody>
                  </table>
                  <table width="100%" cellpadding="0" cellspacing="0" style="padding:10px 0px;">
                    <tbody>
                      
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
          <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box; background:#000; margin: 0 auto;padding: 15px 50px;">
            <tbody>
              <tr style="text-align:center; width:100%;">
                <td>
                  <p style="color:white; margin:0;">Copyright MansaInfotech.com. All Rights Reserved</p>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>';
 
// $mail->AltBody = "This is the plain text version of the email content";

 
if($mail->send()) 
{
 
$msg = "Mail sent successfully...";

}
 
else
 
{
 
$msg = "Something went wrong..."; 
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
          <input type="text" name="name" id="name" onkeyup="validFname()" value="<?php echo $row['name']; ?>" readonly required/>
          <span class="alert-danger" id="fname"></span></div>
        
        </td>
      </tr>
      <tr>
        <th>Designation</th>
        <td>
          <input type="text" name="designation" id="designation" onkeyup="validDesig()" value="<?php echo $row_des['name']; ?>" readonly required/>
            <span class="alert-danger" id="desig"></span></div>
        </td>
      </tr>
      <tr>
        <th>Reporting Person</th>
        <td>
          <input type="text" name="reporting_person" id="reporting_person" onkeyup="validrepo()" value="<?php echo $user_info[1]; ?>" readonly required/>
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
        <th>Reason</th>
        <td>
          <textarea name="reason" placeholder="Enter the valid reason for leave.... " style="width: 100%;" required></textarea>
        </td>
      </tr>
      <tr>
        <th>Date</th>
        <td>
          <input type="text" name="date" id="datepicker" required>
           <span class="alert-danger" id="ldate"></span></div>
        </td>
      </tr>
      <tr>
        <th>No. of days</th>
        <td>
          <input type="text" name="days" id="days" onkeyup="validDays()" required/>
            <span class="alert-danger" id="lday"></span></div>
        </td>
      </tr>
      <tr>
        <th>Leaves Availed</th>
        <td>
          <input type="text" name="leaves_availed" id="leaves_availed" onkeyup="validLeaves()" required/>
            <span class="alert-danger" id="lavail"></span></div>
        </td>
      </tr>
      <tr>
        <th>Department</th>
        <td>
          <select name="department" id="department" required>
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
