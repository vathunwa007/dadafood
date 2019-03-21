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

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset1 = "SELECT * FROM member";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>จัดการแอดมิน</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
  body { padding-top: 60px; background-color: #f5efef;font-family: 'Kanit', sans-serif;}
  
  #B3{
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
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">คำเตือน!</h4>
  <p>กรุณาเช็คข้อมูลส่วนตัวของท่านให้แน่ใจก่อนทำการแก้ไข โปรดระวังผู้ใช้งานหรือบุคคลรอบข้างแอบขโมยพาสเวิดร์ของท่าน.</p>
  <hr>
  <p class="mb-0">ข้อมูลทั้งหมดนี้เป็นข้อมูลแอดมินแบบเปิดเผยในเวอร์ชั้นทดลอง!.</p>
</div>

<table class="table table-striped table-dark" border="1" align="center">
  <thead class="thead-dark">
  <tr class="bg-danger">
    <td>id</td>
    <td>Username</td>
    <td>password</td>
    <td>email</td>
    <td>Tellaphone</td>
    <td>Myname</td>
    <td>LevelAdmin</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['name']; ?></td>
      <td><?php echo $row_Recordset1['password']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['tell']; ?></td>
      <td><?php echo $row_Recordset1['myname']; ?></td>
      <td><?php echo $row_Recordset1['level']; ?></td>
      <td><a href="updateadmin.php?id=<?php echo $row_Recordset1['id']; ?>">แก้ไข</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?php include('footersadmin.php'); ?>
<?php include('sublimescrip.php'); ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
