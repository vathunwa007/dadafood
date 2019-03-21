<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start();   
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DaDaFood TamSung</title>
  <!-- Latest compiled and minified CSS -->
  <?php include ('sublimeboostrap.php');?>
  <style>
  @media print{
   #hide{
    
    display:none;
  }
}

</style>
</head>
<body>
  <?php include("navbaruser.php");?>

  <div class="container">
   <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-8">
       
      <p><a href="buyorder.php"class="btn btn-danger"id="hide">กลับหน้าตะกร้าสินค้า</a> &nbsp;  <button class="btn btn-primary" onClick="window.print()"> พิมพ์ใบสั่งซื้อ <?php echo $_SESSION['MM_Username']; ?></button></p>
      <table width="700" border="1" align="center" class="table">
        <tr>
          <td width="1558" colspan="5" align="center">
            <strong>สั่งซื้อสินค้า </strong></td>
          </tr>
          <tr class="success">
            <td align="center"> ลำดับ</td>
            <td align="center">สินค้า</td>
            <td align="center">ราคา</td>
            <td align="center">จำนวน</td>
            <td align="center">รวม/รายการ</td>
          </tr>
          <?php
          require_once('Connections/Myconnect.php');
          $total=0;
          foreach($_SESSION['shopping_cart'] as $id=>$many)
          {
            $sql = "select * from food where id=$id";
            $query = mysql_db_query($database_Myconnect, $sql);
            $row	= mysql_fetch_array($query);
            $sum	= $row['price']*$many;
            $total	+= $sum;
            echo "<tr>";
            echo "<td align='center'>";
            echo  $i += 1;
            echo "</td>";
            echo "<td>" . $row["food"] . "</td>";
            echo "<td align='right'>" .number_format($row['price'],2) ."</td>";
            echo "<td align='right'>$many</td>";
            echo "<td align='right'>".number_format($sum,2)."</td>";
            echo "</tr>";
          }
          echo "<tr>";
          echo "<td  align='right' colspan='4'><b>รวม</b></td>";
          echo "<td align='right'>"."<b>".number_format($total,2)."</b>"."</td>";
          echo "</tr>";
          ?>

        </table>
      </div>
    </div>
  </div>
  <div class="container" id="hide">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-5" style="background-color:#f4f4f4">
        <h3 align="center" style="color:green">
          <span class="glyphicon glyphicon-shopping-cart"> </span>
        ยืนยันการสั่งซื้อ </h3>
        <form  name="formconfirm" action="saveorder.php" method="POST" id="confirm" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text"  name="name" class="form-control" required placeholder="ชื่อ-สกุล" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <textarea name="note" class="form-control"  rows="3"  required placeholder="หมายเหตุเช่น//ไข่ดาว1ฟอง"></textarea> 
            </div>
            
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              <input type="text"  name="phone" class="form-control" required placeholder="เบอร์โทรศัพท์" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="email"  name="email" class="form-control" required placeholder="อีเมล์" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="hidden" name="total" value="<?php echo $total; ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12" align="center">
              <button type="submit" class="btn btn-primary" id="btn">
              ยืนยันสั่งซื้อ </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
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