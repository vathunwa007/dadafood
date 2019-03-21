<?php 
session_start();
require_once('Connections/Myconnect.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['orderid'])) {
  $colname_Recordset1 = $_GET['orderid'];
  $_SESSION['orderid'][]=$_GET['orderid'];
  $_SESSION['orderid']=array_unique($_SESSION['orderid']);
  $_SESSION['item']['item'.$_GET['orderid']]=1;
}

if(!empty($_POST['btndel'])){ //การลบข้อมูล
	foreach($_POST['del']as $v){
		$del = array_search($v,$_SESSION['orderid']);
		unset($_SESSION['orderid'][$del]);
	}
}

if(count($_SESSION['orderid'])<1){
	header("location:view=order.php");
	exit;
}

mysql_select_db($database_Myconnect, $Myconnect);
$allOrder=implode(',',$_SESSION['orderid']);
$query_Recordset1 = sprintf("SELECT * FROM food WHERE id in($allOrder)");
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$item = (empty($_POST['item'])?1:$_POST['item']);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="600" border="1">
    <tr>
      <td>รหัสสินค้า</td>
      <td>ชื่อสินค้า</td>
      <td>ราคาต่อชิ้น</td>
      <td>จำนวนสั่งซื้อ</td>
      <td>ราคารวม</td>
      <td>ลบรายการ</td>
    </tr>
    <?php
	while($row_Recordset1 = mysql_fetch_assoc($Recordset1)){
		  $nameitem='item'.$row_Recordset1['id'];
		  $item=$_SESSION['item'][$nameitem];
		  if(!empty($_POST[$nameitem])){
			  $_SESSION['item'][$nameitem]=$_POST[$nameitem];
			  $item=$_POST[$nameitem];
			  }
		
	?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['food']; ?></td>
      <td><?php echo $row_Recordset1['price']; ?></td>
      <td><select name="item<?php echo $row_Recordset1['id']; ?>" id="item">
        <option value="1" <?php if (!(strcmp(1, $item))) {echo "selected=\"selected\"";} ?>>1</option>
        <option value="2" <?php if (!(strcmp(2, $item))) {echo "selected=\"selected\"";} ?>>2</option>
        <option value="3" <?php if (!(strcmp(3, $item))) {echo "selected=\"selected\"";} ?>>3</option>
        <option value="4" <?php if (!(strcmp(4, $item))) {echo "selected=\"selected\"";} ?>>4</option>
      </select></td>
      <td><input name="total" type="text" id="total" value="<?php echo $row_Recordset1['price']*$item; ?>" /></td>
      <td><input type="checkbox" name="del[]" id="del[]"value="<?php echo $row_Recordset1['id'];?>"/></td>
    </tr>
    <?php
	}
	?>
    <tr>
      <td>ราคารวมทั้งหมด</td>
      <td><input type="text" name="totalbuy" id="totalbuy" /></td>
      <td><a href="order.php">เลือกสินค้าเพิ่มเติม</a></td>
      <td><input type="submit" name="btncal" id="btncal" value="คำนวนราคา" /></td>
      <td><input type="submit" name="btnbuy" id="btnbuy" value="สั่งซื้อทั้งหมด" />
      <input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $_SESSION['MM_Username']; ?>" /></td>
      <td><input type="submit" name="btndel" id="btndel" value="ลบ" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
