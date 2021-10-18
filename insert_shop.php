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
<?php
    $sql_provinces = "SELECT * FROM provinces";
    $query = $conn->query($sql_provinces);
?>
<form id="form1" name="form1" method="POST" action="exec.php">

<label for="shop_name">ชื่อร้านค้า</label>
<input id="shop_name" name="shop_name" type="text" class="form-control input-lg" placeholder="ชื่อร้านค้า" autocomplete=off >

<label for="person_authen_id">id</label>
<input id="person_authen_id" name="person_authen_id" type="text" class="form-control input-lg" placeholder="ํชื่อ" value="<?php echo "".$_SESSION['ses_person_id'].""; ?>" autocomplete=off disabled>
<input id="person_authen_id" name="person_authen_id" type="hidden" class="form-control input-lg" placeholder="ํชื่อ" value="<?php echo "".$_SESSION['ses_person_id'].""; ?>" autocomplete=off >

<label for="bank_account">ธนาคาร</label>
<select class="form-control input-lg" id="bank_account" name="bank_account">
    <option value="krungthaibank">ธนาคารกรุงไทย</option>
    <option value="bangkokbank">ธนาคารกรุงเทพ</option>
    <option value="kasikornbank">ธนาคารกสิกรไทย</option>
    <option value="scb">ธนาคารไทยพาณิชย์</option>
</select>  

<label for="bank_account_number">เลขบัญชี</label>
<input id="bank_account_number" name="bank_account_number" type="text" maxlength="10" class="form-control input-lg" placeholder="xxx-x-xxxxx-x" autocomplete=off >

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

<input type="hidden" id="chk" name ="chk" value="insert_shop"> 
<button type="submit" onclick="return confirm('ยืนยันการบันทึกข้อมูล')" class="btn btn-success btn-block">Register</button>
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