<!DOCTYPE html>
<?php
    session_start();
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
    $cid = $_SESSION['ses_person_cid'];
    $sql = "SELECT person_authen.* FROM person_authen WHERE person_authen_cid = '$cid'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        while($result_array = $result->fetch_assoc()) {
            $person_authen_id = $result_array['person_authen_id'];
            $person_authen_cid = $result_array['person_authen_cid'];
            $person_authen_fname = $result_array['person_authen_fname'];
            $person_authen_lname = $result_array['person_authen_lname'];
            $person_authen_phone = $result_array['person_authen_phone'];
            $person_authen_email = $result_array['person_authen_email'];
            $person_authen_password = $result_array['person_authen_password'];
            $person_authen_status = $result_array['person_authen_status'];
        }  

    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }
   
?>

<label for="person_authen_cid">เลขบัตรประชาชน</label>
<input id="person_authen_cid" name="person_authen_cid" type="text" value="<?php echo $person_authen_cid; ?>" maxlength="13" class="form-control input-lg" autocomplete=off disabled>

<label for="person_authen_fname">ชื่อ</label>
<input id="person_authen_fname" name="person_authen_fname" type="text" value="<?php echo $person_authen_fname; ?>" class="form-control input-lg" autocomplete=off disabled>

<label for="person_authen_lname">นามสกุล</label>
<input id="person_authen_lname" name="person_authen_lname" type="text" value="<?php echo $person_authen_lname; ?>" class="form-control input-lg" autocomplete=off disabled>

<label for="person_authen_phone">เบอร์โทรศัพท์</label>
<input id="person_authen_phone" name="person_authen_phone" type="text" value="0<?php echo $person_authen_phone; ?>" class="form-control input-lg" autocomplete=off disabled>

<label for="person_authen_email">E-mail</label>
<input id="person_authen_email" name="person_authen_email" type="email" value="<?php echo $person_authen_email; ?>" class="form-control input-lg" autocomplete=off disabled>

<?php
if ($_SESSION['ses_person_status'] == 'Admin') {?>
<label for="person_authen_status">สถานะผู้ใช้</label><br>    
<select class="form-control input-lg" id="person_authen_status" name="person_authen_status" disabled>
    <option value="<?php echo $person_authen_status;?>"><?php echo $person_authen_status;?></option>
    <option value="Admin">Admin</option>
    <option value="User">User</option>
</select> 
<?php
}
echo "<br>";
echo "<center><table>";
echo "<tr>";
echo "<td>";  

    $id_con = "SELECT * FROM shop WHERE person_authen_id = '$person_authen_id'";
    $result_id = $conn->query($id_con);
    if ($result_id->num_rows > 0) {
        echo "<td><center><a href='shop.php?val=".md5($result_array['person_authen_id'])."'target='_self' class='btn btn-success' role='button'>ร้านค้า</a></center></td>";
    }
    else {
        echo "<td><center><a href='insert_shop.php?val=".md5($result_array['person_authen_cid'])."'target='_self' class='btn btn-success' role='button'>ลงทะเบียนร้านค้า</a></center></td>";
    }
    echo "</td>";
    echo "<td width='40%'>";
    echo "</td>";
    echo "<td>";
    echo "<td><center><a href='update_person_authen.php?val=".md5($result_array['person_authen_cid'])."'target='_self' class='btn btn-warning' role='button'>แก้ไขข้อมูล</a></center></td>";
    echo "</td>";
echo "</tr>";
echo "</table></center>";
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
