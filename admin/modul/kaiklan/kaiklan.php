<?php
$aksi="modul/kaiklan/aksi_kaiklan.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Judul</th>		
				<th>Harga</th>
				<th ></th><tbody>
		  </tr>"; 
	  		  
    $queryCategory = "SELECT * FROM ads ORDER BY adsID DESC";
	$sqlCategory=mysql_query($queryCategory);
    $no = 1;
    while ($dtCategory=mysql_fetch_array($sqlCategory)){
	$harga=format_rupiah($dtCategory['adsPrice']);	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtCategory['adsTitle']; ?></td>	
			 <td>Rp.<?php echo $harga; ?></td>	
			 <td><a href='?app=kaiklan&act=editiklan&id=<?php echo $dtCategory['adsID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=kaiklan&act=hapus&id=<?php echo $dtCategory['adsID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya ');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahiklan":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=kaiklan&act=input' enctype='multipart/form-data'>
			<label>Judul </label>
			<input type='text' name='adsTitle' class='input-xlarge' />	
			<label>Harga</label>
			<input type='text' name='adsPrice' class='input-xlarge' />	
			<label>Kerangan</label>
			<textarea  name='adsDesc' class='ckeditor'></textarea>
			<tex
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editiklan":
    $queryCategory = "SELECT * FROM ads WHERE adsID='$_GET[id]'";
	$sqlCategory = mysql_query($queryCategory);
    $dtCategory=mysql_fetch_array($sqlCategory);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=kaiklan&act=update>
          <input type=hidden name=id value='$dtCategory[adsID]'>
			<label>Judul</label>
			<input type='text' name='adsTitle' value='$dtCategory[adsTitle]' class='input-xlarge' />		
			<label>Harga</label>
			<input type='text' name='adsPrice' value='$dtCategory[adsPrice]' class='input-xlarge' />	
			<label>Keterangan</label>
			<textarea  name='adsDesc' class='ckeditor'>$dtCategory[adsDesc]</textarea>			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
