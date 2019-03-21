<?php require_once('Connections/Myconnect.php'); ?>
<?php require("sessionadmin.php"); ?>
<?php mysql_select_db($database_Myconnect, $Myconnect);
$query_Recordset2 = "SELECT * FROM massage";
$Recordset2 = mysql_query($query_Recordset2, $Myconnect) or die(mysql_error());

$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>
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
<script>
  function myFunction() {
    confirm("Press a button!");
  }
</script>
<div class="container" style="margin-top:50px">
  <h3 style="text-align: center;">ที่ชำระเงินแล้ว</h3>
  <div class="tableresponsive">
    <div class="row">
      <div class="col-md-15%">

        <table width="100%"height="208"border="0" class="table table-hover">
          <p style="height:30px;text-align: center;bottom:0px;background-color:#4aa7a9;width:100%;color:#FFFFFF;"><strong><b>รายการลูกค้าที่ชำระเงินแล้ว</span></strong>
          </p>        
          <thead>
            <tr class="danger">
              <td>ชื่อลูกค้า</td>
              <td>หมายเหตุ</td>
              <td>รูปสลิป</td>
              <td></td>
            </tr>
          </thead>
          <?php do { ?>
            <tr class"Default">
              
              <td data-title="ชื่อลูกค้า">
                <?php echo $row_Recordset2['name']; ?>
              </td>
              <td data-title="หมายเหตุ">
                <?php echo $row_Recordset2['massage']; ?>
              </td>

              <td data-title="รูปสลิป">
                <div class="gallery"><a href="img-sentmasage/<?php echo $row_Recordset2['image']; ?>"data-lightbox="mygallery"data-title="<?php echo $row_Recordset2['name']; ?></br><?php echo $row_Recordset2['date']; ?>"><img src="img-sentmasage/<?php echo $row_Recordset2['image']; ?>"width="120" height="129"></a></div>

              </td>
              <td data-title="แก้ไข">
                <a href="admin2.php?id=<?=$row_Recordset2['id']?>"class='btn btn-danger btn-xs'>ลบ</a>

              </td>

            </tr>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        </table>

      </form>
    </div>
  </div>
</div>
<?php
mysql_free_result($Recordset2);
?>