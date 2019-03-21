<?php
require_once('Connections/Myconnect.php');


$id = $_GET['id'];
$strSQL = "DELETE FROM `food` WHERE `food`.`id` = '".$id."' "; //FROM food Inner Join order_food ON food.typeid= order_food.typeid
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "<script type='text/javascript'>";
			echo  "alert('ลบรายการเรียบร้อย');";
			echo "window.location='admin3.php';";
			echo "</script>";
}
else
{
	echo "<script type='text/javascript'>";
				echo  "alert('Error Delete [".$strSQL."]');";
				echo "window.location='admin3.php';";
			echo "</script>";
}
?>