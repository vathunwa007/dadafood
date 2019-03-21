<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start(); 
$id = $_REQUEST['id']; 
$act = $_REQUEST['act'];

if($act=='add' && !empty($id))
{
	if(!isset($_SESSION['shopping_cart']))
	{
		
		$_SESSION['shopping_cart']=array();
	}else{
		
	}
	if(isset($_SESSION['shopping_cart'][$id]))
	{
		$_SESSION['shopping_cart'][$id]++;
	}
	else
	{
		$_SESSION['shopping_cart'][$id]=1;
	}
}

	if($act=='remove' && !empty($id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['shopping_cart'][$id]);
	}

	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $id=>$amount)
		{
			$_SESSION['shopping_cart'][$id]=$amount;
		}
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>DaDaFood TamSung</title>
		<!-- Latest compiled and minified CSS -->
		<?php include ('sublimeboostrap.php');?>
	</head>

	<body>
		<?php include("navbaruser.php");?>
		<br>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-7%">
					<form id="frmcart" name="frmcart" method="post" action="?act=update">
						<table width="100%" border="0" align="center" class="table table-hover">
							<tr>
								<td height="40" colspan="7" align="center" bgcolor="#CCCCCC"><strong><b>รวมอาหารที่สั่ง</span></strong></td>
								</tr>
								<tr>
									<td align="center" bgcolor="#EAEAEA"><strong>No.</strong></td>
									<td align="center" bgcolor="#EAEAEA"><strong>image</strong></td>
									<td align="center" bgcolor="#EAEAEA"><strong>สินค้า</strong></td>
									<td align="center" bgcolor="#EAEAEA"><strong>ราคา</strong></td>
									<td align="center" bgcolor="#EAEAEA"><strong>จำนวน</strong></td>
									<td align="center" bgcolor="#EAEAEA"><strong>รวม/รายการ</strong></td>
									<td align="center" bgcolor="#EAEAEA"><strong>ลบ</strong></td>
								</tr>
								<?php

								if(!empty($_SESSION['shopping_cart']))
								{
									require_once('Connections/Myconnect.php');
									foreach($_SESSION['shopping_cart'] as $id=>$many)
									{
										$sql = "select * from food where id=$id";
										$query = mysql_db_query($database_Myconnect, $sql);
										while($row = mysql_fetch_array($query))
										{
											
											$sum = $row['price'] * $many;
											$total += $sum;
											echo "<tr>";
											echo "<td align='center'>";
											echo $i += 1;
											echo ".";
											echo "</td>";
											echo "<td width='100'>"."<img src='image/$row[image]'  width='50'/>"."</td>";
											echo "<td width='334'align='center'>"." " . $row["food"] . "</td>";
											echo "<td width='100' align='center'>" . number_format($row["price"],2) . "</td>";
											
											echo "<td width='57' align='right'>";  
											echo "<input type='text' name='amount[$id]' value='$many' size='2'/></td>";
											
											echo "<td width='100' align='right'>" .number_format($sum,2)."</td>";
											echo "<td width='100' align='center'><a href='buyorder.php?id=$id&act=remove' class='btn btn-danger btn-xs'>ลบ</a></td>";
											
											echo "</tr>";
										}
										
									}
									echo "<tr>";
									echo "<td colspan='5' bgcolor='#CEE7FF' align='right'>Total</td>";
									echo "<td align='right' bgcolor='#CEE7FF'>";
									echo "<b>";
									echo  number_format($total,2);
									echo "</b>";
									echo "</td>";
									echo "<td align='left' bgcolor='#CEE7FF'></td>";
									echo "</tr>";
								}
								?>
								<tr>
									<td></td>
									<td colspan="7" align="right">
										<a href="order.php" class="btn btn-primary"style="float:left;">กลับไปเลือกเมนู</a> 
										<button type="submit" name="button" id="button" class="btn btn-warning"style="float:left;"> คำนวณราคา </button>
										<button type="button" name="Submit2"  onclick="window.location='confirm.php';" class="btn btn-primary"> 
											<span class="glyphicon glyphicon-shopping-cart"> </span> สั่งซื้อ </button>
										</td>
									</tr>

								</form>
								
							</div>
						</div>
					</div>
				</div>

			</table>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<hr/>
						<?php  include('footersuser.php'); ?>
					</div>
				</div>
			</div>

			<?php include('sublimescrip.php'); ?>

		</body>

		</html>