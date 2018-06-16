<?php
include_once 'config.php';
$sql_query="SELECT * FROM user WHERE role='admin'";
$result_set=mysqli_query($connec,$sql_query);
$row = mysqli_fetch_array($result_set);


?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forgot Password</title>
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
<?php include("layout/header.php"); ?>


<?php 

$hash = md5( rand(0,1000) );
$sql_up = 'UPDATE `user` SET hash="'.$hash.'" where id = '.$row['id'].'';
if(mysqli_query($connec,$sql_up)){

  $email = $row['email'];

  require 'user/send/PHPMailerAutoload.php';
   

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

  $mail->addAddress($email);


   
  $mail->isHTML();
   
  $mail->Subject = "Email Verifiication for change password";
   
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
                  <td style="width: 63%;">
                    <img src="http://mansainfotech.com/images/logo.gif" width="280px">
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

                  <span style="font-size: 20px; color:#b84236;"> Please click on this link to change your account password:
  http://localhost/verifypass.php?email='.$email.'&hash='.$hash.'</span>
                
                    
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
            
          </td>
        </tr>
      </tbody>
    </table>
  </body>
  </html>';
   
  // $mail->AltBody = "This is the plain text version of the email content";

   
  if($mail->send()) 
  {
   
  $msg = "If you are a admin a Confirmation mail is sent to your email address please verify.";

  }
   
  else
   
  {
   
  $msg = "Error Occur. while sending confirmation mail."; 
  }
}
?>

<div style="height: 530px; padding-top: 200px; padding-left: 30px; color: #BC423B;">
  <h2> <?php echo $msg; ?> </h2>
</div>
       

<?php include("layout/footer.php"); ?>
</body>
</html>
