<?php
session_start();
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
include "../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET[act];

if ($module=='send' AND $act=='input'){
	$tanggal = date('Y-m-d H:i:s');	
	$waiting = "Waiting";
  mysql_query("INSERT INTO konfirmasi(id_orders, nama_bank, no_rekening, akun_nama, amount, status, tanggal)
				VALUES('$_POST[id_orders]','$_POST[nama_bank]','$_POST[no_rekening]','$_POST[akun_nama]','$_POST[total]',
				'$waiting','$tanggal')");
      header('location:../engine.php?module='.$module);
}


elseif ($module=='send' AND $act=='update'){
	$biaya=str_replace(".","",$_POST['biaya']);
	$tanggal = date('Y-m-d H:i:s');	

	if ($_POST['statusOrder']=='Dikirim'){ 

      mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]',
							sendOrder = '1',
							resi = '$_POST[resi]',
							dibaca = 'Y'
					where orderID='$_POST[id]'");

	header('location:../history.html'); 
    }	  
	elseif($_POST['status_order']=='Dikembalikan'){
		mysql_query("UPDATE products,orders_detail SET products.qty=products.qty+orders_detail.quantity WHERE products.productID=orders_detail.productID and orders_detail.orderID='$_POST[id]'"); 
		mysql_query("UPDATE products,orders_detail SET products.sold=products.sold-orders_detail.quantity WHERE products.productID=orders_detail.productID and orders_detail.orderID='$_POST[id]'");

		mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]',
									rejectOrder ='1'
							where orderID='$_POST[id]'");

		header('location:../history.html');
	  }
	}
}
?>
