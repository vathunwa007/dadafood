<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start();  
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="bootstrap/css/lightbox.css">
  <script src="bootstrap/js/lightbox-plus-jquery.js"></script>
  <title>DaDaFood TamSung</title>
  <!-- Latest compiled and minified CSS -->
  <?php include ('sublimeboostrap.php');?>
</head>
<body>
<?php include("navbaruser.php") ?>

<div class="gallery"align="center">
  <h2>แจ้งชำระค่าอาหาร</h2>
    <a href="image/bank.jpg"data-lightbox="mygallery"><img src="image/bank.jpg""width="300" height="250"></a>
  </div>

</br>
</br>
  <div class="container" id="hide">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-5" style="background-color:#f4f4f4">
        <h3 align="center" style="color:#FF0066">
          <span class="glyphicon glyphicon-usd"> </span>
        ยืนยันการชำระเงิน </h3>
        <form  name="form1" action="savepayment.php" method="POST" enctype="multipart/form-data"id="form1" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-12">
             <label for="exampleInputFile">กรอกชื่อ นามสกุลให้ตรงกับการยืนยันสั่งซื้อ</label>
             <input type="text"  name="name" value="<?php echo $_SESSION['sess_name']; ?>"class="form-control" required placeholder="ชื่อ-สกุล" />
           </div>
         </div>
         <div class="form-group">
          <div class="col-sm-12">
            <label for="exampleInputFile">กรุณาใส่รูปสลิปธนาคาร</label>                         
            <input type="file" name="img" id="img">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
           <label for="exampleInputFile">กรุณากรอกข้อมูลเช่นเวลากี่โมงธนาคารอะไร</label>
           <textarea name="massage" class="form-control"  rows="3"  required placeholder="กรอกข้อมูลรายละเอียดการโอน"></textarea> 
         </div>

       </div>

       <div class="form-group">
        <div class="col-sm-12" align="center">
          <button type="submit" class="btn btn-primary" id="btn">
          ยืนยันสั่งซื้อ </button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <hr/>
      <?php  include('footersuser.php'); ?>
    </div>
  </div>
</div>
<?php include('sublimescrip.php'); ?>
</body>
</html>