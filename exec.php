<!DOCTYPE html>
<?php
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

<!-- -------------------- shop -------------------- -->
<?php
    if($_POST['chk'] == "insert_shop"){

        $shop_name = $_POST['shop_name'];
        $person_authen_id = $_POST['person_authen_id'];
        $bank_account = $_POST['bank_account'];
        $bank_account_number = $_POST['bank_account_number'];
        $provinces = $_POST['provinces'];
        $amphures = $_POST['amphures'];
        $districts = $_POST['districts'];
        $zip_code = $_POST['zip_code'];
        $address_details = $_POST['address_details'];

        $sql = "INSERT INTO shop (shop_name, person_authen_id, bank_account, bank_account_number, provinces, amphures, districts, zip_code , address_details)";
        $sql.= "VALUES ('$shop_name', '$person_authen_id', '$bank_account', '$bank_account_number', '$provinces', '$amphures', '$districts', '$zip_code' , '$address_details')";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=index.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
            echo "<center><a href='form_person_authen.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<?php
    if($_POST['chk'] == "update_shop"){

        $shop_id = $_POST['shop_id'];
        $shop_name = $_POST['shop_name'];
        $person_authen_id = $_POST['person_authen_id'];
        $bank_account = $_POST['bank_account'];
        $bank_account_number = $_POST['bank_account_number'];
        $provinces = $_POST['provinces'];
        $amphures = $_POST['amphures'];
        $districts = $_POST['districts'];
        $zip_code = $_POST['zip_code'];
        $address_details = $_POST['address_details'];

        $sql = "UPDATE shop SET shop_id = '$shop_id' , shop_name = '$shop_name' , person_authen_id = '$person_authen_id' , bank_account = '$bank_account', bank_account_number = '$bank_account_number', provinces = '$provinces', amphures = '$amphures', districts = '$districts', zip_code = '$zip_code', address_details = '$address_details'";
        $sql.= " WHERE shop_id = '$shop_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>แก้ไขข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_shop.php'>";
        }else{
            echo "<center><a href='show_shop.php'><h5>ไม่สามารถแก้ไขข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<?php
    if($_GET['chk'] == "delete_shop"){
        $val = $_GET['val'];
        $sql = "DELETE FROM shop WHERE shop_id = '$val'";
        if ($conn->query($sql) === TRUE) {
            $del_product = "DELETE FROM product WHERE shop_id = '$val'";
            if ($conn->query($del_product) === TRUE) {
                echo "<center><br><br><h5>ลบข้อมูลแล้ว</h5><br></center>";
                echo "<center><h4>กรุณารอสักครู่...</h4></center>";
                echo "<meta http-equiv='refresh' content='1; url=show_shop.php'>";
            }
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br></center>";
            echo "<center><a href='show_shop.php'><h5>ไม่สามารถลบข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<!-- -------------------- product -------------------- -->

<?php
    if($_POST['chk'] == "insert_product"){

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_details = $_POST['product_details'];
        $product_type = $_POST['product_type'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];
        $shop_id = $_POST['shop_id'];
       
        $id =  $_SESSION['product_id'] + 1;

        if ($_FILES['product_img']['name'] != ''){
            $uploadPath = "./img/product";
                if (copy($_FILES['product_img']['tmp_name'],$uploadPath."/".$id.".jpg")){
                    $imaePath = $uploadPath."/".$id.".jpg";
                } 
        }

        $sql = "INSERT INTO product (product_id, product_name, product_details, product_type, product_price, product_img, shop_id)";
        $sql.= "VALUES ('$product_id', '$product_name', '$product_details', '$product_type', '$product_price', '$imaePath', '$shop_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_product.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
            echo "<center><a href='show_product.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>
<?php
    if($_POST['chk'] == "update_product"){

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_details = $_POST['product_details'];
        $product_type = $_POST['product_type'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];
        $shop_id = $_POST['shop_id'];

        if ($_FILES['product_img']['name'] != ''){
            $uploadPath = "./img/product";
                if (copy($_FILES['product_img']['tmp_name'],$uploadPath."/".$product_id.".jpg")){
                    $imaePath = $uploadPath."/".$product_id.".jpg";
                } 
        }


        $sql = "UPDATE product SET product_id = '$product_id' , product_name = '$product_name' , product_details = '$product_details' , product_type = '$product_type', product_price = '$product_price', product_img = '$imaePath', shop_id = '$shop_id'";
        $sql.= " WHERE product_id = '$product_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>แก้ไขข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_product.php?val=".$shop_id."'>";
        }else{
            echo "<center><a href='show_product.php'><h5>ไม่สามารถแก้ไขข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<?php
    if($_GET['chk'] == "delete_product"){
        $val = $_GET['val'];
        $sql = "DELETE FROM product WHERE md5(product_id) = '$val'";
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>ลบข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_product.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br></center>";
            echo "<center><a href='show_product.php'><h5>ไม่สามารถลบข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<!-- -------------------- product_type -------------------- -->

<?php
    if($_POST['chk'] == "insert_product_type"){

        $product_type_id = $_POST['product_type_id'];
        $product_type_name = $_POST['product_type_name'];

        $sql = "INSERT INTO product_type (product_type_id, product_type_name)";
        $sql.= "VALUES ('$product_type_id', '$product_type_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_product_type.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
            echo "<center><a href='show_product_type.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>
<?php
    if($_POST['chk'] == "update_product_type"){

        $product_type_id = $_POST['product_type_id'];
        $product_type_name = $_POST['product_type_name'];

        $sql = "UPDATE product_type SET product_type_id = '$product_type_id' , product_type_name = '$product_type_name'";
        $sql.= " WHERE product_type_id = '$product_type_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>แก้ไขข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_shop.php'>";
        }else{
            echo "<center><a href='show_shop.php'><h5>ไม่สามารถแก้ไขข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<?php
    if($_GET['chk'] == "delete_product_type"){
        $val = $_GET['val'];
        $sql = "DELETE FROM product_type WHERE md5(shop_id) = '$val'";
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>ลบข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_shop.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br></center>";
            echo "<center><a href='show_shop.php'><h5>ไม่สามารถลบข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<!-- -------------------- person_authen -------------------- -->

<?php
    if($_POST['chk'] == "insert_person_authen"){

        $person_authen_cid = $_POST['person_authen_cid'];
        $person_authen_fname = $_POST['person_authen_fname'];
        $person_authen_lname = $_POST['person_authen_lname'];
        $person_authen_phone = $_POST['person_authen_phone'];
        $person_authen_email = $_POST['person_authen_email'];
        $person_authen_password = $_POST['person_authen_password'];
        $person_authen_status = $_POST['person_authen_status'];

        $sql = "INSERT INTO person_authen (person_authen_cid, person_authen_fname,person_authen_lname,person_authen_phone,person_authen_email,person_authen_password,person_authen_status)";
        $sql.= "VALUES ('$person_authen_cid', '$person_authen_fname', '$person_authen_lname', '$person_authen_phone', '$person_authen_email', '$person_authen_password', '$person_authen_status')";

        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>บันทึกข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=index.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br>></center>";
            echo "<center><a href='form_person_authen.php'><h5>ไม่สามารถบันทึกข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>
<?php
    if($_POST['chk'] == "update_person_authen"){
        $person_authen_cid = $_POST['person_authen_cid'];
        $person_authen_fname = $_POST['person_authen_fname'];
        $person_authen_lname = $_POST['person_authen_lname'];
        $person_authen_email = $_POST['person_authen_email'];
        $person_authen_status = $_POST['person_authen_status'];
        $sql = "UPDATE person_authen table_name SET person_authen_fname = '$person_authen_fname' , 
        person_authen_lname = '$person_authen_lname' , person_authen_email = '$person_authen_email' , person_authen_status = '$person_authen_status'";
        $sql.= " WHERE person_authen_cid = '$person_authen_cid'";
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>แก้ไขข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=shop.php'>";
        }else{
            echo "<center><a href='shop.php'><h5>ไม่สามารถแก้ไขข้อมูลได้</h5></a></center>";
        } 
        $conn->close();
    }
?>

<?php
    if($_GET['chk'] == "delete_person_authen"){
        $val = $_GET['val'];
        $sql = "DELETE FROM person_authen WHERE md5(person_authen_cid) = '$val'";
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><h5>ลบข้อมูลสำเร็จแล้ว</h5><br></center>";
            echo "<center><h4>กรุณารอสักครู่...</h4></center>";
            echo "<meta http-equiv='refresh' content='1; url=show_person_authen.php'>";
        }else{
            echo "<center><h5>Error: " . $sql . "<br>" . $conn->error. "</h5><br></center>";
            echo "<center><a href='show_person_authen.php'><h5>ไม่สามารถลบข้อมูลได้</h5></a></center>";
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
