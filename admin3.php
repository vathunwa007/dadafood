<?php require_once('Connections/Myconnect.php'); ?>
<?php require("sessionadmin.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset1 = "SELECT * FROM name_buyorder  Inner Join name_buy  ON name_buyorder.order_id = name_buy.order_id";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset2 = "SELECT * FROM massage";
$Recordset2 = mysql_query($query_Recordset2, $Myconnect) or die(mysql_error());

$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
<!DOCTYPEhtml>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/lightbox.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<link rel="stylesheet" href="bootstrap/css/lightbox.css">
  <script src="bootstrap/js/lightbox-plus-jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
   <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> 
  </script>
  <script>
    lightbox.option({
      'resizeDuration': 200,
      'showImageNumberLabel': true
    })
  </script>
	<title>Admin3</title>
	<style>
  body { padding-top: 55px; background-color: #f5efef;font-family: 'Kanit', sans-serif;}
  
  #B2{
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
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 style="text-align: center;">รายการสั่งอาหาร</h3>						
					</div>
					<div class="panel-body">			
  
  <div class="tableresponsive">
  <div class="row">
    <div class="col-md-15%">
      <table width="100%"height="208"border="0" class="table table-hover">
                     <p style="height:30px;text-align: center;bottom:0px;background-color:#4aa7a9;width:100%;color:#FFFFFF;"><strong><b>รายการอาหารที่สั่ง</span></strong>
        </p>        
         <thead>
      <tr class="danger">
    <td >ลำดับที่</td>
    <td >ชื่อลูกค้า</td>
    <td >อาหารที่สั่ง</td>
    <td >จำนวน</td>
    <td >ราคา</td>
    <td >หมายเหตุ</td>
    
  </tr>
   </thead>
  <?php do { ?>
    <tr>
      <td data-title="ลำดับที่"><?php echo $row_Recordset1['order_id']; ?></td>
      <td data-title="ชื่อลูกค้า"><?php echo $row_Recordset1['name']; ?></td>
      <td data-title="อาหารที่สั่ง"><?php echo $row_Recordset1['food']; ?></td>
      <td data-title="จำนวน"><?php echo $row_Recordset1['many']; ?></td>
      <td data-title="ราคา"><?php echo $row_Recordset1['total']; ?></td>
      <td data-title="หมายเหตุ"><?php echo $row_Recordset1['note']; ?></td>
      
    </tr>

    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</div>
</div>
</div>



					</div>	
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 style="text-align: center;">ที่ชำระเงินแล้ว</h3>						
					</div>
					<div class="panel-body">	
  
  <div class="tableresponsive">
    <div class="row">
      <div class="col-md-15%">

        <table width="100%"height="208"border="0" class="table table-hover">
          <p style="height:30px;text-align: center;bottom:0px;background-color:#4aa7a9;width:100%;color:#FFFFFF;"><strong><b>รายการลูกค้าที่ชำระเงินแล้ว</span></strong>
          </p>        
          <thead>
            <tr class="danger">
              <td>ชื่อลูกค้า</td>
              <td>หมายเหตุ</td>
              <td>รูปสลิป</td>
              <td>แก้ไข</td>
            </tr>
          </thead>
          <?php do { ?>
            <tr class"Default">
              
              <td data-title="ชื่อลูกค้า">
                <?php echo $row_Recordset2['name']; ?>
              </td>
              <td data-title="หมายเหตุ">
                <?php echo $row_Recordset2['massage']; ?>
              </td>

              <td data-title="รูปสลิป">
                <div class="gallery"><a href="img-sentmasage/<?php echo $row_Recordset2['image']; ?>"data-lightbox="mygallery"data-title="<?php echo $row_Recordset2['name']; ?></br><?php echo $row_Recordset2['date']; ?>"><img src="img-sentmasage/<?php echo $row_Recordset2['image']; ?>"width="120" height="129"></a></div>

              </td>
              <td data-title="แก้ไข">
                <a href="admin2.php?id=<?=$row_Recordset2['id']?>"class='btn btn-danger btn-xs'>ลบ</a>

              </td>

            </tr>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        </table>

    	
					</div>						
				</div>
			</div>
		</div>
<?php include('footersadmin.php'); ?>
<?php include('sublimescrip.php'); ?>
			




</body>
</html>