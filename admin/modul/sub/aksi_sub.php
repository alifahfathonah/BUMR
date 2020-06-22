<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='sub' AND $act=='hapus'){
  $queryDelete="DELETE FROM sub_categories WHERE subCategoryID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}

elseif ($module=='sub' AND $act=='input'){
	$subCategoryName = mysql_real_escape_string($_POST['subCategoryName']);
	$subCategorySeo = seo_title($subCategoryName);	
	$categoryID = $_POST['categoryID'];
	$queryInput="INSERT INTO sub_categories(subCategoryName,categoryID,subCategorySeo) 
					VALUES('$subCategoryName','$categoryID','$subCategorySeo')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='sub' AND $act=='update'){
	$subCategoryName = mysql_real_escape_string($_POST['subCategoryName']);
	$subCategorySeo = seo_title($subCategoryName);	
	$categoryID = $_POST['categoryID'];
	$queryUpdate="UPDATE sub_categories SET 
						subCategoryName = '$subCategoryName',
						categoryID = '$categoryID',
						subCategorySeo='$subCategorySeo' 
				WHERE subCategoryID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>