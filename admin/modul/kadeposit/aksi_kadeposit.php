<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='kadeposit' AND $act=='hapus'){
  $queryDelete="DELETE FROM balance WHERE balanceID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kadeposit' AND $act=='input'){
	mysql_query("INSERT INTO balance(balanceValue,balancePrice) 
						VALUES('$_POST[balanceValue]','$_POST[balancePrice]')");		
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kadeposit' AND $act=='update'){
	$queryUpdate="UPDATE balance SET 
						balanceValue = '$_POST[balanceValue]', 
						balancePrice ='$_POST[balancePrice]' 
				WHERE balanceID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>