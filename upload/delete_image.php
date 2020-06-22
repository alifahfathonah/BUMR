<?php
error_reporting(0);
session_start();
include "../config/koneksi.php";


$module = $_GET['app'];
$act = $_GET['act'];

if ($module == 'produk' && $act == 'delimage')
{
	$no = $_GET['no'];
	$file = $_GET['file'];
	$productID = $_GET['pid'];
	
	unlink("produk/".$file);
	unlink("produk/thumb/small_".$file);
	
	if ($no == '1')
	{
		mysql_query("UPDATE products SET photo1 = '' WHERE productID = '$productID'");
	}
	if ($no == '2')
	{
		mysql_query("UPDATE products SET photo2 = '' WHERE productID = '$productID'");
	}
	

	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>