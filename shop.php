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
            .container1
            {
                position: relative;
                display: flex;
                flex-direction: column;
            }
            .container1 .box
            {
                position: relative;
                width: 100%;
                height: 180px;
                background: #1baba4;
                border-radius: 5px;
                box-shadow: 2px 2px 8px 3px rgba(0, 0, 0, 0.15);
            }
            .flexbox {
                display: flex;
                box-sizing: border-box;
                flex-direction: row;
                flex-wrap: nowrap;
                justify-content: center;
                align-items: center;
                margin-left: -10px;
                margin-right: -10px;
            }
            .item {
                display: block;
                box-sizing: border-box;
                padding-left: 50px;
                padding-right: 50px;
                margin-bottom: 20px;
            }
            .item-1 {
                flex-grow: 1;
            }
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
    <div class="container1">
    <div class="box">
        <br><br>
        <div class="flexbox">
            <p align = 'center'><font size="8" color="#000000">W E L C O M E&nbsp;&nbsp;
            <img src="./img/img/cactus.png" width="60"/></font></p>
        </div>
    </div>
    </div> 
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
        $id = $_SESSION['ses_person_id'];
        $sql_search = "SELECT shop.* FROM shop"; 
        $search = $_POST['search'];
        if ($search <> ''){
            $sql_search.= " WHERE shop_name LIKE '%".$search."%'";
        }

        if ( $_SESSION['ses_person_status'] == 'Admin'){
            $sql = "SELECT shop.shop_id,shop.shop_name,shop.bank_account,shop.bank_account_number,shop.address_details,shop.zip_code,person_authen.*,provinces.name_th AS J,amphures.name_th AS A,districts.name_th AS T FROM shop INNER JOIN person_authen INNER JOIN provinces INNER JOIN amphures INNER JOIN districts ON shop.person_authen_id = person_authen.person_authen_id AND provinces.id = shop.provinces AND amphures.id = shop.amphures AND districts.id = shop.districts"; 
        }else{
            $sql = "SELECT shop.shop_id,shop.shop_name,shop.bank_account,shop.bank_account_number,shop.address_details,shop.zip_code,person_authen.*,provinces.name_th AS J,amphures.name_th AS A,districts.name_th AS T FROM shop INNER JOIN person_authen INNER JOIN provinces INNER JOIN amphures INNER JOIN districts ON shop.person_authen_id = person_authen.person_authen_id AND provinces.id = shop.provinces AND amphures.id = shop.amphures AND districts.id = shop.districts WHERE person_authen.person_authen_id = '$id'"; 
        }

        $result = $conn->query($sql);       
        if ($result->num_rows > 0) { 
            echo "<p align='right'><a href='insert_shop.php.php?val=".$result_array['person_authen_cid']."'target='_self' class='btn btn-success' role='button'>เพิ่มข้อมูล</a></p>";
            echo "<br>";
            echo "<table class='table table-striped table-hover' width='80%' align='center'>";
            echo "<thead>";
            echo "<tr>";
                echo "<td rowspan='2'><center><b>ID</b></center></td>";
                echo "<td rowspan='2'><center><b>ชื่อร้าน</b></center></td>";
                echo "<td rowspan='2'><center><b>เจ้าของร้าน</b></center></td>";
                echo "<td rowspan='2'><center><b>ธนาคาร</b></center></td>";
                echo "<td rowspan='2'><center><b>เลขบัญชีธนาคาร</b></center></td>";
                echo "<td colspan='5'><center><b>ที่อยู่</b></center></td>";
                if (isset( $_SESSION['ses_person_status']) == 'Admin'){
                    echo "<th><center><b>ดูสินค้าในร้าน</b></center></th>";
                    }else{
                    echo "<th><center><b>เลือกดูสินค้า</b></center></th>";   
                }
                echo "<td rowspan='2'><center><b>แก้ไข</b></center></td>";
                echo "<td rowspan='2'><center><b>ลบ</b></center></td>";
            echo "</tr>";  
            echo "<tr>";
                echo "<td><center><b>รายละเอียด</b></center></td>";
                echo "<td><center><b>ตำบล</b></center></td>";
                echo "<td><center><b>อำเภอ</b></center></td>";
                echo "<td><center><b>จังหวัด</b></center></td>";
                echo "<td><center><b>รหัสไปรษณีย์</b></center></td>";
            echo "</tr>";
            echo "</thead>";
            while($result_array = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td><center>".$result_array['shop_id']."</center></td>";
                    echo "<td><center>".$result_array['shop_name']."</center></td>";
                    echo "<td><center>".$result_array['person_authen_fname']." ".$result_array['person_authen_lname']."</center></td>";
                    echo "<td><center>".$result_array['bank_account']."</center></td>";
                    echo "<td><center>".$result_array['bank_account_number']."</center></td>";
                    echo "<td><center>".$result_array['address_details']."</center></td>";
                    echo "<td><center>".$result_array['T']."</center></td>";
                    echo "<td><center>".$result_array['A']."</center></td>";
                    echo "<td><center>".$result_array['J']."</center></td>";
                    echo "<td><center>".$result_array['zip_code']."</center></td>";
                    echo "<td><center><a href='show_product.php?val=".$result_array['shop_id']."'target='_self' class='btn btn-success' role='button'>เรียกดู</a></center></td>";
                    echo "<td><center><a href='update_person_authen.php?val=".md5($result_array['person_authen_cid'])."'target='_self' class='btn btn-warning' role='button'>แก้ไข</a></center></td>";
                    echo "<td><center><a href='exec_person_authen.php?val=".md5($result_array['person_authen_cid'])."&chk=delete'target='_self'onclick='return confirm(\"ยืนยันการลบข้อมูล\")' class='btn btn-danger' role='button'>ลบ</a></center></td>";             echo "</tr>";
            }
            echo "</table>";  
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
