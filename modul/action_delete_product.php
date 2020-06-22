
<?php
session_start();
if ($_SESSION['email'] != ''){
include "../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET[act];


if ($module == 'produk' && $act == 'delete'){
	$productID = $_GET['productID'];
	$file1 = $_GET['file1'];
	$file2 = $_GET['file2'];

	
	unlink("../upload/produk/".$file1);
	unlink("../upload/produk/".$file2);

	unlink("../upload/produk/thumb/small_".$file1);
	unlink("../upload/produk/thumb/small_".$file2);

	
	$queryProduct = "DELETE FROM products WHERE productID = '$productID'";
	mysql_query($queryProduct);
	
	header('location:../list-product.html?suc=delete');
}

}
?>