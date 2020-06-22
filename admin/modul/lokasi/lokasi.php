<script>
$(document).ready(function(){
	$("#provinceID").change(function(){
				var province = $("#provinceID").val();
				$.ajax({
					url: "../getdata/get_cities.php",
					data: "province="+province,
					cache: false,
					success: function(msg){
						$("#cityID").html(msg);
					}
				});
	});	
});
</script>
<?php
$aksi="modul/lokasi/aksi_lokasi.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=lokasi&act=tambahlokasi' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Ekspedisi</th>
				<th>Provinsi</th>
				<th>Kota </th>
				<th>Lokasi Pengambilan</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
    $p      = new Paging;
    $batas  = 9;
    $posisi = $p->cariPosisi($batas);		  		  
    $queryLocation = "SELECT * FROM location A LEFT JOIN 	
				provinces B ON A.provinceID=B.provinceID LEFT JOIN
				courier C ON A.courierID=C.courierID LEFT JOIN
				cities D ON A.cityID=D.cityID 
				ORDER BY A.locationID DESC LIMIT $posisi,$batas";
	$sqlLocation=mysql_query($queryLocation);
    $no = $posisi+1;
    while ($dtLocation=mysql_fetch_array($sqlLocation)){	
		if($dtLocation['status'] == 'Y'){
			$status = "Aktif";
		}
		else {
			$status = "Tidak Aktif";
		}	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
			 <td><?php echo $dtLocation['courierName']; ?></td>
             <td><?php echo $dtLocation['provinceName']; ?></td>	
			 <td><?php echo $dtLocation['cityName']; ?></td>
			 <td><?php echo $dtLocation['locationName']; ?></td>			 
			 <td><?php echo $status; ?></td>				 
			 <td><a href='?app=lokasi&act=editlokasi&id=<?php echo $dtLocation['locationID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=lokasi&act=hapus&id=<?php echo $dtLocation['locationID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $dtLocation['locationName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	$query = "SELECT * FROM location";
	$sql = mysql_query($query);
	$jmldata = mysql_num_rows($sql);
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);	
    echo "<div id=paging>Halaman : $linkHalaman</div><br>";		
    break;
  
  case "tambahlokasi":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=lokasi&act=input'>
		    <label>Ekspedisi</label>     
			<select name='courierID'>
						<option value=0 selected>- Pilih Jasa Ekspedisi -</option>";
						$query = "SELECT * FROM courier ORDER BY courierID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[courierID]>$w[courierName]</option>";
						}                                
			echo "</select>			  
		    <label>Provinsi</label>     
			<select name='provinceID' id='provinceID'>
						<option value=0 selected>- Pilih Provinsi -</option>";
						$query = "SELECT * FROM provinces ORDER BY provinceID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[provinceID]>$w[provinceName]</option>";
						}                                
			echo "</select>		
			<label>Kota</label>
			<select id='cityID' name='cityID' required>
				<option value=''></option>
			</select>			
			<label>Lokasi Pengambilan</label>
			<input type='text' name='locationName' class='input-xlarge' />	
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

  case "editlokasi":
    $queryLocation = "SELECT * FROM location WHERE locationID='$_GET[id]'";
	$sqlLocation = mysql_query($queryLocation);
    $dtLocation=mysql_fetch_array($sqlLocation);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=lokasi&act=update>
          <input type=hidden name=id value='$dtLocation[dtLocation]'>
		    <label>Ekspedisi</label>     
			<select name='courierID'>
						<option value=0 selected>- Pilih Ekspedisi-</option>";
						$query = "SELECT * FROM courier ORDER BY courierID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtLocation['courierID'] == $w['courierID']){
								echo "<option value=$w[courierID] SELECTED>$w[courierName]</option>";
							}
							else{
								echo "<option value=$w[courierID]>$w[courierName]</option>";
							}
						}  
					
			echo "</select>			  
		    <label>Provinsi</label>     
			<select name='provinceID'>
						<option value=0 selected>- Pilih Provinsi -</option>";
						$query = "SELECT * FROM provinces ORDER BY provinceID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtLocation['provinceID'] == $w['provinceID']){
								echo "<option value=$w[provinceID] SELECTED>$w[provinceName]</option>";
							}
							else{
								echo "<option value=$w[provinceID]>$w[provinceName]</option>";
							}
						}  
					
			echo "</select>		
		    <label>Kota</label>     
			<select name='cityID'>
						<option value=0 selected>- Pilih Kota-</option>";
						$query = "SELECT * FROM cities ORDER BY cityID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtLocation['cityID'] == $w['cityID']){
								echo "<option value=$w[cityID] SELECTED>$w[cityName]</option>";
							}
							else{
								echo "<option value=$w[cityID]>$w[cityName]</option>";
							}
						}  
					
			echo "</select>				
			<label>Lokasi Pengambilan</label>
			<input type='text' name='locationName' value='$dtLocation[locationName]' class='input-xlarge' />
			<label>Status</label>
			<select name='status' required>";
	?>
				<option value="Y" <?php if($dtLocation['status']=="Y"){echo "selected";} ?>>Aktif</option>
				<option value="N" <?php if($dtLocation['status']=="N"){echo "selected";} ?>>Tidak Aktif</option>
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
