<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/header/aksi_header.php";
switch($_GET[act]){
  // Tampil header
  default:
    echo "<div class='btn-toolbar'><input type=button value='Tambah' class='btn btn-primary' onclick=location.href='?app=header&act=tambahheader'></div>
          
          <div class='well'><table class='table'>
           <thead><tr><th>#</th><th>Judul</th><th>Gambar</th><th>Aktif</th><th>Aksi</th><tbody></tr>";
    $tampil=mysql_query("SELECT * FROM header ORDER BY id_header DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
				<td>$r[judul]</td>
                <td><img src='../upload/header/$r[icon]' width='100px' height='70px'></td>
                <td>$r[status]</td>
                <td><a href=?app=header&act=editheader&id=$r[id_header]>Edit</a> | 
	                  <a href='$aksi?app=header&act=hapus&id=$r[id_header]&namafile=$r[icon]'>Hapus</a>
		        </tr>";
    $no++;
    }
    echo "</tbody></table></div>";
    break;
  
  case "tambahheader":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=header&act=input' enctype='multipart/form-data'>
			<label>ID Header</label>
			<input type='text' name='id' class='input-xlarge' />				
			<label>Judul</label>
			<input type='text' name='judul' class='input-xlarge' />			  
			<label>Gambar</label>
			<input type=file name='fupload' class='input-xlarge'>
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>			
		</form></div>";
     break;
    
  case "editheader":
    $edit = mysql_query("SELECT * FROM header WHERE id_header='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<div class='well'>
          <form method=POST enctype='multipart/form-data' action=$aksi?app=header&act=update>
          <input type=hidden name=id value=$r[id_header]>
		  	<label>Judul</label>
			<input type='text' name='judul' value='$r[judul]' class='input-xlarge' />	
          
			
			<label>Status</label>";
			if ($r['status']=='Y'){
			  echo "<input type=radio name='status' value='Y' checked>Y  
					 <input type=radio name='status' value='N'> N";
			}
			else{
			  echo "<input type=radio name='status' value='Y'>Y  
					<input type=radio name='status' value='N' checked>N";
			}		  
          echo"<label>Gambar</label>    : <img src='../upload/header/$r[icon]'>
          <label>Ganti Gambar</label>  : <input type=file name='fupload' size=30> *)
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
}
?>
