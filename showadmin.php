<?php require_once('Connections/Myconnect.php'); ?>
<?php
/* if (!function_exists("GetSQLValueString")) {
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
}*/

mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset1 = "SELECT * FROM name_buyorder  Inner Join name_buy  ON name_buyorder.order_id = name_buy.order_id";
$Recordset1 = mysql_query($query_Recordset1, $Myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        
     *{margin:0;padding:0;}
    
    .tableresponsive{
    
   
    margin:15px auto;
    }
     
    .tabledata{
    width:100%;
    padding:0;
    margin:0;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 13px;
    color:#9c9b99;
    }
    .tabledata thead tr th{
    background:#0eac38;
    color:#fff;
    text-align: center;
    padding:7px 5px;
    
    }
    .tabledata tbody tr td{
    padding:7px 5px;
    text-align: center;
    cursor:pointer;
    border-bottom: 1px solid #d6d6d6;
    }
    
    .tabledataa a{
    display:inline-block;
    border: 1px solid #189e3d;
    padding:5px;
    color:#a09a9a;
    background:#fff;
    -webkit-transition: all .25s ease-out;
    -moz-transition: all .25s ease-out;
    -ms-transition: all .25s ease-out;
    -o-transition: all .25s ease-out;
    transition: all .25s ease-out;     
    }
    .tabledataa a:hover{
    background:#189e3d;
    color:#fff;
    }   
    .tabledataa tbody tr:hover td{
    background:#7f7f7f;
    color:#fff;
    }
      
      
      
      
      
      @media only screen and (max-width: 430px) {
      
       .tableresponsive table,
       .tableresponsive thead, 
       .tableresponsive tbody, 
       .tableresponsive th, 
       .tableresponsive td, 
       .tableresponsive tr
       { 
       
          display:block ;
         
       }  
       
       .tableresponsive thead tr { 
        position: absolute ;
        top: -9999px;
        left: -9999px;
       }   
       .tableresponsive tr { border: 1px solid #ccc; }
 
       .tableresponsive td { 
    
           border: none;
           border-bottom: 1px solid #eee; 
           position: relative;
           padding-left: 45% !important; 
           white-space: normal;
           text-align:left;
           
        }
 
        .tableresponsive td:before { 
    
           position: absolute;
           top: 6px;
           left: 6px;
           width: 50%; 
           padding-right: 10px; 
           white-space: nowrap;
           text-align:left;
           font-weight: bold;
         }
 

        .tableresponsive td:before { content: attr(data-title); }
        
        }
   
   </style>
</head>

<body>
<div class="container" style="margin-top:50px">
  <h3 style="text-align: center;">รายการสั่งอาหาร</h3>
  <div class="tableresponsive">
  <div class="row">
    <div class="col-md-15%">
      <table width="100%"height="208"border="0" class="table table-hover">
                     <p style="height:30px;text-align: center;bottom:0px;background-color:#4aa7a9;width:100%;color:#FFFFFF;"><strong><b>รายการอาหารที่สั่ง</span></strong>
        </p>        
         <thead>
      <tr class="danger">
    <td >ลำดับที่</td>
    <td >ชื่อลูกค้า</td>
    <td >อาหารที่สั่ง</td>
    <td >จำนวน</td>
    <td >ราคา</td>
    <td >หมายเหตุ</td>
    <td >เบอร์ติดต่อ</td>
    <td></td>
  </tr>
   </thead>
  <?php do { ?>
    <tr>
      <td data-title="ลำดับที่"><?php echo $row_Recordset1['order_id']; ?></td>
      <td data-title="ชื่อลูกค้า"><?php echo $row_Recordset1['name']; ?></td>
      <td data-title="อาหารที่สั่ง"><?php echo $row_Recordset1['food']; ?></td>
      <td data-title="จำนวน"><?php echo $row_Recordset1['many']; ?></td>
      <td data-title="ราคา"><?php echo $row_Recordset1['total']; ?></td>
      <td data-title="หมายเหตุ"><?php echo $row_Recordset1['note']; ?></td>
      <td data-title="เบอร์ติดต่อ"><?php echo $row_Recordset1['phone']; ?></td>
      <td data-title="แก้ไข"><a href="admin.php?order_id=<?=$row_Recordset1['order_id']?>"class='btn btn-danger btn-xs'>ลบ</a>

              </td>
    </tr>

    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

</body>

</html>
<?php
mysql_free_result($Recordset1);
?>
