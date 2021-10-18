<!DOCTYPE html>
<?php
    session_start();
    include "./connect/conn.php";
    include "./connect/headmenu.php";
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
        </style>
    </head>
<!-- -------------------- head ended -------------------- -->

<!-- -------------------- Content edited start -------------------- -->
<?php

    if($_SESSION['ses_person_status'] == 'Admin'){
    $sql = "SELECT * FROM order_pay";
    $result = $conn->query($sql);         
    if ($result->num_rows > 0) { 
            echo "<br>";
            echo "<table class='table table-striped table-hover' width='80%' align='center'>";
            echo "<thead>";
                echo "<tr>";
                echo "<th><center><b>ผู้ซื้อ</b></center></th>";
                    echo "<th><center><b>ธนาคารที่โอนเงิน</b></center></th>";
                    echo "<th><center><b>จำนวนเงินทั้งหมด</b></center></th>";
                    echo "<th><center><b>ใบเสร็จการชำระเงิน</b></center></th>";
                    echo "<th><center><b>เวลาการชำระเงิน</b></center></th>";
                    echo "<th><center><b>สถานะการสั่งซื้อ</b></center></th>";
                echo "</tr>";
            echo "</thead>";    
            while($result_array = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td><center>".$result_array['person_authen_id']."</center></td>";
                    echo "<td><center>".$result_array['bank_account']."</center></td>";
                    echo "<td><center>".$result_array['order_money']."</center></td>";
                    echo "<td><center><img src='".$result_array['order_img']."' width='60'></center></td>";
                    echo "<td><center>".$result_array['order_time']."</center></td>";
                    echo "<td><center><a href='exec_buy_sell.php?val=".$result_array['oder_list']."&pay=payment'target='_self' class='btn btn-warning' role='button'>ยืนยันการชำระ</a></center></td>";
               echo "</tr>";
            }
            echo "</table>";   
        }else{
            echo "<center>ไม่พบข้อมูล</center>";
        }
    }else {
        $person_authen_id = $_POST['person_authen_id'];
        $bank_account = $_POST['bank_account'];
        $order_money = $_POST['money'];
        $provinces = $_POST['provinces'];
        $amphures = $_POST['amphures'];
        $zip_code = $_POST['zip_code'];
        $address_details = $_POST['address_details'];
        $order_time = date('H:i:s: d-m-Y');
        $person_authen_name = $_POST['person_authen_name'];
        $id =  $order_money;
        //$myfolder = $person_authen_name;
        //@mkdir("./img/order/$myfolder") ; chmod ("./img/order/$myfolder",0777)
        if ($_FILES['order_img']['name'] != ''){
            //umask (0);
            //$uploadPath = @mkdir("./img/order/$myfolder",0777) ;
            $uploadPath = "./img/order";
                if (copy($_FILES['order_img']['tmp_name'],$uploadPath."/".$id.".jpg")){
                    $imaePath = $uploadPath."/".$id.".jpg";
                } 
        }

        $sql = "INSERT INTO order_pay (person_authen_id, bank_account, order_money, order_img, provinces, amphures, zip_code, address_details, order_time , person_authen_name)";
        $sql.= "VALUES ('$person_authen_id', '$bank_account', '$order_money', '$imaePath', '$provinces', '$amphures', '$zip_code', '$address_details', '$order_time' , '$person_authen_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=exec_buy_sell.php?val=order'";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
            echo "<center><a href='basket_shop.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
        } 
    }
        $conn->close();
?>

<!-- -------------------- Content edited ended -------------------- -->
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Thanawut & Sukanya</div>
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
