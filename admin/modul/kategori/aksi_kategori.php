<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='kategori' AND $act=='hapus'){
  $queryDelete="DELETE FROM categories WHERE categoryID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kategori' AND $act=='input'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];	
	$categoryName = mysql_real_escape_string($_POST['categoryName']);
	$categorySeo = seo_title($categoryName);	
	if (!empty($lokasi_file)){
		UploadKategori($nama_file);
		mysql_query("INSERT INTO categories(categoryName,categorySeo,icons,title) 
						VALUES('$categoryName','$categorySeo','$nama_file','$_POST[title]')");		
	}
	else{
		mysql_query("INSERT INTO categories(categoryName,categorySeo,title) 
						VALUES('$categoryName','$categorySeo','$_POST[title]')");			
	}
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kategori' AND $act=='update'){
	$categoryName = mysql_real_escape_string($_POST['categoryName']);
	$categorySeo = seo_title($categoryName);
	$queryUpdate="UPDATE categories SET 
						categoryName = '$categoryName', 
						categorySeo='$categorySeo' 
				WHERE categoryID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>