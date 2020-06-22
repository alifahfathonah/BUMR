<?php
error_reporting(0);
session_start();
include "../config/koneksi.php";
include "../config/fungsi_rupiah.php";
include "../config/fungsi_url.php";

if ($_SESSION['email'] != ''){
	$r=mysql_fetch_array(mysql_query("SELECT * FROM members WHERE memberID='$_SESSION[useri]'"));
	$pass_ulangi=md5($_POST['pass_ulangi']);
	if (empty($_POST['pass_ulangi'])){
		echo "<p align=center>Anda harus mengisikan Password Anda<br />"; 
		echo "<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></p>";
	}	
	else{
		if ($pass_ulangi==$r['password']){
			$created= date('Y-m-d H:i:s');
			$d = md5(date('Ymdhis'));
			$status = "Waiting";
			$data = mysql_fetch_array(mysql_query("SELECT * FROM withdraw WHERE withdrawID = '$_POST[id]'"));
			$sisa = $data['incomeDraw'] - $_POST['tagDraw'];						
			$queryUpdate="UPDATE withdraw SET  	tagDraw			= '$_POST[tagDraw]',
												totalDraw 		= '$sisa',
												dateFinish 		= '$created',
												statusDraw		= '$status'
							WHERE withdrawID = '$_POST[id]'";
			$save=mysql_query($queryUpdate);

			if ($save){
				$email_report = $_SESSION["email"];
				$subject = "Pencairan Dana - E-Market.com";
				$headers = "From: no-reply@ebelanja.com \r\n";
				$headers .= "Reply-To: ". strip_tags($email_report) . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
				
				$msg  = "<html><body>";
				$msg .= "<p>-- Anda Telah melakukan Pencairan Dana --</p>\r\n";
				$msg .= "<p><hr><a href='http://www.ebelanja.com'>http://www.ebelaja.com</a> - Best Solution For Your Business</p>\r\n";
				$msg .= "</body></html>";
				
				$send = mail($email_report, $subject, $msg, $headers);
			}
			header("Location:../all-dana.html?succ=ok&d=".$d);	
		}
		elseif ($pass_ulangi!=$r['password']){
			header("Location:../all-dana.html?err=ok");
		}
	}
}
else{
	header("Location: ../login.html?err=log");
}

?>