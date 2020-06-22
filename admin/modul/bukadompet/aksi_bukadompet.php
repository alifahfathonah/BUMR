<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

$date = date('Y-m-d H:i:s');
if ($module=='bukadompet' AND $act=='update'){
	if ($_POST['statusDraw']=='Selesai'){ 
	$tanggal = date('Y-m-d H:i:s');	
      mysql_query("UPDATE withdraw SET statusDraw='$_POST[statusDraw]',
									 dateFinish = '$tanggal'
						WHERE withdrawID='$_POST[id]'");

      header('location:../../beranda.php?app='.$module);
    }	  
	elseif ($_POST['statusDraw']=='Diterima'){ 
	$tanggal = date('Y-m-d H:i:s');	
      mysql_query("UPDATE withdraw SET statusDraw='$_POST[statusDraw]',
									 dateFinish = '$tanggal'
						WHERE withdrawID='$_POST[id]'");

      header('location:../../beranda.php?app='.$module);
    }	
    else{
      mysql_query("UPDATE withdraw SET statusDraw='$_POST[statusDraw]'
						WHERE withdrawID='$_POST[id]'");
		header('location:../../beranda.php?app='.$module);
    }
}
if ($module=='bukadompet' AND $act=='hapus'){
  $queryDelete="DELETE FROM withdraw WHERE withdrawID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

?>