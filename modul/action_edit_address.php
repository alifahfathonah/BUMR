<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_seo.php";

if ($_SESSION['email'] != ''){
	$queryUpdate = "UPDATE members SET memberName	= '$_POST[memberName]',
								  provinceID 		= '$_POST[provinceID]',
								  cityID			= '$_POST[cityID]',
								  phone				= '$_POST[phone]',
								  address			= '$_POST[address]'
						WHERE memberID = '$_SESSION[useri]'"; 
	mysql_query($queryUpdate);
	header("Location:../save-view.html?suc=ok");	
}
else{
	header("Location: login.html?err=log");
}
?>