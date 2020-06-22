<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

$date = date('Y-m-d H:i:s');
if ($module=='new' AND $act=='update'){
	if ($_POST['statusOrder']=='Dikirim'){ 
      //mysql_query("UPDATE products,orders_detail SET products.qty=product.qty-orders_detail.quantity WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'");
      //mysql_query("UPDATE products,orders_detail SET products.sold=products.sold+orders_detail.quantity WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'");
		
      mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]',
									 sendOrder = '1',
									 dateSend = '$date'
						WHERE orderID='$_POST[id]'");

      header('location:../../beranda.php?app='.$module);
    }	  
	elseif($_POST['statusOrder']=='Dikembalikan'){
	    mysql_query("UPDATE products,orders_detail SET products.qty=products.qty+orders_detail.quantity WHERE products.productID=orders_detail.productID AND orders_detail.orderID='$_POST[id]'"); 
	    mysql_query("UPDATE products,orders_detail SET products.sold=products.sold-orders_detail.quantity WHERE products.productID=orders_detail.productID and orders_detail.orderID='$_POST[id]'");

		mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]'
					WHERE orderID='$_POST[id]'");
		header('location:../../beranda.php?app='.$module);
	}
    else{
		mysql_query("UPDATE orders SET statusOrder='$_POST[statusOrder]'
					WHERE orderID='$_POST[id]'");
		header('location:../../beranda.php?app='.$module);
    }
}
?>