

<?php
$aksi="modul/artikel/aksi_artikel.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=artikel&act=tambahartikel' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Judul</th>	
				<th>Kategori</th>
				<th ></th><tbody>
		  </tr>"; 
	  		  
    $queryCategory = "SELECT * FROM articles A LEFT JOIN
				art_categories B ON A.artCategoryID=B.artCategoryID
				ORDER BY articleID DESC";
	$sqlCategory=mysql_query($queryCategory);
    $no = 1;
    while ($dtCategory=mysql_fetch_array($sqlCategory)){	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtCategory['articleTitle']; ?></td>	
			  <td><?php echo $dtCategory['artCategoryName']; ?></td>							 
			 <td><a href='?app=artikel&act=editartikel&id=<?php echo $dtCategory['articleID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=artikel&act=hapus&id=<?php echo $dtCategory['articleID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['articleName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahartikel":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=artikel&act=input' enctype='multipart/form-data'>
		    <label>Kategori</label>     
			<select name='artCategoryID'>
						<option value=0 selected>- Kategori -</option>";
						$query = "SELECT * FROM art_categories ORDER BY artCategoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[artCategoryID]>$w[artCategoryName]</option>";
						}                                
			echo "</select>			  
			<label>Judul </label>
			<input type='text' name='articleTitle' class='input-xlarge' />	
			<label>Keterangan</label>
			<textarea  name='articleDesc' class='ckeditor'></textarea>	
			<label>Gambar</label>
			<input type=file name='fupload' class='input-xlarge'>
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editartikel":
    $queryCategory = "SELECT * FROM articles WHERE articleID='$_GET[id]'";
	$sqlCategory = mysql_query($queryCategory);
    $dtCategory=mysql_fetch_array($sqlCategory);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=artikel&act=update>
          <input type=hidden name=id value='$dtCategory[articleID]'>
		    <label>Kategori</label>     
			<select name='artCategoryID'>
						<option value=0 selected>- Kategori -</option>";
						$query = "SELECT * FROM art_categories ORDER BY artCategoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtSub['artCategoryID'] == $w['artCategoryID']){
								echo "<option value=$w[artCategoryID] SELECTED>$w[artCategoryName]</option>";
							}
							else{
								echo "<option value=$w[artCategoryID]>$w[artCategoryName]</option>";
							}
						}  
					
			echo "</select>			  
			<label>Judul</label>
			<input type='text' name='articleTitle' value='$dtCategory[articleTitle]' class='input-xlarge' />	
			<label>Keterangan</label>
			<textarea class='ckeditor' name='articleDesc'>$dtCategory[articleDesc]</textarea>			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
