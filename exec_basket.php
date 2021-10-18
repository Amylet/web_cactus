<!DOCTYPE html>
<?php
	session_start();
    include "./connect/conn.php";
    include "./include/body.php";
?>
<html lang="en">
<!-- -------------------- head start -------------------- -->

    <head>
        <title>ระบบจัดการข้อมูล</title>

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
    if(isset($_GET['shop'])){

        $shop_id = $_GET['shop'];
        $type_id = $_GET['type'];
        $product_id = $_GET['id'];
        $name = $_GET['name'];
        $person_authen_id = $_SESSION['ses_person_id'];
        $sql = "INSERT INTO basket_shop (shop_id, product_type_id, product_id , person_authen_id , basket_name) VALUES ('$shop_id', '$type_id', '$product_id', '$person_authen_id', '$name')";
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=index.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
            echo "<center><a href='index.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>
<?php
    if($_GET['chk'] == "delete"){
        $val = $_GET['val'];
        $sql = "DELETE FROM basket_shop WHERE md5(list_id) = '$val'";
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>ลบข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=basket_shop.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br></center>";
            echo "<center><a href='basket_shop.php'><h5>ไม่สามารถลบข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
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