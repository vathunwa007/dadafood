<?php require_once('Connections/Myconnect.php'); ?>
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
$query_Recordset1 = "SELECT name_buy.order_id, name_buy.name, name_buy.phone, name_buy.order_date, name_buyorder.p_qty, name_buyorder.total, food.food FROM name_buy, name_buyorder, food WHERE name_buyorder.id ORDER BY name_buyorder.id, name_buy.order_id";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
  </form>
  <table border="2">
    <tr>
      <td>order_id</td>
      <td>name</td>
      <td>phone</td>
      <td>order_date</td>
      <td>p_qty</td>
      <td>total</td>
      <td>food</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['order_id']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['phone']; ?></td>
        <td><?php echo $row_Recordset1['order_date']; ?></td>
        <td><?php echo $row_Recordset1['p_qty']; ?></td>
        <td><?php echo $row_Recordset1['total']; ?></td>
        <td><?php echo $row_Recordset1['food']; ?></td>
      </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
