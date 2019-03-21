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
$query_Recordset1 = "SELECT * FROM member";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Myconnect, $Myconnect);
  
  $LoginRS__query=sprintf("SELECT name, password, level FROM member WHERE name=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
  
  $LoginRS = mysql_query($LoginRS__query, $Myconnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'level');
    
    if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<html>
<head>
  <title>Login DaDaFood</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/styleindex.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <style>
  body {
    background-image: url("bootstrap/css/index.jpg");
  }     
</style>
</head>

<body>

<!---------------------------------------------------------------------->


  <div class="loginbox">
    <img src="bootstrap/css/avatar1.png" class="avatar">
    <h1>Login Here</h1>
    <form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">       
      <p>Username</p>
      <input type="text" name="username"id="username" placeholder="Enter Username">
      <p>Password</p>
      <input type="password" name="pass"id="login" placeholder="Enter Password">
      <input type="submit" name="login" value="Login">
      <a href="#">จำรหัสผ่านไม่ได้</a><br>
      <a href="register.php">สมัครสมาชิกใหม่</a>
    </form>
  </div>
</div>
  
  <div style="text-align: center;height:30px;position:fixed;left:0px;bottom:0px;width:100%;z-index: 99;
  color:#FFFFFF;" id="dwt-copyright">Copyright &copy; 2018 by AUNWA007</div>
</body>
</head>
</html>
<?php
mysql_free_result($Recordset1);
?>