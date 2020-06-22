<?php
session_start();
include "config/koneksi.php";

if ($_SESSION['email'] != ''){
	$queryUpdate = "UPDATE members SET courierID	= '$_POST[courierID]',
										shippingID = '$_POST[shippingID]'
							WHERE memberID = '$_SESSION[useri]'"; 
	mysql_query($queryUpdate);	
	header("Location: save-view.html?suc=ok");
}
else{
	header("Location: login.html?err=log");
}
	
?>