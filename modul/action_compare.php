<?php
session_start();
if ($_SESSION['email'] != ''){
include "../config/koneksi.php";
include "../config/library.php";

$module=$_GET['module'];
$act=$_GET['act'];

//Add 
if ($module=='compare' AND $act=='input'){
	$tanggal = date('Y-m-d H:i:s');	
  mysql_query("INSERT INTO compare(memberID, productID, compareDate)
				VALUES('$_SESSION[useri]','$_GET[id]', '$tanggal')");
				
      header('location:../compare.html?suc=ok');
}
elseif ($module=='compare' AND $act=='hapus'){
	mysql_query("DELETE FROM compare WHERE compareID='$_GET[id]'");
	header("Location: ../compare.html?suc=delete");
}
}
else{
	header("Location: ../login.html?err=log");
}
?>