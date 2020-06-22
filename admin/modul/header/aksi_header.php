<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET['act'];

// Hapus header
if ($module=='header' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT icon FROM header WHERE id_header='$_GET[id]'"));
  if ($data['icon']!=''){
     mysql_query("DELETE FROM header WHERE id_header='$_GET[id]'");
     unlink("../../../upload/header/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM header WHERE id_header='$_GET[id]'");
  }
  header('location:../../beranda.php?app='.$module);
}

// Input header
elseif ($module=='header' AND $act=='input'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	$created_date = date('Y-m-d H:i:s');
	
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadHeader($nama_file);
    mysql_query("INSERT INTO header(icon,id,judul,
									createDate) 
                            VALUES('$nama_file','$_POST[id_header]','$_POST[judul]'
								   '$created_date')");
  }
  else{
    mysql_query("INSERT INTO header(created_date) 
                            VALUES('$created_date')");
  }
  header('location:../../beranda.php?app='.$module);
}



// Update header
elseif ($module=='header' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  // Apabila icon tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE header SET status	= '$_POST[status]',
									judul = '$_POST[judul]'
                             WHERE id_header = '$_POST[id]'");
	header('location:../../beranda.php?app='.$module);
  }
  else{
    UploadHeader($nama_file);
    mysql_query("UPDATE header SET  status				= '$_POST[status]',
									icon   				= '$nama_file',
									judul 				= '$_POST[judul]'
                             WHERE id_header = '$_POST[id]'");
	header('location:../../beranda.php?app='.$module);
  
  }
}
}
?>
