<!DOCTYPE html>
<?php
    session_start();
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
            .flexbox {
                display: flex;
                box-sizing: border-box;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                margin-left: -10px;
                margin-right: -10px;
            }
            .item {
                display: block;
                box-sizing: border-box;
                width: "33.33%";
                padding-left: 50px;
                padding-right: 50px;
                margin-bottom: 20px;
            }
            .img {
                border: 1px solid #ccc;
                width: 300px;
            }

            .img:hover {
                border: 1px solid #777;
            }
            .img img {
                width: 100%;
                height: 250px;
            }
        </style>
    </head>
<!-- -------------------- head ended -------------------- -->
<!-- -------------------- Content edited start -------------------- -->
<br>
<img  id="imgeslide" src = "./img/img/b1.jpg" width = "100%">
<script>
    var i = 0;
    function slideImage() {
    var img = new Array();
        img[0] = "./img/img/b1.jpg";
        img[1] = "./img/img/b2.jpg";
        img[2] = "./img/img/b3.jpg";

        var slide = document.getElementById("imgeslide");
        slide.src = img[i];

        var delayTime = setTimeout("slideImage()", 2000);

        i = i + 1;
        if (i >= 3) {
            i = 0;
        }
    }
</script>
<center><br>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" id="form1" name="form1" action="index.php" method="POST">
        <div class="input-group">
            <label for="sel1">ค้นหาสินค้า</label> &nbsp;&nbsp;
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="search" name="search" autocomplete="off" />
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div> 
        </div>
    </form>
    </center>
<?php
echo "<br>"; 
echo "<br>"; 
$shop_id = $_GET['val'];
if (isset($shop_id)){
   
   $sql = "SELECT product.*, product_type.* , shop.shop_name FROM product INNER JOIN product_type INNER JOIN shop ON shop.shop_id = product.shop_id AND product.product_type = product_type.product_type_id WHERE shop.shop_id = '$shop_id'";    
   $search = $_POST['search'];
   if ($search <> ''){
       $sql.= " WHERE product_name LIKE '%".$search."%'";
   }
 
   $result = $conn->query($sql);    
    if ($result->num_rows > 0) { 
    echo "<div class='flexbox'>"; 
        while($result_array = $result->fetch_assoc()) {
            echo "<div class='item'>"; 
                echo "<div class='responsive'>"; 
                    echo "<div class='img'>"; 
                    echo "<img src='".$result_array['product_img']."'>"; 
                    echo "<div class='desc'>&nbsp;<b>i้าน ".$result_array['shop_name']."<br></div>";
                    echo "<div class='desc'>&nbsp;".$result_array['product_name']."</div>"; 
                    echo "<div class='desc'>&nbsp;รายละเอียด : ".$result_array['product_details']."</div>"; 
                    echo "<div class='desc'>&nbsp;ราคา ".$result_array['product_price']." บาท</div>";
                    if (isset( $_SESSION['ses_person_status'])){
                        echo "<center><a href='exec_basket.php?shop=".$result_array['shop_id']."&type=".$result_array['product_type_id']."&id=".$result_array['product_id']."&name=".$result_array['product_name']."'target='_self' class='btn btn-warning' role='button'>ใส่ตะกร้า</a></center>";
                    }
                    echo "</div>"; 
                echo "</div>"; 
            echo "</div>"; 
        }
    }else{
        echo "<center>ไม่พบข้อมูล</center>";
    }
} else {
    $sql = "SELECT product.*, product_type.* , shop.shop_name FROM product INNER JOIN product_type INNER JOIN shop ON shop.shop_id = product.shop_id AND product.product_type = product_type.product_type_id"; 
    $search = $_POST['search'];
    if ($search <> ''){
        $sql.= " WHERE product_name LIKE '%".$search."%'";
    }

    $result = $conn->query($sql);       
    if ($result->num_rows > 0) {
        echo "<div class='flexbox'>"; 
            while($result_array = $result->fetch_assoc()) {
                echo "<div class='item'>"; 
                    echo "<div class='responsive'>"; 
                        echo "<div class='img'>"; 
                        echo "<img src='".$result_array['product_img']."'>"; 
                        echo "<div class='desc'>&nbsp;<b>ร้าน ".$result_array['shop_name']."<br></div>";
                        echo "<div class='desc'>&nbsp;".$result_array['product_name']."</div>"; 
                        echo "<div class='desc'>&nbsp;รายละเอียด : ".$result_array['product_details']."</div>"; 
                        echo "<div class='desc'>&nbsp;ราคา ".$result_array['product_price']." บาท</div>";
                        if (isset( $_SESSION['ses_person_status'])){
                            echo "<center><a href='exec_basket.php?shop=".$result_array['shop_id']."&type=".$result_array['product_type_id']."&id=".$result_array['product_id']."&name=".$result_array['product_name']."'target='_self' class='btn btn-warning' role='button'>ใส่ตะกร้า</a></center>";
                        }
                        echo "</div>"; 
                    echo "</div>"; 
                echo "</div>"; 
            }
        }else{
            echo "<center>ไม่พบข้อมูล</center>";
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
