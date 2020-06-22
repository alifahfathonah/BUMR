<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='supplier' AND $act=='hapus'){
  $queryDelete="DELETE FROM suppliers WHERE categoryID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='supplier' AND $act=='input'){
	$supplierName = mysql_real_escape_string($_POST['supplierName']);
	$phone = mysql_real_escape_string($_POST['phone']);
	$contact = mysql_real_escape_string($_POST['contactPerson']);
	$address = mysql_real_escape_string($_POST['address']);
	$queryInput="INSERT INTO suppliers(supplierName,phone,contactPerson,address) 
					VALUES('$supplierName','$phone','$contact','$address')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='supplier' AND $act=='update'){
	$supplierName = mysql_real_escape_string($_POST['supplierName']);
	$phone = mysql_real_escape_string($_POST['phone']);
	$contact = mysql_real_escape_string($_POST['contactPerson']);
	$address = mysql_real_escape_string($_POST['address']);
	$queryUpdate="UPDATE suppliers SET 
						supplierName = '$supplierName', 
						phone = '$phone',
						contactPerson = '$contact',
						address = '$address'
				WHERE supplierID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>