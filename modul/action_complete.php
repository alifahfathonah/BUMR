<?php
session_start();
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
	include "../config/koneksi.php";
	$module=$_GET['module'];
	$act=$_GET[act];
	if ($module=='complete' AND $act=='update'){
		$tanggal = date('Y-m-d H:i:s');	
		 $rate = $_POST['rate'];
		 $masuk = 'Masuk';
		 
		if ($_POST['statusOrder']=='Diterima'){
			mysql_query("UPDATE products,orders_detail SET products.qty=products.qty-orders_detail.quantity 
						WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'");
		  
			mysql_query("UPDATE products,orders_detail SET products.sold=products.sold+orders_detail.quantity 
						WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'");
							
			mysql_query("UPDATE withdraw SET statusDraw = '$masuk'
							WHERE orderID='$_POST[id]'");			
					
			mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]',
											acceptOrder = '1',
											rate = '$_POST[rating]',
											dateFinish = '$tanggal'
						WHERE orderID='$_POST[id]'");		
			header('location:../status-transaction.html');				
		}
		elseif($_POST['statusOrder']=='Dikembalikan'){
			mysql_query("UPDATE products,orders_detail SET products.qty=produk.qty+orders_detail.quantity
						WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'"); 
			
			mysql_query("UPDATE products,orders_detail SET products.sold=products.sold-orders_detail.quantity 
						WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'");
			
			mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]',
									rejectOrder ='1',
									rate = '$_POST[rating]'
						WHERE orderID='$_POST[id]'");		
			header('location:../history_transaksi.html');				
		}
		
	}
	
}


?>