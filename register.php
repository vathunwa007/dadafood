<!-- ส่วนของphpไม่ต้องไปยุ้งกับมันเลยนะ  -->                        
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="regis.php";
  $loginUsername = $_POST['name'];
  $LoginRS__query = sprintf("SELECT name FROM member WHERE name=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Myconnect, $Myconnect);
  $LoginRS=mysql_query($LoginRS__query, $Myconnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$level = 0 ;
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO member (name, password, email, tell, myname, level) VALUES (%s, %s, %s, %s, %s, 0)",
                       GetSQLValueString($_POST['uName'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['tell'], "int"),
                       GetSQLValueString($_POST['MyName'], "text"),
                       GetSQLValueString($level['level'], "int"));

  mysql_select_db($database_Myconnect, $Myconnect);
  $Result1 = mysql_query($insertSQL, $Myconnect) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!-- ด้านล่างนี้ทั้งหมดจะเป็นส่วนของโค้ด<html ที่จะแสดงผลหน้าเว็บทั้งหมด>                    -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DaDaFood TamSung</title>
  <!-- Latest compiled and minified CSS -->
  <?php include ('sublimeboostrap.php');?>
  <!-- ด้านล่างนี้ในส่วน tag style คือภาษาCss -->
  <style>
  body{   /*ตกแต่งในส่วนของtag <body> */
    /*background-color:#ffc39a75;/*รูปภาพพื้นหลังอยู่ในส่วนนี้*/
    background:url("http://streetwill.co/uploads/post/photo/607/medium_lSej-dyO_nwT-2ZT9vwzFmNUpQ49gjkv-fZicofmrOs.jpg");
    background-size:cover;
    background-position:center;
    
  }

  
</style>

</head>

<!--  ส่วนของbody คือหน้าเว็บทั้งหมดที่แสดงผลบนหน้าจอ เราต้องตกแต่งในส่วนนี้ -->
<body>
</br>
</br>
<div class="container" id="hide">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-5" style="background-color:#f16f6fd6">
      <center>
        <a href="index.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"style="color:white"></span> สมัครสมาชิค 
        </a>
      </br>
    </br>
    <form id="form1" name="form1" method="POST"class="form-horizontal" action="<?php echo $editFormAction; ?>">
      
      <div class="form-group">
        <div class="col-sm-12">
          <label for="MyName"style="color:white">ชื่อ นามสกุล:</label>
          <input type="text"  name="MyName" id="MyName"class="form-control" required placeholder="ชื่อ-สกุล" />
        </div>
      </div><!-- brคือขึ้นบรรทัดใหม่ -->
      <div class="form-group">
        <div class="col-sm-12">
          <label for="uName"style="color:white">Username:</label>
          <input type="text"  name="uName" id="uName"class="form-control" required placeholder="Username" />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12">
          <label for="Password"style="color:white">Password:</label>
          <input type="password"  name="Password" id="Password"class="form-control" required placeholder="Password" />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12">
          <label for="Email"style="color:white">Emai:</label>
          <input type="text"  name="Email" id="Email"class="form-control" required placeholder="Emai" />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12">
          <label for="tell"style="color:white">Telephone</label>
          <input type="text"  name="tell" id="tell"class="form-control" required placeholder="Telephone" />
        </div>
      </div>
      <input type="submit" name="btnRegister"class="btn btn-danger"id="btnRegister" value="กดเพื่อสมัคร" />
    </p>
    <input type="hidden" name="MM_insert" value="form1" />
  </br>
</form>
</body>
</html>