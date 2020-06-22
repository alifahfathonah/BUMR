<?php
$aksi="modul/ekspedisi/aksi_ekspedisi.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=ekspedisi&act=tambahekspedisi' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Ekspedisi </th>		
				<th>Jenis</th>
				<th>Status</th>
				<th ></th><tbody>
		  </tr>"; 
	  		  
    $queryCourier = "SELECT * FROM courier ORDER BY courierID DESC";
	$sqlCourier=mysql_query($queryCourier);
    $no = 1;
    while ($dtCourier=mysql_fetch_array($sqlCourier)){	
		if($dtCourier['status'] == 'Y'){
			$status = "Aktif";
		}
		else {
			$status = "Tidak Aktif";
		}	
		if($dtCourier['courierType'] == 'U'){
			$status1 = "Ekspedisi Umum";
		}
		else {
			$status1 = "Non Ekspedisi Umum(Travel,Bus)";
		}			
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtCourier['courierName']; ?></td>	
				<td><?php echo $status; ?></td>	
				<td><?php echo $status1; ?></td>	
			 <td><a href='?app=ekspedisi&act=editekspedisi&id=<?php echo $dtCourier['courierID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=ekspedisi&act=hapus&id=<?php echo $dtCourier['courierID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['courierName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahekspedisi":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=ekspedisi&act=input'>
			<label>Nama Ekspedisi</label>
			<input type='text' name='courierName' class='input-xlarge' />
			<label>Jenis </label>
			<select name='type' required>
				<option value='U' SELECTED>Ekspedisi Umum</option>
				<option value='N'>Non Ekspedisi Umum (travel,bus)</option>
			</select>			
			<label>Status</label>
			<select name='status' required>
				<option value='Y' SELECTED>Aktif</option>
				<option value='N'>Tidak Aktif</option>
			</select>	
			<label>Layanan Kurir</label>
			<input type='text' name='desc' class='input-xlarge' />			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editekspedisi":
    $queryCourier = "SELECT * FROM courier WHERE courierID='$_GET[id]'";
	$sqlCourier = mysql_query($queryCourier);
    $dtCourier=mysql_fetch_array($sqlCourier);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=ekspedisi&act=update>
          <input type=hidden name=id value='$dtCourier[courierID]'>
			<label>Nama Ekspedisi</label>
			<input type='text' name='courierName' value='$dtCourier[courierName]' class='input-xlarge' />
			<label>Status</label>
			<select name='status' required>";
	?>
				<option value="Y" <?php if($dtCourier['status']=="Y"){echo "selected";} ?>>Aktif</option>
				<option value="N" <?php if($dtCourier['status']=="N"){echo "selected";} ?>>Tidak Aktif</option>
	<?php
			echo"</select>				
			<label>Layanan Kurir</label>
			<input type='text' name='desc' value='$dtCourier[courierDesc]' class='input-xlarge' />			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
