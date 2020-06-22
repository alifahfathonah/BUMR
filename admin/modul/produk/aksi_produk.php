<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='produk' AND $act=='hapus'){
	$productID = $_GET['id'];
	$file1 = $_GET['file1'];
	$file2 = $_GET['file2'];
	unlink("../../../upload/produk/".$file1);
	unlink("../../../upload/produk/".$file2);
	$queryDelete="DELETE FROM products WHERE productID='$productID'";
	mysql_query($queryDelete);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='produk' AND $act=='input'){
	$productName = mysql_real_escape_string($_POST['productName']);
	$condition = mysql_real_escape_string($_POST['condition']);
	$productSeo = seo_title($productName);
	$categoryID = $_POST['categoryID'];
	$subCategoryID = $_POST['subCategoryID'];
	$supplierID = $_POST['supplierID'];
	$weight = $_POST['weight'];	
	$qty = $_POST['qty'];	
	$productCode = date('ymdhis');
	$discount = $_POST['discount'];
	$sold = $_POST['sold'];
	$status = $_POST['status'];
	$salePrice = $_POST['salePrice'];	
	$buyPrice = $_POST['buyPrice'];
	$createDate = date('Y-m-d H:i:s');
	$description = mysql_real_escape_string($_POST['description']);
	
	if ($_POST['filename1'] != ''){
		$file = "../../../upload/produk/".$_POST['filename1'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../../../upload/produk/thumb/small_".$_POST['filename1']);
		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}

	if ($_POST['filename2'] != ''){
		$file = "../../../upload/produk/".$_POST['filename2'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../../../upload/produk/thumb/small_".$_POST['filename2']);

		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}
	
	$queryInput="INSERT INTO products(subCategoryID,
									  categoryID,
									  supplierID,
									  productCode,
									  condition,
									  productName,
									  productSeo,
									  weight,
									  qty,
									  discount,
									  sold,
									  status,
									  photo1,
									  photo2,
									  salePrice,
									  buyPrice,
									  description,
									  createDate) 
					VALUES('$subCategoryID',
						   '$categoryID',
						   '$supplierID',
						   '$productCode',
						   '$condition',
						   '$productName',
						   '$productSeo',
						   '$weight',
						   '$qty',
						   '$discount',
						   '$sold',
						   '$status',
						   '$_POST[filename1]',
						   '$_POST[filename2]',
						   '$salePrice',
						   '$buyPrice',
						   '$description',
						   '$createDate')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='produk' AND $act=='update'){
	$productName = mysql_real_escape_string($_POST['productName']);
	$productSeo = seo_title($productName);
	$categoryID = $_POST['categoryID'];
	$subCategoryID = $_POST['subCategoryID'];
	$supplierID = $_POST['supplierID'];
	$weight = $_POST['weight'];	
	$qty = $_POST['qty'];	
	$productCode = date('ymdhis');
	$discount = $_POST['discount'];
	$sold = $_POST['sold'];
	$status = $_POST['status'];
	$salePrice = $_POST['salePrice'];	
	$buyPrice = $_POST['buyPrice'];
	$createDate = date('Y-m-d H:i:s');
	$description = mysql_real_escape_string($_POST['description']);
	$oldfile1 = $_POST['oldfile1'];
	$oldfile2 = $_POST['oldfile2'];
	$filename1 = $_POST['filename1'];
	$filename2 = $_POST['filename2'];
	
	if ($filename1 != ""){
		$file1 = $filename1;
		
		unlink("../../../upload/produk/".$oldfile1);
		unlink("../../../upload/produk/thumb/small_".$oldfile1);
		
		$file = "../../../upload/produk/".$filename1;
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../../../upload/produk/thumb/small_".$filename1);
		
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
		unlink("../../../upload/produk/".$oldfile2);
		unlink("../../../upload/produk/thumb/small_".$oldfile2);
		
		$file = "../../../upload/produk/".$filename2;
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../../../upload/produk/thumb/small_".$filename2);
		
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
										supplierID 		= '$supplierID',
										weight 			= '$weight',
										qty 			= '$qty',
										buyPrice		= '$buyPrice',
										salePrice		= '$salePrice',
										discount		= '$discount',
										photo1			= '$file1',
										photo2			= '$file2',
										status			= '$status',
										description		= '$description'
					WHERE productID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>