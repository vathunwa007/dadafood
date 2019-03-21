<meta charset="UTF-8" />

<?php 

require_once('Connections/Myconnect.php');

    //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
	
	//รับชื่อไฟล์จากฟอร์ม 
	$order = $_POST['order'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$img = (isset($_POST['img']) ? $_POST['img'] : '');
 //เริ่มทำการอัพโหลดไฟล์
	$upload=$_FILES['img'];
	if($upload <> '') { 

	//โฟลเดอร์ที่เก็บไฟล์
		$path="image/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
		$type=strrchr($_FILES['img']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
		$newname =$numrand.$date1.$type;

		$path_copy=$path.$newname;
		
	//คัดลอกไฟล์ไปยังโฟลเดอร์
		move_uploaded_file($_FILES['img']['tmp_name'],$path_copy);  
		
		
	}

             mysql_db_query($database_Myconnect);
			 $sql = "INSERT INTO food 
					(typeid,image,food,price) 
					VALUES
					(
					'$order',
					'$newname',
					'$name',
					'$price'
					)";
		
		$result = mysql_db_query($database_Myconnect,$sql) or die ("Error in query: $sql " . mysql_error());

//เป็นจาวาสคิปเมื่อเพิ่มข้อมูลสำเร็จให้กระโดดไปไฟล์  abc 
	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มรายการเรียบร้อย');";
			echo "window.location='admin3.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				echo  "alert('Error!');";
				echo "window.location='admin3.php';";
			echo "</script>";
	  }
	
	mysql_close($database_Myconnect);

 ?>