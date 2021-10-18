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
    $sql = "SELECT shop.* FROM shop WHERE shop_id = '$val'"; 
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) {
        while($result_array = $result->fetch_assoc()) {
            $shop_id = $result_array['shop_id'];
            $shop_name = $result_array['shop_name'];
            $person_authen_id = $result_array['person_authen_id'];
            $bank_account = $result_array['bank_account'];
            $bank_account_number = $result_array['bank_account_number'];
            $provinces = $result_array['provinces'];
            $amphures = $result_array['amphures'];
            $districts = $result_array['districts'];
            $zip_code = $result_array['zip_code'];
            $address_details = $result_array['address_details'];
        }
        $sql_provinces = "SELECT * FROM provinces";
        $query = $conn->query($sql_provinces);
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }
    $conn->close();
?>
<form id="form1" name="form1" method="POST" action="exec.php">

<label for="shop_id">ID</label>
<input id="shop_id" name="shop_id" type="text" value="<?php echo $shop_id; ?>" class="form-control input-lg" autocomplete=off disabled>
<input id="shop_id" name="shop_id" type="hidden" value="<?php echo $shop_id; ?>" class="form-control input-lg" autocomplete=off >

<label for="shop_name">ชื่อร้าน</label>
<input id="shop_name" name="shop_name" type="text" value="<?php echo $shop_name; ?>" maxlength="13" class="form-control input-lg" placeholder="ชื่อร้าน" autocomplete=off>

<label for="person_authen_id">เจ้าของร้าน</label>
<input id="person_authen_id" name="person_authen_id" type="text" value="<?php echo $person_authen_id; ?>" class="form-control input-lg" placeholder="ํเจ้าของร้าน" autocomplete=off >
<input id="person_authen_id" name="person_authen_id" type="hidden" value="<?php echo $person_authen_id; ?>" class="form-control input-lg" placeholder="ํเจ้าของร้าน" autocomplete=off >

<label for="bank_account">ธนาคาร</label><br>    
<select class="form-control input-lg" id="bank_account" name="bank_account">
    <option value="<?php echo $bank_account;?>"><?php echo $bank_account;?></option>
    <option value="krungthaibank">ธนาคารกรุงไทย</option>
    <option value="bangkokbank">ธนาคารกรุงเทพ</option>
    <option value="kasikornbank">ธนาารกสิกรไทย</option>
    <option value="scb">ธนาคารไทยพาณิชย์</option>
</select> 

<label for="bank_account_number">เลขบัญชีธนาคาร</label>
<input id="bank_account_number" name="bank_account_number" type="text" value="<?php echo $bank_account_number; ?>" maxlength="13" class="form-control input-lg" placeholder="กรุณาใส่ ชื่อร้าน" autocomplete=off>

<label for="sel1">ที่อยู่</label><br>
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

<label for="sel1">รายละเอียดที่อยู่</label>
<input type="text" name="address_details" id="address_details" class="form-control">

<br>
<center><table>
<tr>
    <td>
    <td>
        <input type="hidden" id="chk" name ="chk" value="update_shop"> 
        <button type="submit" onclick="return confirm('ยืนการแก้ไขข้อมูล')" class="btn btn-success btn-block">Update</button>
    </td>
    </td>
    <td width='40%'>
    </td>
    <td>
    <td><a href="show_shop.php" class="btn btn-danger btn-block">Cancel</a></td>
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