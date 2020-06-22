<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];


if ($module=='iklan' AND $act=='update'){
	if ($_POST['statusAds']=='Selesai'){ 
	
      mysql_query("UPDATE ads_order SET statusAds='$_POST[statusAds]',
									 final = '1',
									adsValue = '$_POST[adsValue]'
						WHERE adsOrderID='$_POST[id]'");

      header('location:../../beranda.php?app='.$module);
    }	  

    else{
      mysql_query("UPDATE ads_order SET statusAds='$_POST[statusDeposit]',
										adsValue = '$_POST[adsValue]'	
						WHERE adsOrderID='$_POST[id]'");
		header('location:../../beranda.php?app='.$module);
    }
}
if ($module=='iklan' AND $act=='hapus'){
  $queryDelete="DELETE FROM ads_order WHERE adsOrderID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}
?>