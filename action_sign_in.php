<?php
error_reporting(0);
include "config/koneksi.php";

$passwd = md5($_POST['password']);
$query_sign_in = "SELECT * FROM members WHERE email = '$_POST[email]' AND password = '$passwd' AND status = 'Y'";
$sql_sign_in  = mysql_query($query_sign_in);
$nums = mysql_num_rows($sql_sign_in);
$data = mysql_fetch_array($sql_sign_in);
$lastLogin = date('Y-m-d H:i:s');
$email = explode("@", $_POST['email']);

if ($nums > 0){
	session_start();
	$last_login = date('Y-m-d H:i:s');	
	$_SESSION['email'] = $data['email'];
	$_SESSION['lastLogin'] = $lastLogin;
	$_SESSION['useri'] = $data['memberID'];
	$_SESSION['nama'] = $data['memberName'];
	$_SESSION['username'] = $data['username'];	
			mysql_query("UPDATE members SET lastLogin ='$lastLogin' WHERE email = '$data[email]'");
		
			if ($_POST["iden"] == 1){
				header("Location: home");
			}
			else{
				header("Location: home");
			}	
	/*
	if($_POST['kode'] != ""){
		if($_POST['kode']==$_SESSION['captcha_session']){
			mysql_query("UPDATE members SET lastLogin ='$lastLogin' WHERE email = '$data[email]'");
		
			if ($_POST["iden"] == 1){
				header("Location: home");
			}
			else{
				header("Location: home");
			}
		}
		else{
			header("Location: sign-in.html?suc=code");			
		}
	}
	else{
		header("Location: sign-in.html?suc=code");
	}	
	*/
}
else{
	header("Location: sign-in.html?log=e_log");
}
?>