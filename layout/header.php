<div class="header_logo">
  <div class="container ">

      
    <?php

    if(empty($_SESSION['id'])) 
    {
    ?>
  
    <div class="col-md-6 text-left">
      <img src="images/logo.gif" />
    </div>

    <div class="col-md-6 text-right muy_ol">
      <div class="align_btns text-right"><a href="index.php" class="btn btn-danger btn-lg">Login</a></div>
    
    </div>
   
    <?php
    }
    else
    {
    ?>
     <div class="col-md-6 col-sm-6 col-xs-6 text-left">
      <img src="../images/logo.gif" />
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 text-right  muy_ol ">
             <div class="align_btns text-right"><a href="../logout_session.php" class="btn btn-danger btn-lg"> 
      Log out

        </a></div>

    </div>
    <?php
    }
    ?>
  </div>
</div>
