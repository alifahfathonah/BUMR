<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='lokasi' AND $act=='hapus'){
  $queryDelete="DELETE FROM location WHERE locationID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='lokasi' AND $act=='input'){
	$status = mysql_real_escape_string($_POST['status']);
	$locationName = mysql_real_escape_string($_POST['locationName']);	
	$provinceID = $_POST['provinceID'];
	$cityID = $_POST['cityID'];	
	$courierID = $_POST['courierID'];		
	$queryInput="INSERT INTO location(cityID,provinceID,courierID,locationName,status) 
					VALUES('$cityID','$provinceID','$courierID','$locationName','$status')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='lokasi' AND $act=='update'){
	$status = mysql_real_escape_string($_POST['status']);
	$locationName = mysql_real_escape_string($_POST['locationName']);	
	$provinceID = $_POST['provinceID'];
	$cityID = $_POST['cityID'];	
	$courierID = $_POST['courierID'];	
	$queryUpdate="UPDATE location SET 
						cityID = '$cityID',
						provinceID = '$provinceID',
						courierID = '$courierID',
						locationName ='$locationName',
						status='$status' 
				WHERE locationID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>