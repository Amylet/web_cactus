<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion" id="sidenavAccordion" style="background-color:#3dcbc4;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <?php
                    if ($_SESSION['ses_person_status'] == 'Admin' || 'User') {
                ?>
                        <!--<div class="sb-sidenav-menu-heading">เมนูหลัก</div>-->
                        <br><center>
                        <a class="nav-link collapsed" style="color:inherit;" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><!--<i class="fas fa-columns"></i>--></div>
                            <img src="./img/img/user.png" width="50"/>&nbsp;&nbsp;

                            <?php
                                if($_SESSION['ses_person_status'] == ''){
                                    echo "เข้าสู่ระบบ";
                                }else if (isset($_SESSION['ses_person_status'])){
                                    echo "".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname'];
                                }
                            ?>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a></center>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            <?php
                                if ($_SESSION['ses_person_status'] == ''){
                            ?>
                                    <a class="nav-link" style="color:inherit;" a href="login.php">เข้าสู่ระบบ</a>
                            <?php 
                                } else if (isset($_SESSION['ses_person_status'])){ ?>
                                    <a class="nav-link" style="color:inherit;" a href="form_person_authen.php"><?php echo "".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname']; ?></a>
                                    <a class="nav-link" style="color:inherit;" a href="logout.php">ออกจากระบบ</a>
                            <?php } ?>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" target="_self" style="color:inherit;" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fab fa-pagelines"></i></i></div>
                                เลือกสินค้า
                            </a>
                            <?php
                                if ($_SESSION['ses_person_status'] == 'Admin') {
                            ?>
                                <a class="nav-link" target="_self" style="color:inherit;" href="show_product.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                    รายการสินค้า
                                </a>
                                <a class="nav-link" target="_self" style="color:inherit;" href="show_product_type.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-box-tissue"></i></div>
                                    ประเภทสินค้า
                                </a>
                                <a class="nav-link" target="_self" style="color:inherit;" href="show_person_authen.php">
                                    <div class="sb-nav-link-icon"><i class="far fa-id-card"></i></i></div>
                                    รายการสมาชิก
                                </a>
                                <a class="nav-link" target="_self" style="color:inherit;" href="show_order.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
                                    ยืนยันการชำระ
                                </a>
                                <a class="nav-link" target="_self" style="color:inherit;" href="shop.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
                                    ดูข้อมูลร้านค้า
                                </a>     
                            <?php }?>
                            <a class="nav-link" target="_self" style="color:inherit;" href="show_shop.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></i></div>
                                    รายการร้านค้า
                            </a>
                            <?php
                                if ($_SESSION['ses_person_status'] == 'User') {
                            ?>
                            <a class="nav-link" target="_self" style="color:inherit;" href="show_buy_sell.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
                                    รายการ ซื้อ-ขาย
                            </a> 
                            <?php }?>   
                        </div>
                        </div>
                        <div class="sb-sidenav-footer" style="background-color:#1baba4;">
                            <div class="small">Logged in as: <?php echo "".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname'];?></div>
                        </div> 
                <?php } ?>
    </nav>
</div>