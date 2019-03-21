<?php require_once('sessionmember.php'); ?>
<?php error_reporting( error_reporting() & ~E_NOTICE ); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DaDaFood Tamsung</title>
    <!-- Latest compiled and minified CSS -->
    <?php include ('sublimeboostrap.php');?>
</head>
<body>
  <!--start menu -->
  <?php include("navbaruser.php") ?>
<!-- close container-->
<!-- start show product -->
<div class="container">
  <div class="row">
    

      <?php include ('showproduct3.php');  ?>
      
  </div>
</div>
</div>
<!-- end show product -->

<!-- start footer-->
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <hr/>
        <?php  include('footersuser.php'); ?>
    </div>
</div>
</div>
<!-- end footer-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?php include('sublimescrip.php'); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

</body>
</html>