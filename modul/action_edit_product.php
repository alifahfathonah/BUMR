<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_seo.php";

if ($_SESSION['email'] != ''){
	
$productName = mysql_real_escape_string($_POST['productName']);
$productSeo = seo_title($productName);
$categoryID = $_POST['categoryID'];
$subCategoryID = $_POST['subCategoryID'];
$weight = $_POST['weight'];	
$qty = $_POST['qty'];	
$discount = $_POST['discount'];
$conditions = $_POST['conditions'];
$salePrice = $_POST['salePrice'];	
$UpdateDate = date('Y-m-d H:i:s');
$description = mysql_real_escape_string($_POST['description']);
$oldfile1 = $_POST['oldfile1'];
$oldfile2 = $_POST['oldfile2'];
$filename1 = $_POST['filename1'];
$filename2 = $_POST['filename2'];

	if ($filename1 != ""){
		$file1 = $filename1;
		
		unlink("../upload/produk/".$oldfile1);
		unlink("../upload/produk/thumb/small_".$oldfile1);
		
		$file = "../upload/produk/".$filename1;
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$filename1);
		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}
	else
	{
		$file1 = $oldfile1;
	}
	
	if ($filename2 != "")
	{
		$file2 = $filename2;
		unlink("../upload/produk/".$oldfile2);
		unlink("../upload/produk/thumb/small_".$oldfile2);
		
		$file = "../upload/produk/".$filename2;
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$filename2);
		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}
	else
	{
		$file2 = $oldfile2;
	}
	$queryUpdate="UPDATE products SET  	productName		= '$productName',
										productSeo 		= '$productSeo',
										categoryID 		= '$categoryID',
										subCategoryID 	= '$subCategoryID',
										conditions		= '$conditions',
										weight 			= '$weight',
										qty 			= '$qty',
										salePrice		= '$salePrice',
										discount		= '$discount',
										photo1			= '$file1',
										photo2			= '$file2',
										description		= '$description',
										updateDate		= '$$UpdateDate'
					WHERE productID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../list-product.html?suc=edit');	
}
else{
	header("Location: ../sign-in.html?err=log");	
}
?>