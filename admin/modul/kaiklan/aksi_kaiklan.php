<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='kaiklan' AND $act=='hapus'){
  $queryDelete="DELETE FROM ads WHERE adsID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kaiklan' AND $act=='input'){
	mysql_query("INSERT INTO ads(adsTitle,adsPrice,adsDesc) 
						VALUES('$_POST[adsTitle]','$_POST[adsPrice]','$_POST[adsDesc]')");		
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kaiklan' AND $act=='update'){
	$queryUpdate="UPDATE ads SET 
						adsTitle = '$_POST[adsTitle]', 
						adsPrice ='$_POST[adsPrice]',
						adsDesc = '$_POST[adsDesc]'
				WHERE adsID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>