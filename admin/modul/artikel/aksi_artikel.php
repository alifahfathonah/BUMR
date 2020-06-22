<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='artikel' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT articleImage FROM articles WHERE articleID='$_GET[id]'"));
  if ($data['articleImage']!=''){
     mysql_query("DELETE FROM articles WHERE articleID='$_GET[id]'");
     unlink("../../../upload/artikel/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM articles WHERE articleID='$_GET[id]'");
  }
  header('location:../../beranda.php?app='.$module);
}
/*
if ($module=='artikel' AND $act=='hapus'){
	$articleID = $_GET['id'];
	$file1 = $_GET['namafile'];
	unlink("../../../upload/artikel/".$file1);
	$queryDelete="DELETE FROM articles WHERE articleID='$articleID'";
	mysql_query($queryDelete);
	header('location:../../beranda.php?app='.$module);
}
*/

elseif ($module=='artikel' AND $act=='input'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];	
	$articleTitle = mysql_real_escape_string($_POST['articleTitle']);
	$articleSeo = seo_title($articleTitle);		
	$articleDesc = mysql_real_escape_string($_POST['articleDesc']);	
	$date = date('Y-m-d H:i:s');

	if (!empty($lokasi_file)){
		UploadArtikel($nama_file);
		mysql_query("INSERT INTO articles(artCategoryID,articleTitle,articleSeo,articleDesc,articleImage,createDate,createUser) 
						VALUES('$_POST[artCategoryID]','$articleTitle','$articleSeo','$articleDesc','$nama_file','$date','$_SESSION[useri]')");		
	}
	else{
		mysql_query("INSERT INTO articles(artCategoryID,articleTitle,articleSeo,articleDesc,createDate,createUser) 
						VALUES('$_POST[artCategoryID]','$articleTitle','$articleSeo','$articleDesc','$date','$_SESSION[useri]')");			
	}
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='artikel' AND $act=='update'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];	
	$articleTitle = mysql_real_escape_string($_POST['articleTitle']);
	$articleSeo = seo_title($articleTitle);		
	$articleDesc = mysql_real_escape_string($_POST['articleDesc']);	
	$date = date('Y-m-d H:i:s');
	if (empty($lokasi_file)){
	$queryUpdate="UPDATE articles SET 
						artCategoryID = '$_POST[artCategoryID]',
						articleTitle = '$articleTitle', 
						articleSeo='$articleSeo',
						articleDesc='$articleDesc',
				WHERE articleID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);		
	
	}
	else{
	UploadArtikel($nama_file);
	$queryUpdate="UPDATE articles SET 
						artCategoryID = '$_POST[artCategoryID]',
						articleTitle = '$articleTitle', 
						articleSeo='$articleSeo',
						articleImage='$nama_file',
						articleDesc='$articleDesc',
				WHERE articleID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);		
	}



}
?>