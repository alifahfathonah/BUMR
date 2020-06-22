<?php
error_reporting(0);
session_start();
include "config/koneksi.php";
include "config/fungsi_thumb.php";

if ($_SESSION['email'] != ''){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  if (empty($lokasi_file)){
	$queryUpdate = "UPDATE members SET memberName	= '$_POST[memberName]',
								  nomorKTP          = '$_POST[nomorKTP]',
								  gender			= '$_POST[gender]',
								  email				= '$_POST[email]',
								  provinceID 		= '$_POST[provinceID]',
								  bankID			= '$_POST[bankID]',
								  rekening			= '$_POST[rekening]',
								  cityID			= '$_POST[cityID]',
								  phone				= '$_POST[phone]',
								  hobi              = '$_POST[hobi]',
								  tanggalLahir      = '$_POST[tanggalLahir]',
								  address			= '$_POST[address]'
						WHERE memberID = '$_SESSION[useri]'"; 
	mysql_query($queryUpdate);
  }
  else{
    UploadMember($nama_file);
	$queryUpdate = "UPDATE members SET memberName	= '$_POST[memberName]',
								  nomorKTP          = '$_POST[nomorKTP]',
								  gender		= '$_POST[gender]',
								  email			= '$_POST[email]',
								  phone			= '$_POST[phone]',
								  hobi          = '$_POST[hobi]',
								  tanggalLahir      = '$_POST[tanggalLahir]',
								  provinceID 	= '$_POST[provinceID]',
								  bankID		= '$_POST[bankID]',
								  rekening		= '$_POST[rekening]',
								  cityID		= '$_POST[cityID]',								  
								  address		= '$_POST[address]',
								  photo			= '$nama_file'
						WHERE memberID = '$_SESSION[useri]'"; 
	mysql_query($queryUpdate);
  } 
  header("Location: profile.html?suc=ok");	
}
else{
	header("Location: login.html?err=log");
}
?>