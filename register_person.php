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
<br>
<div class="container1">
    <div class="box">
        <br><br>
        <div class="flexbox">
            <p align = 'center'><font size="8" color="#000000">R E G I S T E R&nbsp;&nbsp;
            <img src="./img/img/cactus.png" width="60"/></font></p>
        </div>
    </div>
</div> 
<br>
<form id="form1" name="form1" method="POST" action="exec.php">

<label for="person_authen_cid">เลขบัตรประชาชน</label>
<input id="person_authen_cid" name="person_authen_cid" type="text" maxlength="13" class="form-control input-lg" placeholder="x-xxxx-xxxxx-xx-x" autocomplete=off >

<label for="person_authen_fname">ชื่อ</label>
<input id="person_authen_fname" name="person_authen_fname" type="text" class="form-control input-lg" placeholder="ํชื่อ" autocomplete=off >

<label for="person_authen_lname">นามสกุล</label>
<input id="person_authen_lname" name="person_authen_lname" type="text" class="form-control input-lg" placeholder="นามสกุล" autocomplete=off >

<label for="person_authen_phone">เบอร์โทรศัพท์</label>
<input id="person_authen_phone" name="person_authen_phone" type="text" maxlength="10" class="form-control input-lg" placeholder="เบอร์โทรศัพท์" autocomplete=off >

<label for="person_authen_email">E-mail</label>
<input id="person_authen_email" name="person_authen_email" type="email" class="form-control input-lg" placeholder="e-mail@email.com" autocomplete=off >

<label for="person_authen_password">รหัสผ่าน</label>
<input id="person_authen_password" name="person_authen_password" type="password" class="form-control input-lg" placeholder="รหัสผ่าน" autocomplete=off >

<?php
if (isset( $_SESSION['ses_person_status']) == 'Admin'){
    ?>
    <label for="person_authen_status">สถานะผู้ใช้</label><br>    
    <select class="form-control input-lg" id="person_authen_status" name="person_authen_status">
        <option value="Admin">Admin</option>
        <option value="User">User</option>
    </select> 
<?php }?>

<br>
<input type="hidden" id="chk" name ="chk" value="insert_person_authen"> 
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
