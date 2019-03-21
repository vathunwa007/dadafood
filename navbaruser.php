
 <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DADAFOOD</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li >
                    <a href="order.php"id="B1">เมนูผัดกะเพรา</a>
                </li>
                <li>
                    <a href="order2.php"id="B2">เมนูข้าวผัด</a>
                </li>
                <li>
                    <a href="order3.php"id="B3">เมนูผัดพริกเผา</a>
                </li>
                <li>
                    <a href="order4.php"id="B4">เมนูผัดกระเทียม</a>
                </li>
                <li>
                    <a href="order5.php"id="B5">เมนูผัดผัก</a>
                </li>
                <li>
                    <a href="order6.php"id="B6">เมนูข้าวไข่เจียว</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a><span class="glyphicon glyphicon-user"></span>ยินดีต้อนรับ:<?php echo $_SESSION['MM_Username']; ?> เข้าสู้ร้าน นะ</a>
                </li>
               
                <li>
                    <a href="<?php echo $logoutAction ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">ติดต่อ <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                       <li>
                    <a href="buyorder.php"> รวมอาหารที่สั่ง</a>
                </li>
                        <li>
                            <a href="sent.php">แจ้งชำระเงิน</a>
                        </li>
                        <li>
                            <a href="contact.php">ฝ่ายทำการผลิต</a>
                        </li>
                        <li>
                            <a href="#">เวอร์ชั่น 0.12</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>