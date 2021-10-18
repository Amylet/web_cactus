<!DOCTYPE html>
<?php
    session_start();
    include "./connect/conn.php";
    include "./include/body.php";
?>
<html lang="en">
<!-- -------------------- head start -------------------- -->

    <head>
        <title>CACTUS / Register</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">

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
<form id="form1" name="form1" method="POST" action="exec.php" enctype="multipart/form-data">
<?php
$sql_id = "SELECT product_id FROM product";
$result = $conn->query($sql_id); 
    if ($result->num_rows > 0) {
        while($result_array = $result->fetch_assoc()) {
            $_SESSION['product_id'] = $result_array['product_id'];
        }
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }
    $id = $_SESSION['ses_person_id'];  
    $sql_shop = "SELECT * FROM shop WHERE person_authen_id = '$id'";
    $query = $conn->query($sql_shop);  
    if ($query->num_rows > 0) {
        while($result_array = $query->fetch_assoc()) {
            $_SESSION['shop_id'] = $result_array['shop_id'];
        }
    } 
?>
<br>
<label for="product_name">ชื่อสินค้า</label>
<input id="product_name" name="product_name" type="text" class="form-control input-lg" placeholder="ชื่อสินค้า" autocomplete=off >

<label for="product_details">รายละเอียดสินค้า</label>
<input id="product_details" name="product_details" type="text" class="form-control input-lg" placeholder="รายละเอียดสินค้า" autocomplete=off>

<label for="product_type">ประเภทสินค้า</label>
<select class="form-control input-lg" id="product_type" name="product_type">
    <option value="1">กระบองเพชร</option>
    <option value="2">เมล็ดพันธุ์กระบองเพชร</option>
    <option value="3">วัสดุ / อุปกรณ์</option>
    <option value="4">อื่นๆ</option>
</select>  

<label for="product_price">ราคา</label>
<input id="product_price" name="product_price" type="text" maxlength="10" class="form-control input-lg" placeholder="ราคา" autocomplete=off >
<br>
<label for="product_img">รูปสินค้า</label>
<input id="product_img" name="product_img" type="file" class="file-input" multiple>
<br>

<label for="shop_id">ร้านค้า</label>
<select class="form-control" name="shop_id" id="shop_id">
             <?php foreach ($query as $value) { ?>
            <option value="<?=$value['shop_id']?>"><?=$value['shop_name']?></option>
            <?php } ?>
</select>

<br>

<input type="hidden" id="chk" name ="chk" value="insert_product"> 
<button type="submit" onclick="return confirm('ยืนยันการบันทึกข้อมูล')" class="btn btn-success btn-block">Add Product</button>
</form>

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
<?php include('./address/script.php');?>