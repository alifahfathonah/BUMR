<?php
$aksi="modul/kota/aksi_kota.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=kota&act=tambahkota' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Provinsi</th>
				<th>Nama Kota </th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
    $p      = new Paging;
    $batas  = 9;
    $posisi = $p->cariPosisi($batas);		  		  
    $queryCity = "SELECT * FROM cities A LEFT JOIN 	
				provinces B ON A.provinceID=B.provinceID
				ORDER BY A.cityID DESC LIMIT $posisi,$batas";
	$sqlCity=mysql_query($queryCity);
    $no = $posisi+1;
    while ($dtCity=mysql_fetch_array($sqlCity)){	
		if($dtCity['status'] == 'Y'){
			$status = "Aktif";
		}
		else {
			$status = "Tidak Aktif";
		}	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
			 <td><?php echo $dtCity['provinceName']; ?></td>
             <td><?php echo $dtCity['cityName']; ?></td>			
			 <td><?php echo $status; ?></td>				 
			 <td><a href='?app=kota&act=editkota&id=<?php echo $dtCity['cityID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=kota&act=hapus&id=<?php echo $dtCity['cityID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $dtCity['cityName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	$query = "SELECT * FROM cities";
	$sql = mysql_query($query);
	$jmldata = mysql_num_rows($sql);
	//$jmldata = mysqli_num_rows(mysql_query($connect, "SELECT * FROM cities"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);	
    echo "<div id=paging>Halaman : $linkHalaman</div><br>";		
    break;
  
  case "tambahkota":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=kota&act=input'>
		    <label>Provinsi</label>     
			<select name='provinceID'>
						<option value=0 selected>- Pilih Provinsi -</option>";
						$query = "SELECT * FROM provinces ORDER BY provinceID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[provinceID]>$w[provinceName]</option>";
						}                                
			echo "</select>				
			<label>Nama Kota</label>
			<input type='text' name='cityName' class='input-xlarge' />	
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

  case "editkota":
    $queryCity = "SELECT * FROM cities WHERE cityID='$_GET[id]'";
	$sqlCity = mysql_query($queryCity);
    $dtCity=mysql_fetch_array($sqlCity);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=kota&act=update>
          <input type=hidden name=id value='$dtCity[cityID]'>
		    <label>Provinsi</label>     
			<select name='provinceID'>
						<option value=0 selected>- Pilih Provinsi -</option>";
						$query = "SELECT * FROM provinces ORDER BY provinceID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtCity['provinceID'] == $w['provinceID']){
								echo "<option value=$w[provinceID] SELECTED>$w[provinceName]</option>";
							}
							else{
								echo "<option value=$w[provinceID]>$w[provinceName]</option>";
							}
						}  
					
			echo "</select>			  
			<label>Nama Kota</label>
			<input type='text' name='cityName' value='$dtCity[cityName]' class='input-xlarge' />
			<label>Status</label>
			<select name='status' required>";
	?>
				<option value="Y" <?php if($dtCity['status']=="Y"){echo "selected";} ?>>Aktif</option>
				<option value="N" <?php if($dtCity['status']=="N"){echo "selected";} ?>>Tidak Aktif</option>
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
