<!DOCTYPE html>
<?php
    session_start();
    include "./connect/conn.php";
    include "./connect/headmenu.php";
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
<?php
    $id = $_SESSION['ses_person_id'];
    $search = $_POST['search'];
    $sql = "SELECT shop.* , person_authen.person_authen_fname , person_authen.person_authen_lname FROM shop INNER JOIN person_authen ";

    if ($search <> ''){
        $sql.= " ON person_authen.person_authen_id = shop.person_authen_id WHERE shop_name LIKE '%".$search."%'";
    }else {
        $sql.= " WHERE shop.person_authen_id = person_authen.person_authen_id";
    } 
    $result = $conn->query($sql);    
    ?>
    
    <br>
    <div class="container1">
    <div class="box">
        <div class="flexbox">
            <br>
            <p align = 'center'><font size="8" color="#000000">CACTUS&nbsp;&nbsp;
            <img src="./img/img/cactus.png" width="60"/></font></p>
        </div>
        <p><font size="6" color="#000000">
        <img src="./img/img/cactus_shop.png" width="120"/>
        <?php echo "<td>".$result_array['shop_name']."</td>"; ?>รายชื่อร้านค้า</font></p>
    </div>
    </div> 
    <?php
    ?> 
    <br>   
    <center>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" id="form1" name="form1" action="show_shop.php" method="POST">
        <div class="input-group">
            <label for="sel1">ค้นหาชื่อร้าน</label> &nbsp;&nbsp;
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="search" name="search" autocomplete="off" />
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div> 
        </div>
    </form>
    </center>
    <?php
    $result = $conn->query($sql);       
        if ($result->num_rows > 0) { 
            echo "<br>";
            echo "<table class='table table-striped table-hover' width='80%' align='center'>";
            echo "<thead>";
                echo "<tr>";
                echo "<th><center><b>ID</b></center></th>";
                    echo "<th><center><b>ชื่อร้าน</b></center></th>";
                    echo "<th><center><b>เจ้าของ</b></center></th>";
                    echo "<th><center><b>ธนาคาร</b></center></th>";
                    echo "<th><center><b>เลขบัญชี</b></center></th>";
                    echo "<th><center><b>เลือกดูสินค้า</b></center></th>"; 
                    if($_SESSION['ses_person_status'] == 'Admin'){
                        echo "<th><center><b>ลบร้านค้า</b></center></th>";
                    }  
                echo "</tr>";
            echo "</thead>";    
            while($result_array = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td><center>".$result_array['shop_id']."</center></td>";
                    echo "<td><center>".$result_array['shop_name']."</center></td>";
                    echo "<td><center>".$result_array['person_authen_fname']." ".$result_array['person_authen_lname']."</center></td>";
                    echo "<td><center>".$result_array['bank_account']."</center></td>";
                    echo "<td><center>".$result_array['bank_account_number']."</center></td>";
                    echo "<td><center><a href='index.php?val=".$result_array['shop_id']."'target='_self' class='btn btn-warning' role='button'>เลือกดูสินค้า</a></center></td>";
                    if($_SESSION['ses_person_status'] == 'Admin'){
                    echo "<td><center><a href='exec.php?val=".$result_array['shop_id']."&chk=delete_shop'target='_self' class='btn btn-danger' role='button'>ลบร้านค้า</a></center></td>";
                    }  
                    echo "</tr>";
            }
            echo "</table>";   
        }else{
            echo "<center>ไม่พบข้อมูล</center>";
        }
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
