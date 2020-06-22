<?php
session_start();
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
include "../config/koneksi.php";
include "../config/fungsi_thumb.php";
$module=$_GET[module];
$act=$_GET[act];

$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];

	if ($module=='paid' AND $act=='update'){
		$biaya=str_replace(".","",$_POST['totalPaid']);
		$tanggal = date('Y-m-d H:i:s');	
		
		if ($_POST['statusOrder']=='Dibayar'){
			UploadBarang($nama_file);
			mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]',
											paidOrder = '1',
											totalPaid = '$biaya',
											datePaid = '$tanggal',
											photo = '$nama_file',
											accountBank='$_POST[accountBank]'
						WHERE orderID ='$_POST[id]'");
			header('location:../status-transaction.html');
		}

	}
}

?>