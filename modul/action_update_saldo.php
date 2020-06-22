<?php
session_start();
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
include "../config/koneksi.php";
include "../config/fungsi_thumb.php";
$module=$_GET['module'];
$act=$_GET[act];
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];

if ($module=='paidsaldo' AND $act=='update'){
	$tanggal = date('Y-m-d H:i:s');	
	if ($_POST['statusDeposit']=='Dibayar'){ 

		UploadTransfer($nama_file);
		mysql_query("UPDATE balance_order SET statusDeposit='$_POST[statusDeposit]',
											  paidDate = '$tanggal',
											  depoName='$_POST[depoName]',
											  photoD = '$nama_file'
								WHERE balanceOrderID='$_POST[id]'");
		header('location:../all-balance.html?suc=ok');
    }	  
    else{
		mysql_query("UPDATE balance_order SET statusDeposit ='$_POST[statusDeposit]',
											  paidDate = '$tanggal'
								WHERE balanceOrderID='$_POST[id]'");
		header('location:../all-balance.html?suc=ok');
    }	

}
}
?>
