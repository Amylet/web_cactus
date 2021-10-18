<?php
	session_start();

	if(!isset($_SESSION['ses_person_cid'])){
		echo "<center><h5>คุณไม่ได้เข้าสู่ระบบ</h5></center>";
		echo "<meta http-equiv='refresh' content='1; url=index.php'>";
		exit();
	}
	//echo $_SESSION['ses_person_fname'];
/*
	if(isset($_SESSION['ses_person_cid'])){
		echo "<center>User : ".$_SESSION['sess_name']."</center>";
	}else{
		echo "<center><h5>คุณไม่ได้เข้าสู่ระบบ</h5></center>";
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
	}
*/
?>