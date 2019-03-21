<?php require_once('Connections/Myconnect.php'); ?>
<?php require("sessionadmin.php"); ?>
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
error_reporting( error_reporting() & ~E_NOTICE ); ?>
<?php mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset2 = "SELECT * FROM member";
$Recordset2 = mysql_query($query_Recordset2, $Myconnect) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordfood = "SELECT * FROM food Inner Join order_food ON food.typeid = order_food.typeid";
$Recordfood = mysql_query($query_Recordfood, $Myconnect) or die(mysql_error());
$row_Recordfood = mysql_fetch_assoc($Recordfood);
$totalRows_Recordfood = mysql_num_rows($Recordfood);

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin3</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/lightbox.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<style>


	body { padding-top: 50px; background-color: #f5efef;font-family: 'Kanit', sans-serif;}


	.navbar-inverse {
		background-color: #4aa7a9;
		border-color: #55c2c3;
	}
	.navbar-inverse .navbar-nav>li>a,
	.pg-node-id-1044 {
		color: #fff;
	}

	.navbar-inverse .navbar-brand,
	.pg-node-id-1041 {
		color: #fff;
	}
	.navbar-inverse .navbar-toggle {
		border-color: #00BCD4;
	}
	.wrap {
		width: 938px;
		height: 280px;


		0ท่overflow: hidd

		margin: auto;
		cursor: -webkit-grab;
	}
	.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
    color: #0a0a0a;
}

</style>


</head>
<body>
	<?php include('navbaradmin.php'); ?>

	
	<div class="container">
	<div class="row">
		<h3 style="text-align: center;">เพิ่มรายการอาหาร</h3>
		<div class="col-md-9 col-md-push-3">
			<div class="col-md-9 col-md-push-1" style="background-color:#f4f4f4">

				<form action="saveadmin3.php" method="POST" enctype="multipart/form-data"  name="addform" class="form-horizontal" id="addform">
					
						<div class="form-group">
							<label class="col-md-3" >เลือกประเภทเมนูอาหาร : </label>
							<div class="col-md-5" align="left">
								<label>
									<select name="order" id="order">
										<option value="1111">-ผัดกระเพรา-</option>
										<option value="2222">-ข้าวผัด-</option>
										<option value="3333">-ผัดพริกเผา-</option>
										<option value="4444">-ผัดกระเทียม-</option>
										<option value="5555">-ผัดผัก-</option>
										<option value="6666">-ข้าวไข่เจียว-</option>

									</select>
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2" align="left"> ชื่ออาหาร : </label>
							<div class="col-md-8" align="left">
								<input  name="name" id="name" type="text" required class="form-control"  placeholder="ชื่ออาหาร"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2" align="left"> ราคา : </label>
							<div class="col-md-8" align="left">
								<input  name="price" id="price" type="text" required class="form-control"  placeholder="ราคาอาหาร"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2" align="left">รูปภาพประกอบ</label>
							<div class="col-md-7" align="left">
								<input type="file" name="img" id="img" required accept="image/jpeg">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-2"> </div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary" id="btn"> เพิ่มรายการ
								</button>
							
					</form>

				</div>
			</div>
				<!-- <div class="container"> 
					<div class="row">
						<div class="col-md-4"> -->
					<table class="table table-hover" border="1">
						<thead>
						<tr class="success">
							<td>ลำดับ</td>
							<td>ประเภท</td>
							<td>ชื่ออาหาร</td>
							<td>ราคา</td>
							<td>แก้ไข</td>
							<td>ลบ</td>
						</tr>
					</thead>
						<?php do { ?>
							<tbody>
							<tr class="danger">
								<td><?php echo $row_Recordfood['id']; ?></td>
								<td><?php echo $row_Recordfood['order']; ?></td>
								<td><?php echo $row_Recordfood['food']; ?></td>
								<td><?php echo $row_Recordfood['price']; ?></td>
								<td>แก้ไข
								</td>
								<td><a href="saveadmin3delete.php?id=<?php echo $row_Recordfood['id']; ?>"class='btn btn-danger btn-xs'>ลบ</a></td>
							</tr>
							</tbody>
						<?php } while ($row_Recordfood = mysql_fetch_assoc($Recordfood)); ?>
					</table>
					</div>
						</div>
					</div>
				


					<?php include('sublimescrip.php'); ?>
				</body>
				</html>
				<?php
				mysql_free_result($Recordfood);
				?>
