<?php
session_start();
if ($_SESSION['email'] != ''){
include "../config/koneksi.php";
include "../config/library.php";

$module=$_GET['module'];
$act=$_GET['act'];

//Add 
if ($module=='favorite' AND $act=='input'){
	$tanggal = date('Y-m-d H:i:s');	
  mysql_query("INSERT INTO favorite(memberID, productID, favoriteDate)
				VALUES('$_SESSION[useri]','$_GET[id]', '$tanggal')");
				
      header('location:../favorite.html?suc=ok');
}
elseif ($module=='favorite' AND $act=='hapus'){
	mysql_query("DELETE FROM favorite WHERE favoriteID='$_GET[id]'");
	header("Location: ../favorite.html?suc=delete");
}
}
else{
	header("Location: ../login.html?err=log");
}
?>