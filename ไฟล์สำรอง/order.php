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
$query_Recordset1 = "SELECT * FROM food";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$query_Recordset1 = "SELECT * FROM food WHERE typeid = 1111";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php include ('sublimeboostrap.php');?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        
    <style type="text/css">
    

    </style>
    </head>

    <body>
    <?php include('sublimemenu.php'); ?>
        
    <div class="row"><br />
      <?php do { ?>
      <div class="col-sm-3"><img src="image/<?php echo $row_Recordset1['image']; ?>" width="294" height="178" />
   
        <br />
        
        <a href="buyorder.php?orderid=<?php echo $row_Recordset1['id']; ?>">สังซื้อ</a><br />
        ชื่อ:<?php echo $row_Recordset1['food']; ?><br />
          ราคา:<?php echo $row_Recordset1['price']; ?>บาท<br />
      </div> 
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<br />
    </div>
    <?php include('sublimescrip.php'); ?>
    </body>

    </html>
    <?php
mysql_free_result($Recordset1);
?>
