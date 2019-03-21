<?php
error_reporting( error_reporting() & ~E_NOTICE );
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
	date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand()); 


	$name =$_POST["name"];
	$massage =$_POST["massage"];
  //รับชื่อไฟล์มาจากฟอร์ม
	$img = (isset($_POST['img']) ? $_POST['img'] : '');
 //เริ่มทำการอัพโหลดไฟล์
	$upload=$_FILES['img'];
	if($upload <> '') { 

	//โฟลเดอร์ที่เก็บไฟล์
		$path="img-sentmasage/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
		$type=strrchr($_FILES['img']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
		$newname =$numrand.$date1.$type;

		$path_copy=$path.$newname;
		
	//คัดลอกไฟล์ไปยังโฟลเดอร์
		move_uploaded_file($_FILES['img']['tmp_name'],$path_copy);  
		
		
	}

	mysql_db_query($database_Myconnect, "BEGIN"); 
	$sql1 = "INSERT  INTO massage
	(name,massage,image)
	VALUES
	(  
	'$name',
	'$massage',
	'$newname'
	
)";

$query1	= mysql_db_query($database_Myconnect, $sql1) or die ("Error in query: $sql1 " . mysql_error());

if($query1){
	mysql_db_query($database_Myconnect, "COMMIT");
	$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
}
else{
	mysql_db_query($database_Myconnect, "ROLLBACK");  
	$msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";	
}

mysql_close($Myconnect);
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='order.php';
</script>