<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='kaartikel' AND $act=='hapus'){
  $queryDelete="DELETE FROM art_categories WHERE artCategoryID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kaartikel' AND $act=='input'){
	$artCategoryName = mysql_real_escape_string($_POST['artCategoryName']);	
	$artCategorySeo = seo_title($artCategoryName);	
	
	mysql_query("INSERT INTO art_categories(artCategoryName,artCategorySeo) 
						VALUES('$artCategoryName','$artCategorySeo')");			
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='kaartikel' AND $act=='update'){
	$artCategoryName = mysql_real_escape_string($_POST['artCategoryName']);
	$artCategorySeo = seo_title($artCategoryName);
	$status = mysql_real_escape_string($_POST['active']);	
	$queryUpdate="UPDATE art_categories SET 
						artCategoryName = '$artCategoryName', 
						artCategorySeo='$artCategorySeo',
						active='$status'
				WHERE artCategoryID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>