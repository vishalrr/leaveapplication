<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once '../config.php';
session_start();
if(!$_SESSION['id'])
{
  header("location:../index.php");
}
// delete condition
if(isset($_GET['delete_id']))
{
  $sql_query="DELETE FROM user WHERE id=".$_GET['delete_id'];
  mysqli_query($connec,$sql_query);
  header("Location: $_SERVER[PHP_SELF]");
}

$sql_query = 'SELECT * FROM `designations` ORDER BY `name`';
$result = mysqli_query($connec, $sql_query);

$sql_emails = 'SELECT * FROM `user`';
$result_emails = mysqli_query($connec, $sql_emails);

$sql_em = 'SELECT * FROM `emails` where is_deleted = 0';
$result_em = mysqli_query($connec, $sql_em);

?>

<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin-style.css" type="text/css" />
  <link rel="stylesheet" href="../login.css">
  <link rel="stylesheet" href="../common/back.css">
  <link rel="stylesheet" href="css.css" media="screen" />

  <link rel="stylesheet" href="../adminpg.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/bc8520503f.js"></script>
  <script type="text/javascript">
    function edt_id(id)
    {
  //  if(confirm('Sure to edit ?'))
  //  {
    window.location.href='edit_user.php?edit_id='+id;
   //}
 }
 function delete_id(id)
 {
   if(confirm('Are you sure to Delete ?'))
   {
    window.location.href='admin.php?delete_id='+id;
  }
}
</script>

<script>
  $(document).ready(function(){
    $(window).resize(function () {
      var viewportWidth = $(window).width();
      if (viewportWidth <= 768) {
        $(".table-responsives").removeClass("table-responsives").addClass("table-responsive");
      }
    });
  });
</script>


<script type="text/javascript">
  
  $(document).ready(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut(5000);

    // alert("chakk ");
  });
</script>
<style>
* {
  box-sizing: border-box;
}
body {
  font: 16px Arial;  
}
.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
th{
  width: 100px;
}
</style>

</head>
<body>
 <?php include("../layout/header.php"); ?>

 <div class="container" style="height: 100%;">
<div class="se-pre-con"></div>

  <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
  <div class="col-md-12 admin_pg_height">
    <div class="row">

   </div>
   <div class="table-responsives">
   <div id="third-container">
    <table class="table table-striped admin_frnt_tbl">
      <thead>
       <tr class="first-chld">
        <th class="titleth" colspan="3">Users <a href="#" class="btn btn-primary adduser" data-toggle="modal" data-target="#myModal">Add New User</a></th>
        <th class="gfd-ygr" colspan="4" style="width: 308px;">
        <a href="edit_email.php" class="btn btn-primary adduser">My Account</a> <a href="#" class="btn btn-primary adduser" data-toggle="modal" data-target="#myemails">Manage Emails</a>
        <a href="#" class="btn btn-primary adduser" data-toggle="modal" data-target="#myDes" ">Add New Designation</a></th>
      </tr>
      <tr>
        <th>Sr.No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th style="width: 145px;">Person Under</th>
        <th>Designation</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     <?php
     $no=1;
     $sql_query="SELECT * FROM user where role='user'";
     $result_set=mysqli_query($connec, $sql_query);
     while($row=mysqli_fetch_row($result_set))
     {

       $sql_q="SELECT * FROM user where `id`=".$row[7]."";
       $result_s=mysqli_query($connec, $sql_q);
       $row_rep=mysqli_fetch_row($result_s);

       $sql_que="SELECT * FROM designations where `id`=".$row[8]."";
       $result_desig=mysqli_query($connec, $sql_que);
       $row_des=mysqli_fetch_row($result_desig);

       ?>
       <tr>

        <td><?php echo $no; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row_rep[1]; ?></td>
        <td><?php echo $row_des[1]; ?></td>

        <td>
          <ul>
            
        
                <li><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="../bootstrap/images/edit.png" border="0" title="edit"></a></li>
                <li><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="../bootstrap/images/delete.png" border="0" title="delete"></a>
                </li>
       
          
          </ul>
        </td>
      </tr>
      <?php
      $no++;
    }
    ?>
  </tbody>
</table>

<div class="my-navigation" style="margin-left: 500px;">
  <div class="" style="float: left; margin-top: 4px;"> Pages :</div>

  <!--  <div class="simple-pagination-first"></div>
 -->   <!--  <div class="simple-pagination-previous"></div> -->
   <div class="simple-pagination-page-numbers"></div>
    <!-- <div class="simple-pagination-next"></div> -->
   <!--  <div class="simple-pagination-last"></div> -->
</div>

  
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myDes" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header add_usr_mdl">
        <button type="button" class="close mdl_crss" data-dismiss="modal">&times;</button>
        <h4 class="modal-title mdl_title">Add Designation</h4>
      </div>
      <div class="modal-body">
        <?php



        if(!$_SESSION['id'])
        {
          header("location:../index.php");
        }

        if(isset($_POST['btn-s']))
        {
   // variables for input data
         $name = $_POST['nam'];

   // sql query for inserting data into database
         $sql_query = "INSERT INTO `designations`(`name`) VALUES('$name')";
   // sql query execution function
         if(mysqli_query($connec,$sql_query))
         {
          ?>
          <script type="text/javascript">
           
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

      <center>

       <form class="form-horizontal" role="form" method="post" action="" autocomplete="off">

        <div class="form-group">  
          <div class="col-sm-8 col-sm-offset-2"> 
            <input type="text" class="form-control" id="nam" name="nam" placeholder="Designation Name" required=""> 
          </div> 
        </div> 
        <div class="form-group"> 
          <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3"> 
            <button type="submit" id="submit" name="btn-s" class="btn-lg btn-primary mh_pl_ol">Add Designation</button>
          </div> 
        </div> 
        <!--end Form-->

          </form>


        </center>


      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myemails" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header add_usr_mdl">
        <button type="button" class="close mdl_crss" data-dismiss="modal">&times;</button>
        <h4 class="modal-title mdl_title">Manage Emails</h4>
      </div>
      <div class="modal-body">
        <?php



        if(!$_SESSION['id'])
        {
          header("location:../index.php");
        }

        if(isset($_POST['btn-email']))
        {
   // variables for input data
         $email = $_POST['newemail'];
   // sql query for inserting data into database
         $sql_em_check = 'SELECT * FROM `emails` where email = '.'"'.$email.'"';
         $result_em_check = mysqli_query($connec, $sql_em_check);
         $result_emc = mysqli_fetch_array($result_em_check);
         if(!empty($result_emc)){

          $id=$_POST['id'];
          $sql_query = 'UPDATE `emails` SET is_deleted = 0 where id = '.$result_emc['id'].'';
          $result = mysqli_query($connec, $sql_query);
          if($result){
            ?>
                <script type="text/javascript">
                 
                  window.location.href='admin.php';
                </script>
                <?php
          }

         }else{
             $sql_querem = "INSERT INTO `emails`(`email`,`is_deleted`) VALUES('$email',0)";
         // sql query execution function
               if(mysqli_query($connec,$sql_querem))
               {
                ?>
                <script type="text/javascript">
                 
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
      }
 // sql query execution function
      }
      ?>

      <center>

       <form class="form-horizontal" role="form" method="post" action="" autocomplete="off">

       <div class="form-group"> 
          <div class="col-sm-8 col-sm-offset-2">
             <table style="padding-left: 4px; padding-right: 50px;">
               <tr>
                <th class="titleth" colspan="6" style="width: 100%;">Currently Emails are sent to : </th>
                <th class="gfd-ygr">  </th>
              </tr>
              <?php 
                 while($rows_em=mysqli_fetch_array($result_em))
                 { ?>
                    <tr>
                      <td> <?php  echo $rows_em['email']; ?> </td>
                      <td><a href="javascript:void(0)" value="<?php echo $rows_em['id']; ?>" class="delete" >Delete</a></td>
                    </tr>
                            
               <?php  }  ?> 
              </table>
            
          </div> 
        </div>

        <div class="form-group"> 
          <div class="col-sm-8 col-sm-offset-2">
            <select class="form-control" required="" name="newemail">
              <option value=""> ------------------  Add Another email ---------------- </option>
              <?php  while($rows_emails=mysqli_fetch_array($result_emails))
                      { ?>
 
                    <option value="<?php echo $rows_emails['email']; ?> "> <?php echo $rows_emails['email']; ?> </option>

              <?php  } ?>             
            </select>
            
          </div> 
        </div> 

        <div class="form-group"> 
          <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3"> 
            <button type="submit" id="submit" name="btn-email" class="btn-lg btn-primary mh_pl_ol">Add Email</button>
          </div> 
        </div> 
        <!--end Form-->

          </form>


        </center>


      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header add_usr_mdl">
        <button type="button" class="close mdl_crss" data-dismiss="modal">&times;</button>
        <h4 class="modal-title mdl_title">Add User</h4>
      </div>
      <div class="modal-body">
        <?php



        if(!$_SESSION['id'])
        {
          header("location:../index.php");
        }

        if(isset($_POST['btn-save']))
        {
   // variables for input data
         $name = $_POST['name'];
         $email = $_POST['email'];
         $password = md5($_POST['password']);
         $designation = $_POST['designation'];
         $under = $_POST['under'];   
         $sql = 'SELECT * FROM `user` where `name`='.'"'.$under.'"';
         $user = mysqli_query($connec, $sql);
         $uid = mysqli_fetch_array($user); 
         $under_uid = $uid['id'];
         $date = date('Y-m-d H:i:s');

   // sql query for inserting data into database
         $sql_query = "INSERT INTO `user`(`name`,`email`,`password`,`role`, `created_at`,`updated_at`,`Rep_per_id`,`designation`) VALUES('$name','$email','$password', 'user', '$date','$date','$under_uid','$designation')";
   // sql query execution function
    
         if(mysqli_query($connec,$sql_query))
         {
          ?>
          <script type="text/javascript">
           
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

      <center>

       <form class="form-horizontal" role="form" method="post" action="" autocomplete="off">

        <div class="form-group">  
          <div class="col-sm-8 col-sm-offset-2"> 
            <input type="text" class="form-control" onkeyup="validFname()" id="name" name="name" placeholder="Name" required=""> 
             <span class="alert-danger" id="fname"></span>
          </div> 
        </div> 
        <div class="form-group"> 
          <div class="col-sm-8 col-sm-offset-2"> 
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required=""> 
          </div> 
        </div> 
        <div class="form-group"> 
          <div class="col-sm-8 col-sm-offset-2">
          <input class="form-control" type="password" name="password" id="password" placeholder="Password" required/>
          </div> 
        </div> 

        <div class="form-group"> 
          <div class="col-sm-8 col-sm-offset-2">
            <select class="form-control" required="" name="designation">
              <option value=""> ------------------- Select Designation ------------------- </option>
              <?php  while($rows=mysqli_fetch_array($result))
                      { ?>
 
                    <option value="<?php echo $rows['id']; ?> "> <?php echo $rows['name']; ?> </option>

              <?php  } ?>             
            </select>
            
          </div> 
        </div> 
         <div class="form-group"> 
          <div class="col-sm-8 col-sm-offset-2 autocomplete">        
            <input id="myInput" type="text" name="under" placeholder="Employee Under" required>
          </div> 
        </div>

        <div class="form-group"> 
          <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3"> 
            <button type="submit" id="submit" name="btn-save" class="btn-lg btn-primary mh_pl_ol">Submit</button>
          </div> 
        </div> 
        <!--end Form-->

          </form>


        </center>


      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>
</div>
</div>
<div class="footer">
 <div class="container">
   <p class="text-center">Copyright To MansaInfotech. All Rights Reserved</p>
 </div>
</div>
<?php 
 $sql_q = 'SELECT * FROM `user`';
  $name = mysqli_query($connec, $sql_query);
  $names = array();
  while($nam = mysqli_fetch_array($name)){
    $names[]=$nam['name'];
  }
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="jquery-simple-pagination-plugin.js"></script>
<script>
(function($){


$('#third-container').simplePagination({
  items_per_page: 5
});

})(jQuery);
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-48624238-1', 'ddenhartog.github.io');
  ga('send', 'pageview');
</script>
</body>
</html>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
}



/*An array containing all the country names in the world:*/
var countries =

<?php echo '["';
      echo implode( '","', $names );
      echo '"];';
?>

 

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>
<script type="text/javascript">
  $(document).on("click",".delete",function(){
    var this_ = $(this);
      var id = $(this).attr("value");
      $.ajax({
                  url: "delEmail.php",  
                  type: "POST",            
                  data:  {id:id},  
                  success: function(data){ 
                  this_.closest('tr').hide();
                  }         
        }); 
  });
function validFname()
{
	   var name = /^[A-Za-z]+$/;
	   var fname= document.getElementById("name").value;
	   if(!name.test(fname))
	   {
	      document.getElementById("name").focus();;
	        document.getElementById("fname").innerHTML = " * Please Enter only Alphabets";
	     
	   }
	  else{
	      
	      document.getElementById("fname").innerHTML = " ";
	      
	    }  
  
}
</script>

<?php ob_flush(); ?>
