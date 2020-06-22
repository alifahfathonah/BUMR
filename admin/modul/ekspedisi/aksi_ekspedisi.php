<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='ekspedisi' AND $act=='hapus'){
  $queryDelete="DELETE FROM courier WHERE courierID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='ekspedisi' AND $act=='input'){
	$courierName = mysql_real_escape_string($_POST['courierName']);
	$status = mysql_real_escape_string($_POST['status']);
	$queryInput="INSERT INTO courier(courierName,status,courierType,courierDesc) 
					VALUES('$courierName','$status','$_POST[type]','$_POST[desc]')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='ekspedisi' AND $act=='update'){
	$courierName = mysql_real_escape_string($_POST['courierName']);
	$status = mysql_real_escape_string($_POST['status']);
	$queryUpdate="UPDATE courier SET 
						courierName = '$courierName', 
						courierDesc = '$_POST[desc]',
						status='$status' 
				WHERE courierID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>