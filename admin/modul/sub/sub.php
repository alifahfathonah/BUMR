<?php
$aksi="modul/sub/aksi_sub.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=sub&act=tambahsub' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Kategori</th>
				<th>Nama Sub Kategori </th>										
				<th ></th><tbody>
		  </tr>"; 
	$p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);  		  
    $querySub = "SELECT * FROM sub_categories A LEFT JOIN 	
				categories B ON A.categoryID=B.categoryID
				ORDER BY A.subCategoryID DESC LIMIT $posisi,$batas";
	$sqlSub=mysql_query($querySub);
    $no=$posisi+1;
    while ($dtSub=mysql_fetch_array($sqlSub)){	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
			 <td><?php echo $dtSub['categoryName']; ?></td>
             <td><?php echo $dtSub['subCategoryName']; ?></td>			 			           
			 <td><a href='?app=sub&act=editsub&id=<?php echo $dtSub['subCategoryID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=sub&act=hapus&id=<?php echo $dtSub['subCategoryID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['nama_kat_informasi']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM sub_categories"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
  
  case "tambahsub":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=sub&act=input'>
		    <label>Kategori</label>     
			<select name='categoryID'>
						<option value=0 selected>- Kategori -</option>";
						$query = "SELECT * FROM categories ORDER BY categoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[categoryID]>$w[categoryName]</option>";
						}                                
			echo "</select>				
			<label>Sub Informasi</label>
			<input type='text' name='subCategoryName' class='input-xlarge' />							
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editsub":
    $querySub = "SELECT * FROM sub_categories WHERE subCategoryID='$_GET[id]'";
	$sqlSub = mysql_query($querySub);
    $dtSub=mysql_fetch_array($sqlSub);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=sub&act=update>
          <input type=hidden name=id value='$dtSub[subCategoryID]'>
		    <label>Kategori</label>     
			<select name='categoryID'>
						<option value=0 selected>- Kategori -</option>";
						$query = "SELECT * FROM categories ORDER BY categoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtSub['categoryID'] == $w['categoryID']){
								echo "<option value=$w[categoryID] SELECTED>$w[categoryName]</option>";
							}
							else{
								echo "<option value=$w[categoryID]>$w[categoryName]</option>";
							}
						}  
					
			echo "</select>			  
			<label>Nama Sub</label>
			<input type='text' name='subCategoryName' value='$dtSub[subCategoryName]' class='input-xlarge' />		
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
