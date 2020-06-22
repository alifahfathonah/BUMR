<?php
session_start();
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
session_start();
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_thumb.php";
include "../config/fungsi_seo.php";


$module=$_GET['module'];
$act=$_GET[act];

if ($module=='produk' AND $act=='input'){

	if ($_POST['filename1'] != ''){
		$file = "../upload/produk/".$_POST['filename1'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$_POST['filename1']);
		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}
	if ($_POST['filename2'] != ''){
		$file = "../upload/produk/".$_POST['filename2'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$_POST['filename2']);

		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}	
	if ($_POST['filename3'] != ''){
		$file = "../upload/produk/".$_POST['filename3'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$_POST['filename3']);

		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}		
	if ($_POST['filename4'] != ''){
		$file = "../upload/produk/".$_POST['filename4'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$_POST['filename4']);

		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}	
	if ($_POST['filename5'] != ''){
		$file = "../upload/produk/".$_POST['filename5'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$_POST['filename5']);

		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}	
	if ($_POST['filename6'] != ''){
		$file = "../upload/produk/".$_POST['filename6'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/produk/thumb/small_".$_POST['filename6']);

		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}	
	$productSeo      = seo_title($_POST['productName']); 
	$productCode = date('ymdhis');	
	$createDate = date('Y-m-d H:i:s');	
	mysql_query("INSERT INTO products(categoryID,
									  subCategoryID,
									  memberID,
									  productCode,
									  productName,
									  productSeo,
									  salePrice,
									  conditions,
									  qty,
									  weight,
									  discount,
									  description,
									  photo1,
									  photo2,
									  photo3,
									  photo4,
									  photo5,
									  photo6,
									  createDate) 
					VALUES('$_POST[categoryID]',
						   '$_POST[subCategoryID]',
						   '$_SESSION[useri]',
						   '$productCode',
						   '$_POST[productName]',
						   '$productSeo',
						   '$_POST[salePrice]',
						   '$_POST[condition]',
						   '$_POST[qty]',
						   '$_POST[weight]',
						   '$_POST[discount]',
						   '$_POST[description]',
						   '$_POST[filename1]',
						   '$_POST[filename2]',
						   '$_POST[filename3]',
						   '$_POST[filename4]',
						   '$_POST[filename5]',
						   '$_POST[filename6]',
						   '$createDate')");
	header('location:../list-product.html?suc=ok');	
	
	
}

	
}
?>
