<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start();  
$_SESSION['sess_name'] =$_POST["name"];

	// echo "<pre>";
	// print_r($_SESSION);
	// echo "<hr>";
	// print_r($_POST);
	// echo "</pre>";

?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Confirm</title>
</head>
<body>
	<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
	<?php
	
	require_once('Connections/Myconnect.php');

//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
	date_default_timezone_set('Asia/Bangkok');
	

	$name = $_POST["name"]; 
	$note = $_POST["note"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$many = $_POST["many"];
	$sumtotal = $_POST["total"];
	$order_date = date("Y-m-d H:i:s");
	$status = 1;
	

	
	//บันทึกการสั่งซื้อลงใน order_detail
	mysql_db_query($database_Myconnect, "BEGIN"); 
	$sql1 = "INSERT  INTO name_buy VALUES
	(NULL,  
	'$name',
	'$note',
	'$email',
	'$phone',
	'$sumtotal',
	'$order_date' 
)";

$query1	= mysql_db_query($database_Myconnect, $sql1) or die ("Error in query: $sql1 " . mysql_error());




$sql2 = "SELECT MAX(order_id) AS order_id FROM name_buy  WHERE phone='$phone'";
$query2	= mysql_db_query($database_Myconnect, $sql2);
$row = mysql_fetch_array($query2);
$order_id = $row['order_id'];


foreach($_SESSION['shopping_cart'] as $id=>$many)
	
{
	$sql3	= "SELECT * FROM food where id=$id";
	$query3 = mysql_db_query($database_Myconnect, $sql3);
	$row3 = mysql_fetch_array($query3);
	$total=$row3['price']*$many;
	$food=$row3['food'];
	
	
	
	$sql4	= "INSERT INTO  name_buyorder 
	values(null, 
	'$order_id', 
	'$id', 
	'$many', 
	'$total',
	'$food')";
	$query4	= mysql_db_query($database_Myconnect, $sql4);
}

if($query1 && $query4){
	mysql_db_query($database_Myconnect, "COMMIT");
	$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
	foreach($_SESSION['shopping_cart'] as $id)
	{	
		unset($_SESSION['shopping_cart']);
	}
}
else{
	mysql_db_query($database_Myconnect, "ROLLBACK");  
	$msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";	
	
}

mysql_close($Myconnect);
?>


<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='sent.php';
</script>

</body>
</html>