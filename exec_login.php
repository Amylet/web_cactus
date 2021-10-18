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
if($_POST['chk']=='login'){
    $person_username = $_POST['person_username'];
    $person_password = $_POST['person_password'];
    $sql = "SELECT person_authen.* FROM person_authen WHERE person_authen_email = '$person_username'AND person_authen_password = '$person_password'";

    $result = $conn->query($sql);       
    if ($result->num_rows > 0) {
        while($result_array = $result->fetch_assoc()) {
            
            $_SESSION['ses_person_id'] = $result_array['person_authen_id'];
            $_SESSION['ses_person_cid'] = $result_array['person_authen_cid'];
            $_SESSION['ses_person_fname'] = $result_array['person_authen_fname'];
            $_SESSION['ses_person_lname'] = $result_array['person_authen_lname'];
            $_SESSION['ses_person_phone'] = $result_array['person_authen_phone'];
            $_SESSION['ses_person_email'] = $result_array['person_authen_email'];
            $_SESSION['ses_person_status'] = $result_array['person_authen_status'];

            echo "<br><br><br><center><h5>ยินดีต้อนรับ ".$result_array['person_authen_fname']."</h5></center>";
            echo "<meta http-equiv='refresh' content='2; url=form_person_authen.php'>";
        }   
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
        echo "<meta http-equiv='refresh' content='1; url=index.php'>";
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
