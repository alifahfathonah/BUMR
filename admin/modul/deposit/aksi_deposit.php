<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

$date = date('Y-m-d H:i:s');
if ($module=='deposit' AND $act=='update'){
	if ($_POST['statusDeposit']=='Selesai'){ 
	
      mysql_query("UPDATE balance_order SET statusDeposit='$_POST[statusDeposit]',
									 finish = '1',
									 total1 = '$_POST[total1]'
						WHERE balanceOrderID='$_POST[id]'");

      header('location:../../beranda.php?app='.$module);
    }	  

    else{
      mysql_query("UPDATE balance_order SET statusDeposit='$_POST[statusDeposit]',
											 total1 = '$_POST[total1]'
						WHERE balanceOrderID='$_POST[id]'");
		header('location:../../beranda.php?app='.$module);
    }
}
if ($module=='deposit' AND $act=='hapus'){
  $queryDelete="DELETE FROM balance_order WHERE balanceOrderID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

?>