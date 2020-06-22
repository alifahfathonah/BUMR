<?php
error_reporting(0);
session_start();
include "config/koneksi.php";
if ($_SESSION['email'] != ''){
	$queryUpdate = "UPDATE members SET shippingID	= '$_POST[shippingID]'
							WHERE memberID = '$_SESSION[useri]'"; 
	mysql_query($queryUpdate);	
	header("Location: profile.html?suc=ok");
}
else{
	header("Location: login.html?err=log");
}

?>