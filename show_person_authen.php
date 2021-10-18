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
<br>
<?php
    //echo "User : ".$_SESSION['ses_person_fname']." ".$_SESSION['ses_person_lname'];
?>
    <center>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" id="form1" name="form1" action="show_person_authen.php" method="POST">
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
        $sql = "SELECT person_authen.* FROM person_authen"; 
        $search = $_POST['search'];
        if ($search <> ''){
            $sql.= " WHERE person_authen_fname LIKE '%".$search."%'";
        }

        $result = $conn->query($sql);       
        if ($result->num_rows > 0) { 
            echo "<p align='right'><a href='register_person.php' class='btn btn-success' role='button'>เพิ่มข้อมูล</a></p>";
            echo "<br>";
            echo "<table class='table table-striped table-hover' width='80%' align='center'>";
            echo "<thead>";
                echo "<tr>";
                echo "<th><center><b>หมายเลขบัตรประชาชน</b></center></th>";
                    echo "<th><center><b>ชื่อ-นามสกุล</b></center></th>";
                    echo "<th><center><b>เบอร์โทรศัพท์</b></center></th>";
                    echo "<th><center><b>E-mail</b></center></th>";
                    echo "<th><center><b>สถานะ</b></center></th>";
                    echo "<th><center><b>แก้ไข</b></center></th>";
                    echo "<th><center><b>ลบ</b></center></th>";
                echo "</tr>";
            echo "</thead>";    
            while($result_array = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td><center>".$result_array['person_authen_cid']."</center></td>";
                    echo "<td><center>".$result_array['person_authen_fname']." ".$result_array['person_authen_lname']."</center></td>";
                    echo "<td><center>0".$result_array['person_authen_phone']."</center></td>";
                    echo "<td><center>".$result_array['person_authen_email']."</center></td>";
                    echo "<td><center>".$result_array['person_authen_status']."</center></td>";
                    echo "<td><center><a href='update_person_authen.php?val=".md5($result_array['person_authen_cid'])."'target='_self' class='btn btn-warning' role='button'>แก้ไข</a></center></td>";
                    echo "<td><center><a href='exec.php?val=".md5($result_array['person_authen_cid'])."&chk=delete_person_authen'target='_self'onclick='return confirm(\"ยืนยันการลบข้อมูล\")' class='btn btn-danger' role='button'>ลบ</a></center></td>";
                echo "</tr>";
            }
            echo "</table>";   
        }else{
            echo "<center>ไม่พบข้อมูล</center>";
        }
        $conn->close();
        //$result = $conn->query($sql); 
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
