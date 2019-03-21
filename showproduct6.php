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
$query_Recordset1 = "SELECT * FROM food WHERE typeid = 6666";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<style type="text/css">
.center {
	text-align: center;
	
}
.btn  {
  width: 60px;
  margin: 0 auto;
  display: block;
}
#B6{
  color: #fff;
    background-color: #f55454;
}
.navbar {
    background-color: #d6225fe6;
        border-color: #ce0b0b;
}

.navbar-inverse .navbar-nav>.active>a,
.navbar-inverse .navbar-nav>.active>a:focus,
.navbar-inverse .navbar-nav>.active>a.pg-state-focus,
.navbar-inverse .navbar-nav>.active>a:hover,
.navbar-inverse .navbar-nav>.active>a.pg-state-hover,
.pg-node-id-1046 {
    color: #fff;
    background-color: #f55454;
}

.navbar-inverse .navbar-nav>li>a,
.pg-node-id-1044 {
    color: #040101;
}

.navbar-inverse .navbar-brand,
.pg-node-id-1041 {
    color: #fdfafa;
}
.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
    color: #000000;
}
body {
    font-family: 'Kanit', sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #ad222b14;
}
</style>

<div>
 <h1 class="center">ข้าวไข่เจียว</h1>
</div>
<p class="mb-0 text-center">รวมเมนูข้าวไข่เจียวสุดเด็ดทั้งหมดไว้ที่นี้แล้ว.</p> 
<?php do { ?>
  <div class="col-sm-3"style="border-width:5px;border-radius: 10px;background-color: white; border-style:solid; border-color:#e43f89ab"><br><img src="image/<?php echo $row_Recordset1['image']; ?>" width="100%" height="200" />
   
    <br />
    
    
    ชื่อ:<?php echo $row_Recordset1['food']; ?>
    <font color="#0033CC">
      ราคา:<?php echo number_format($row_Recordset1['price'],2); ?>บาท
    </font><br />
    <?php echo "<a href='buyorder.php?id=$row_Recordset1[id]&act=add'class='btn btn-info btn-sm'>สั่งซื้อ</a>"; ?><br />
  </div> 
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<br />
</div>


</html>
<?php
mysql_free_result($Recordset1);
?>
