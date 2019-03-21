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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE member SET name=%s, password=%s, email=%s, tell=%s, myname=%s, `level`=1 WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['tell'], "int"),
                       GetSQLValueString($_POST['myname'], "text"),
                       GetSQLValueString($_POST['level'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Myconnect, $Myconnect);
  $Result1 = mysql_query($updateSQL, $Myconnect) or die(mysql_error());

  $updateGoTo = "admintool.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset2 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset2 = $_GET['id'];
}
mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset2 = sprintf("SELECT * FROM member WHERE id = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $Myconnect) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>อัพเดทข้อมูลแอดมิน</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
  body { padding-top: 55px; background-color: #f5efef;font-family: 'Kanit', sans-serif;}
  
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

<div class="form-group">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id:</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_Recordset2['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name:</td>
      <td><input class="form-control"type="text" name="name" value="<?php echo htmlentities($row_Recordset2['name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input class="form-control"type="text" name="password" value="<?php echo htmlentities($row_Recordset2['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input class="form-control"type="text" name="email" value="<?php echo htmlentities($row_Recordset2['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tell:</td>
      <td><input class="form-control"type="text" name="tell" value="<?php echo htmlentities($row_Recordset2['tell'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Myname:</td>
      <td><input class="form-control"type="text" name="myname" value="<?php echo htmlentities($row_Recordset2['myname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Level:</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;1</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info"type="submit" value="แก้ไข้ข้อมูลแอดมิน" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_Recordset2['id']; ?>" />
</form>
<p>&nbsp;</p>
<?php include('footersadmin.php'); ?>
<?php include('sublimescrip.php'); ?>
</body>
</html>
<?php
mysql_free_result($Recordset2);
?>
