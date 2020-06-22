

<?php
$aksi="modul/kaartikel/aksi_kaartikel.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=kaartikel&act=tambahkaartikel' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Nama Kategori</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
	  		  
    $queryCategory = "SELECT * FROM art_categories ORDER BY artCategoryID DESC";
	$sqlCategory=mysql_query($queryCategory);
    $no = 1;
    while ($dtCategory=mysql_fetch_array($sqlCategory)){	
		if($dtCategory['active'] == 'Y'){
			$status = "Aktif";
		}
		else {
			$status = "Tidak Aktif";
		}	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtCategory['artCategoryName']; ?></td>
			 <td><?php echo $status ?></td>				 
			 <td><a href='?app=kaartikel&act=editkaartikel&id=<?php echo $dtCategory['artCategoryID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=kaartikel&act=hapus&id=<?php echo $dtCategory['artCategoryID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['artCategoryName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahkaartikel":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=kaartikel&act=input' enctype='multipart/form-data'>
			<label>Nama Kategori </label>
			<input type='text' name='artCategoryName' class='input-xlarge' />	
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editkaartikel":
    $queryCategory = "SELECT * FROM art_categories WHERE artCategoryID='$_GET[id]'";
	$sqlCategory = mysql_query($queryCategory);
    $dtCategory=mysql_fetch_array($sqlCategory);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=kaartikel&act=update>
          <input type=hidden name=id value='$dtCategory[artCategoryID]'>
			<label>Nama Kategori</label>
			<input type='text' name='artCategoryName' value='$dtCategory[artCategoryName]' class='input-xlarge' />		
			<label>Status</label>
			<select name='active' required>";
	?>
				<option value="Y" <?php if($dtCategory['status']=="Y"){echo "selected";} ?>>Aktif</option>
				<option value="N" <?php if($dtCategory['status']=="N"){echo "selected";} ?>>Tidak Aktif</option>
	<?php
			echo"</select>			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
