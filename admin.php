<?php require_once('Connections/Myconnect.php'); ?>
<?php require("sessionadmin.php"); ?>
<?php error_reporting( error_reporting() & ~E_NOTICE ); ?>
<?php mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset2 = "SELECT * FROM name_buy";
$Recordset2 = mysql_query($query_Recordset2, $Myconnect) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$del=mysql_query("DELETE FROM name_buy WHERE order_id=" .$_GET['order_id']);
$del=mysql_query("DELETE FROM name_buyorder WHERE order_id=" .$_GET['order_id']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/lightbox.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <script src="bootstrap/js/lightbox-plus-jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    lightbox.option({
      'resizeDuration': 200,
      'showImageNumberLabel': true
    })
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      setInterval(function(){
// 1 วินาที่ เท่า 1000  
 $("#loading_img_spin").show(); //แสดงรูปภาพ loading
 $("#divShowData").load("showadmin.php",function(responseTxt,statusTxt,xhr){
   if(statusTxt=="success") //หากดึงข้อมูลมาแสดงสำเร็จ
     $("#loading_img_spin").hide(); //ซ่อนรูปภาพ loading
 });
},3000);  

    });
  </script>
  
  <style>
  

  body { padding-top: 30px; background-color: #f5efef;font-family: 'Kanit', sans-serif;}
  
  #B0{
    color: #fff;
    background-color: #56c3bd;
  }
  .navbar-inverse {
    background-color: #4aa7a9;
    border-color: #55c2c3;
  }
  .navbar-inverse .navbar-nav>li>a,
  .pg-node-id-1044 {
    color: #fff;
  }

  .navbar-inverse .navbar-brand,
  .pg-node-id-1041 {
    color: #fff;
  }
  .navbar-inverse .navbar-toggle {
    border-color: #00BCD4;
  }
  .wrap {
    width: 938px;
    height: 280px;
    overflow: hidden;
    margin: auto;
    cursor: -webkit-grab;
  }
  .navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
    color: #0a0a0a;
}

</style>

</head>
<body>

  <?php include("navbaradmin.php") ?>
  
  <center>
   <img src="image/loading.gif" id="loading_img_spin" style="display:none;position:absolute;left:60%;top:40%;" />
 </center>

 <div id="divShowData">
   
 </div>
 <?php include('footersadmin.php'); ?>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <?php include('sublimescrip.php'); ?>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 
</body>
</html>
<?php
mysql_free_result($Recordset2);
?>

