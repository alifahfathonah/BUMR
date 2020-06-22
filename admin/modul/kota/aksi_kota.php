<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='kota' AND $act=='hapus'){
  $queryDelete="DELETE FROM cities WHERE cityID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kota' AND $act=='input'){
	$cityName = mysql_real_escape_string($connect, $_POST['cityName']);
	$status = mysql_real_escape_string($connect, $_POST['status']);
	$provinceID = $_POST['provinceID'];
	$queryInput="INSERT INTO cities(cityName,provinceID,status) 
					VALUES('$cityName','$provinceID','$status')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kota' AND $act=='update'){
	$cityName = mysql_real_escape_string($_POST['cityName']);
	$status = mysql_real_escape_string($_POST['status']);
	$provinceID = $_POST['provinceID'];
	$queryUpdate="UPDATE cities SET 
						cityName = '$cityName',
						provinceID = '$provinceID',
						status='$status' 
				WHERE cityID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>