
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">DaDaFoodAdmin</a>
</div>
<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="admin.php"id="B0"><span class="glyphicon glyphicon-pencil"></span> ดูรายการสั่งอาหาร</a></li>
      <li><a href="admin2.php"id="B1"><span class="glyphicon glyphicon-gbp"></span> ชำระเงินแล้ว</a></li>
          <li><a href="admin3.php"id="B2"><span class="glyphicon glyphicon-plus-sign"> ดูเมนูรวม</a></li>
              
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
                <a>ยินดีต้อนรับ:<?php echo $_SESSION['MM_Username']; ?> เข้าสู้ร้าน นะ</a>
            </li>
            <li>
                <a href="admintool.php"id="B3"><span class="glyphicon glyphicon-user"></span> แก้ไขข้อมูลส่วนตัวแอดมิน</a>
            </li>
            <li>
                <a href="<?php echo $logoutAction ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">เพิ่มเติม <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="admin4.php">เพิ่มรายการอาหาร</a>
                    </li>
                    <li>
                        <a href="contact.php">ฝ่ายทำการผลิต</a>
                    </li>
                    <li>
                        <a href="#">เวอร์ชั่น V0.12</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</div>
</nav>

