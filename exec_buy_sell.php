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
    <?php
        if($_GET['val'] == "order"){

            $order_time = date('H:i:s: d-m-Y');
            $sql = "SELECT * FROM order_pay"; 
            $result = $conn->query($sql);       
            if ($result->num_rows > 0) {
                while($result_array = $result->fetch_assoc()) {
                    $oder_list = $result_array['oder_list'];
                    $person_authen_id = $result_array['person_authen_id'];
                    $person_authen_name = $result_array['person_authen_name'];
                }  
            }
            $pay = "INSERT INTO buy_sell (oder_list, person_authen_id, buy_sell_status, order_time , person_authen_name)VALUES ('$oder_list', '$person_authen_id', 'รอการยืนยัน', '$order_time', '$person_authen_name')";
            if ($conn->query($pay) === TRUE) {
                unset($_SESSION["order_pay"]);
                echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
                echo "<center><h4>กรุณารอสักครู่...</h4></center>";
                echo "<meta http-equiv='refresh' content='1; url=show_buy_sell.php'>";
            }else{
                echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
                echo "<center><a href='basket_shop.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
            } 
        }
        if ($_GET['pay'] == "payment"){

            $order = $_GET['val'];
            $sql = "UPDATE buy_sell table_name SET buy_sell_status = 'ชำระเรียบร้อยแล้ว' WHERE oder_list = '$order'";
            if ($conn->query($sql) === TRUE) {
                echo "<center><br><br><h5>ชำระเงินแล้ว</h5><br></center>";
                echo "<center><h4>กรุณารอสักครู่...</h4></center>";
                echo "<meta http-equiv='refresh' content='1; url=show_order.php'>";
            }else{
                echo "<center><a href='show_order.php'><h5>ไม่สามารถแก้ไขข้อมูลได้</h5></a></center>";
            } 
            $conn->close();
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
