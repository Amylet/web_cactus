<!DOCTYPE html>
<?php
    session_start();
    include "check_login.php";
    include "./connect/conn.php";
    include "./include/body.php";
?>
<html lang="en">
<!-- -------------------- head start -------------------- -->

    <head>
        <title>CACTUS</title>
        <link rel = "icon" href = "./img/img/cactus_logo.ico" type = "image/x-icon">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <link href="./css/styles2.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Athiti&family=Kanit:wght@300&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

        <style>
            .content {
                    margin-top: 100px;
                }
                body {
                font-family: 'Athiti', sans-serif;
                }
                h1 {
                font-family: 'Athiti', sans-serif;
                }
                table {
                font-family: 'Athiti', sans-serif;
                font-size:medium;
                }
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
            .row.content {height: 1500px}

            /* Set gray background color and 100% height */
            .sidenav {
            background-color: #f1f1f1;
            height: 100%;
            }

            /* Set black background color, white text and some padding */
            footer {
            background-color: #555;
            color: white;
            padding: 15px;
            }

            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height: auto;} 
            }
        </style>
    </head>
<!-- -------------------- head ended -------------------- -->

<!-- -------------------- Content edited start -------------------- -->
<br>
<?php
    //echo "User : ".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname'];
?>
    <center>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" id="form1" name="form1" action="show_shop.php" method="POST">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="search" name="search" autocomplete="off" />
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div> 
        </div>
    </form>
    </center>
    <br>

    <?php
        $id =  $_SESSION['ses_person_id'];
       
        echo "<p align='right'><a href='index.php' class='btn btn-success' role='button'>เพิ่มสินค้า</a></p>";
            
        $sql = "SELECT basket_shop.list_id , product.product_name , product.product_img , product.product_price , product_type.* , shop.shop_id , shop.shop_name FROM basket_shop INNER JOIN product INNER JOIN shop INNER JOIN product_type INNER JOIN person_authen ON basket_shop.shop_id = shop.shop_id AND basket_shop.product_type_id = product_type.product_type_id AND basket_shop.person_authen_id = person_authen.person_authen_id AND basket_shop.basket_name = product.product_name WHERE basket_shop.person_authen_id = '$id'"; 

        $result = $conn->query($sql);       
        if ($result->num_rows > 0) { 
            echo "<br>";
            echo "<table class='table table-striped table-hover' width='80%' align='center'>";
            echo "<thead>";
            echo "<tr>";
                echo "<td><center><b>ID</b></center></td>";
                echo "<td><center><b>ชื่อสินค้า</b></center></td>";
                echo "<td><center><b>ประเภทสินค้า</b></center></td>";
                echo "<td><center><b>ราคา</b></center></td>";
                echo "<td><center><b>รูป</b></center></td>";
                echo "<td><center><b>ร้าน</b></center></td>";
                echo "<td><center><b>ลบ</b></center></td>";
            echo "</tr>";
            echo "</thead>";
            while($result_array = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td><center>".$result_array['list_id']."</center></td>";
                    echo "<td><center>".$result_array['product_name']."</center></td>";
                    echo "<td><center>".$result_array['product_type_name']."</center></td>";
                    echo "<td><center>".$result_array['product_price']."</center></td>";
                    echo "<td><center><img src='".$result_array['product_img']."' width='60'></center></td>";
                    echo "<td><center>".$result_array['shop_name']."</center></td>";
                    echo "<td><center><a href='exec_basket.php?val=".md5($result_array['list_id'])."&chk=delete'target='_self'onclick='return confirm(\"ยืนยันการลบข้อมูล\")' class='btn btn-danger' role='button'>ลบ</a></center></td>";
                echo "</tr>";
                $price = $result_array['product_price'] + $price;
            }
            echo "<tr>";
            echo "<td><center>ราคารวม</center></td>";
            echo "<td colspan='2' align = 'right'></td>";
            echo "<td><center>".$price."</center></td>";
            echo "<td colspan='2' align = 'right'></td>";
            echo "<td><center><a href='basket_shop.php?val=".$result_array['list_id']."&chk=order'target='_self'onclick='return confirm(\"ยืนยันการสั่งซื้อ\")' class='btn btn-success' role='button'>สั่งซื้อ</a></center></td>";
            echo "</tr>";
            echo "</table>";  
            echo "<br>";

            if($_GET['chk'] == "order"){ 

                $sql_provinces = "SELECT * FROM provinces";
                $query = $conn->query($sql_provinces);
                
                ?>
                <form id="form1" name="form1" method="POST" action="show_order.php" enctype="multipart/form-data">

                <label for="person_authen_name">id</label>
                <input id="person_authen_name" name="person_authen_name" type="text" class="form-control input-lg" placeholder="ํชื่อ" value="<?php echo "".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname'];?>" autocomplete=off disabled>
                <input id="person_authen_name" name="person_authen_name" type="hidden" class="form-control input-lg" placeholder="ํชื่อ" value="<?php echo "".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname'];?>" autocomplete=off >
                
                <input id="person_authen_id" name="person_authen_id" type="hidden" class="form-control input-lg" placeholder="ํชื่อ" value="<?php echo "".$_SESSION['ses_person_id'];?>" autocomplete=off >

                <label for="bank_account">ธนาคารที่โอนเงิน</label>
                <select class="form-control input-lg" id="bank_account" name="bank_account">
                    <option value="krungthaibank">ธนาคารกรุงไทย</option>
                    <option value="bangkokbank">ธนาคารกรุงเทพ</option>
                    <option value="kasikornbank">ธนาคารกสิกรไทย</option>
                    <option value="scb">ธนาคารไทยพาณิชย์</option>
                </select>  
                <br>
                <label for="money">จำนวนเงินทั้งหมด : <?php echo "$price"; ?> บาท </label>
                <input id="money" name="money" type="text" class="form-control input-lg" placeholder="<?php echo "$price"; ?> บาท" autocomplete=off >
                <br>
                <label for="order_img">ใบเสร็จการชำระเงิน</label><br>
                <input id="order_img" name="order_img" type="file" class="file-input" multiple>
                <br>
                <br><label for="sel1">ที่อยู่</label><br>
                <label for="sel1">จังหวัด</label>
                <select class="form-control" name="provinces" id="provinces">
                            <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                            <?php foreach ($query as $value) { ?>
                            <option value="<?=$value['id']?>"><?=$value['name_th']?></option>
                            <?php } ?>
                </select>

                <label for="sel1">อำเภอ</label>
                <select class="form-control" name="amphures" id="amphures"></select>

                <label for="sel1">ตำบล</label>
                <select class="form-control" name="districts" id="districts"></select>

                <label for="sel1">รหัสไปรษณีย์</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control">
                <br>
                <label for="sel1">รายละเอียดที่อยู่ ( ชื่อ-นามสกุล บ้านเลขที่ หมู่ ถนน )</label>
                <input type="text" name="address_details" id="address_details" class="form-control">

                <br>

                <input type="hidden" id="chk" name ="chk" value="order"> 
                <button type="submit" onclick="return confirm('ยืนยันการสั่งซื้อ')" class="btn btn-success btn-block">ยืนยันการสั่งซื้อ</button>
                </form>

            <?php }
        }else{
            echo "<center>ไม่พบข้อมูล</center>";
        }
  
        $conn->close();
        
?>

<!-- -------------------- Content edited ended -------------------- -->
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Paisan Simalaotao 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<!-- -------------------- script tag start -------------------- -->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
<!-- -------------------- script tag ended -------------------- -->

    </body>
</html>
<?php include('./address/script.php');?>