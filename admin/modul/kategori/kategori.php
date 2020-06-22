<?php
$aksi="modul/kategori/aksi_kategori.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=kategori&act=tambahkategori' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Kategori </th>										
				<th ></th><tbody>
		  </tr>"; 
	  		  
    $queryCategory = "SELECT * FROM categories ORDER BY categoryID DESC";
	$sqlCategory=mysql_query($queryCategory);
    $no = 1;
    while ($dtCategory=mysql_fetch_array($sqlCategory)){	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtCategory['categoryName']; ?></td>			 			           
			 <td><a href='?app=kategori&act=editkategori&id=<?php echo $dtCategory['categoryID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=kategori&act=hapus&id=<?php echo $dtCategory['categoryID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['nama_kat_informasi']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahkategori":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=kategori&act=input' enctype='multipart/form-data'>
			<label>Kategori </label>
			<input type='text' name='categoryName' class='input-xlarge' />	
			<label>Keterangan</label>
			<input type='text' name='title' class='input-xlarge' />	
			<label>Gambar</label>
			<input type=file name='fupload' class='input-xlarge'>
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editkategori":
    $queryCategory = "SELECT * FROM categories WHERE categoryID='$_GET[id]'";
	$sqlCategory = mysql_query($queryCategory);
    $dtCategory=mysql_fetch_array($sqlCategory);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=kategori&act=update>
          <input type=hidden name=id value='$dtCategory[categoryID]'>
			<label>Nama kategori</label>
			<input type='text' name='categoryName' value='$dtCategory[categoryName]' class='input-xlarge' />		
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
