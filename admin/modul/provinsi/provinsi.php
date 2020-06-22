<?php
$aksi="modul/provinsi/aksi_provinsi.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=provinsi&act=tambahprovinsi' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Nama Provinsi </th>		
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
	  		  
    $queryProvince = "SELECT * FROM provinces ORDER BY provinceID DESC";
	$sqlProvince=mysql_query($queryProvince);
    $no = 1;
    while ($dtProvince=mysql_fetch_array($sqlProvince)){	
		if($dtProvince['status'] == 'Y'){
			$status = "Aktif";
		}
		else {
			$status = "Tidak Aktif";
		}
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtProvince['provinceName']; ?></td>		
			  <td><?php echo $status; ?></td>				 
			 <td><a href='?app=provinsi&act=editprovinsi&id=<?php echo $dtProvince['provinceID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=provinsi&act=hapus&id=<?php echo $dtCategory['categoryID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['provinceName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahprovinsi":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=provinsi&act=input'>
			<label>Nama Provinsi</label>
			<input type='text' name='provinceName' class='input-xlarge' />	
			<label>Status</label>
			<select name='status' required>
				<option value='Y' SELECTED>Aktif</option>
				<option value='N'>Tidak Aktif</option>
			</select>
				
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editprovinsi":
    $queryProvince = "SELECT * FROM provinces WHERE provinceID='$_GET[id]'";
	$sqlProvince = mysql_query($queryProvince);
    $dtProvince=mysql_fetch_array($sqlProvince);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=provinsi&act=update>
          <input type=hidden name=id value='$dtProvince[provinceID]'>
			<label>Nama Provinsi</label>
			<input type='text' name='provinceName' value='$dtProvince[provinceName]' class='input-xlarge' />
			<label>Status</label>
			<select name='status' required>";
	?>
				<option value="Y" <?php if($dtProvince['status']=="Y"){echo "selected";} ?>>Aktif</option>
				<option value="N" <?php if($dtProvince['status']=="N"){echo "selected";} ?>>Tidak Aktif</option>
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
