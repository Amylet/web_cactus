<!DOCTYPE html>
<?php
    include "./check_login.php";
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
    echo "<center>".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname']."</center>";
    $val = $_GET['val'];
    $sql = "SELECT product.*,shop.shop_name FROM product INNER JOIN shop ON shop.shop_id = product.shop_id WHERE product_id = '$val'"; 
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) {
        while($result_array = $result->fetch_assoc()) {
            $product_id = $result_array['product_id'];
            $product_name = $result_array['product_name'];
            $product_details = $result_array['product_details'];
            $product_type = $result_array['product_type'];
            $product_price = $result_array['product_price'];
            $product_img = $result_array['product_img'];
            $shop_id = $result_array['shop_id'];
            $shop_name = $result_array['shop_name'];
        }
        $sql_provinces = "SELECT * FROM provinces";
        $query = $conn->query($sql_provinces);
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }
    $conn->close();
?>
<form id="form1" name="form1" method="POST" action="exec.php" enctype="multipart/form-data">


<label for="product_id">ID</label>
<input id="product_id" name="product_id" type="text" value="<?php echo $product_id; ?>" class="form-control input-lg" placeholder="ํกรุณาใส่ ชื่อ" autocomplete=off disabled>
<input id="product_id" name="product_id" type="hidden" value="<?php echo $product_id; ?>" class="form-control input-lg" placeholder="ํกรุณาใส่ ชื่อ" autocomplete=off >

<label for="product_name">ชื่อสินค้า</label>
<input id="product_name" name="product_name" type="text" value="<?php echo $product_name; ?>" maxlength="13" class="form-control input-lg" placeholder="ชื่อสินค้า" autocomplete=off>

<label for="product_details">รายละเอียด</label>
<input id="product_details" name="product_details" type="text" value="<?php echo $product_details; ?>" maxlength="13" class="form-control input-lg" placeholder="รายละเอียดสินค้า" autocomplete=off>

<label for="product_type">ประเภทสินค้า</label><br>    
<select class="form-control input-lg" id="product_type" name="product_type">
    <option value="1">กระบองเพชร</option>
    <option value="2">เมล็ดพันธุ์กระบองเพชร</option>
    <option value="3">วัสดุ / อุปกรณ์</option>
    <option value="4">อื่นๆ</option>
</select> 

<label for="product_price">ราคา</label>
<input id="product_price" name="product_price" type="text" value="<?php echo $product_price; ?>" maxlength="13" class="form-control input-lg" placeholder="xxx" autocomplete=off>

<br>
<label for="product_img">รูปสินค้า</label><br>
<input id="product_img" name="product_img" type="file" class="file-input" multiple>
<br>
<br>
<label for="shop_id">ชื่อร้าน</label>
<input id="shop_id" name="shop_id" type="text" value="<?php echo $shop_name; ?>" class="form-control input-lg" placeholder="ํชื่อร้าน" autocomplete=off disabled>
<input id="shop_id" name="shop_id" type="hidden" value="<?php echo $shop_id; ?>" class="form-control input-lg" placeholder="ํชื่อร้าน" autocomplete=off >

<br>
<center><table>
<tr>
    <td>
    <td>
        <input type="hidden" id="chk" name ="chk" value="update_product"> 
        <button type="submit" onclick="return confirm('ยืนการแก้ไขข้อมูล')" class="btn btn-success btn-block">Update</button>
    </td>
    </td>
    <td width='40%'>
    </td>
    <td>
    <td><a href="show_product_type.php" class="btn btn-danger btn-block">Cancel</a></td>
    </td>
</tr>
</table></center>
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