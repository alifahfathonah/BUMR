<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='provinsi' AND $act=='hapus'){
  $queryDelete="DELETE FROM provinces WHERE provinceID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='provinsi' AND $act=='input'){
	$provinceName = mysql_real_escape_string($_POST['provinceName']);
	$status = mysql_real_escape_string($_POST['status']);	
	$queryInput="INSERT INTO provinces(provinceName,status) 
					VALUES('$provinceName','$status')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='provinsi' AND $act=='update'){
	$provinceName = mysql_real_escape_string($_POST['provinceName']);
	$status = mysql_real_escape_string($_POST['status']);
	$queryUpdate="UPDATE provinces SET 
						provinceName = '$provinceName', 
						status='$status' 
				WHERE provinceID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>