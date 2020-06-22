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

if ($module=='ads' AND $act=='input'){

	if ($_POST['filename1'] != ''){
		$file = "../upload/ads/".$_POST['filename1'];
		$gbr_asli = imagecreatefromjpeg($file);
		$lebar = imagesx($gbr_asli);
		$tinggi = imagesy($gbr_asli);
		
		$tum_lebar = 150;
		$tum_tinggi = 150;
		
		$gbr_thumb = imagecreatetruecolor($tum_lebar, $tum_tinggi);
		imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $tum_lebar, $tum_tinggi, $lebar, $tinggi);
		
		imagejpeg($gbr_thumb, "../upload/ads/thumb/small_".$_POST['filename1']);
		
		imagedestroy($gbr_asli);
		imagedestroy($gbr_thumb);
	}
	
	$adsSeo      = seo_title($_POST['adsName']); 
	$adsInvoice = B.date('ymdhis');	
	$adsDate = date('Y-m-d H:i:s');	
	mysql_query("INSERT INTO ads_order(adsID,
									  memberID,
									  adsInvoice,
									  adsName,
									  adsSeo,
									  adsUrl,
									  image1,
									  adsDescription,
									  adsTotal,
									  adsDate) 
					VALUES('$_POST[adsID]',
						   '$_SESSION[useri]',
						   '$adsInvoice',
						   '$_POST[adsName]',
						   '$adsSeo',
						   '$_POST[adsUrl]',
						   '$_POST[filename1]',
						   '$_POST[adsDescription]',
						   '$_POST[adsTotal]',
						   '$adsDate')");
	header('location:../list-ads.html?suc=ok');	
	
	
}

	
}
?>
