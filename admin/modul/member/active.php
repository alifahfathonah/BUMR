<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk akses modul, Anda harus login terlebih dahulu<br>
	<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

	$module	= $_GET['app'];
	$act	= $_GET['act'];

	// Delete
	if ($module == 'member' AND $act == 'change'){
		mysql_query("UPDATE members SET status = 'Y' WHERE memberID= '$_POST[id]'");
		header('Location: ../../beranda.php?app='.$module);
	}
}
?>