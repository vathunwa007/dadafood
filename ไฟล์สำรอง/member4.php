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

$query_Food1 = "SELECT * FROM food WHERE typeid = 4444";
$Food1 = mysql_query($query_Food1, $Myconnect) or die(mysql_error());
$row_Food1 = mysql_fetch_assoc($Food1);
$totalRows_Food1 = mysql_num_rows($Food1);

include"Connections/inmember.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Starter Template for Bootstrap</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>.navbar {
    background-color: #e91e637a;/*#ffeb3b  */
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
    color: #d82121;
}
body {
	background:url("https://images.unsplash.com/photo-1508717272800-9fff97da7e8f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=1386fac369f0098fad80b590a22c1ef6&auto=format&fit=crop&w=1351&q=80");
	background:cover;
	}
</style>
    </head>
<body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">DADAFOOD</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="member.php">เมนูผัดกะเพรา</a>
                        </li>
                        <li>
                            <a href="member2.php">เมนูข้าวผัด</a>
                        </li>
                        <li>
                            <a href="member3.php">เมนูผัดพริกเผา</a>
                        </li>
                        <li class="active">
                            <a href="member4.php">เมนูผัดกระเทียม</a>
                        </li>
                        <li>
                            <a href="member5.php">เมนูผัดผัก</a>
                        </li>
                        <li>
                            <a href="member6.php">เมนูข้าวไข่เจียว</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a>ยินดีต้อนรับ:<?php echo $_SESSION['MM_Username']; ?> เข้าสู้ร้าน นะ</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> รวมอาหารที่สั่ง</a>
                        </li>
                        <li>
                            <a href="<?php echo $logoutAction ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">ติดต่อ <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">แจ้งชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="#">ฝ่ายทำการผลิต</a>
                                </li>
                                <li>
                                    <a href="#">เวอร์ชั่น</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="starter-template">
                <h1 class="text-center"><u><i><b>เมนูผัดกระเทียม</b></i></u></h1>
                <p class="lead text-center">รวมเมนูผัดกระเพราสูตรเด็ด เผ็ดติดมันไว้ที่นี้</p>
            </div>
        </div>
        <table width="500" height="123" border="2" align="center" class="table">
          <tr>
           
            <td class="bg-danger">อาหาร</td>
            <td class="bg-danger">ชื่อเมนูอาหาร</td>
            <td class="bg-danger">ราคา</td>
            <td class="bg-danger">&nbsp;</td>
          </tr>
          <?php do { ?>
            <tr>
             
              <td><img src="image/<?php echo $row_Food1['image']; ?>" width="187" height="67"></td>
              <td><?php echo $row_Food1['food']; ?></td>
              <td><?php echo $row_Food1['price']; ?></td>
              <td>สั่งซือ</td>
            </tr>
            <?php } while ($row_Food1 = mysql_fetch_assoc($Food1)); ?>
        </table>
</html>
<?php
mysql_free_result($Food1);
?>
