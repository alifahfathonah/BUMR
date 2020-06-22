<?php
error_reporting(0);
session_start();
include "config/koneksi.php";

if ($_SESSION['email'] != ''){	
	$queryUpdate = "SELECT * FROM members WHERE memberID='$_SESSION[useri]'";
	$sqlUpdate = mysql_query($queryUpdate);
	$r=mysql_fetch_array($sqlUpdate);

	$pass_lama=md5($_POST['pass_lama']);
	$pass_baru=md5($_POST['pass_baru']);

if (empty($_POST['pass_baru']) OR empty($_POST['pass_lama']) OR empty($_POST['pass_ulangi'])){
	echo "<p align=center>Anda harus mengisikan semua data pada form Ganti Password.<br />"; 
	echo "<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></p>";
}
else{ 
// Apabila password lama cocok dengan password admin di database
if ($pass_lama==$r['password']){
  // Pastikan bahwa password baru yang dimasukkan sebanyak dua kali sudah cocok
  if ($_POST['pass_baru']==$_POST['pass_ulangi']){
		$queryPwd = "UPDATE members SET password = '$pass_baru' WHERE memberID = '$_SESSION[useri]'";
		mysql_query($queryPwd);
		header("Location: profile.html?suc=ok");
  }
  else{
    echo "<p align=center>Password baru yang Anda masukkan sebanyak dua kali belum cocok.<br />"; 
    echo "<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></p>";  
  }
}
else{
  echo "<p align=center>Anda salah memasukkan Password Lama Anda.<br />"; 
  echo "<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></p>";
}
}
	
}
?>