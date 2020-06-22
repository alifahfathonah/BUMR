<?php
$aksi="modul/ongkir/aksi_ongkir.php";
switch($_GET[act]){

  default:
  
    echo "
		  <div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Provinsi</th>
				<th>Kota </th>
				<th>Ekspedisi</th>
				<th>Aksi</th><tbody>
		  </tr>"; 
    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);
			 
	$queryCost = "SELECT B.cityID, B.cityName, A.provinceName, A.provinceID
					FROM provinces A INNER JOIN 
						 cities B ON A.provinceID = B.provinceID
						 WHERE A.status = 'Y' AND B.status = 'Y' 
					ORDER BY A.provinceName, B.cityName DESC LIMIT $posisi,$batas";
	$sqlCost = mysql_query($queryCost);
	$numsCost = mysql_num_rows($sqlCost);
    $no = $posisi+1;
	while ($dtCost = mysql_fetch_array($sqlCost))
	{
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
			 <td><?php echo $dtCost['provinceName']; ?></td>
             <td><?php echo $dtCost['cityName']; ?></td>	
			 <td>
			<?php
			$queryShippingCost = "SELECT B.courierName 
								 FROM shipping A INNER JOIN 
								 courier B ON A.courierID = B.courierID 
								 WHERE A.provinceID = '$dtCost[provinceID]' AND A.cityID = '$dtCost[cityID]'";
			$sqlShippingCost = mysql_query($queryShippingCost);
			while ($dtShippingCost = mysql_fetch_array($sqlShippingCost))
			{			
			?>
			<?php echo $dtShippingCost['courierName']; ?>,
			 
			<?php } ?>
			 <td>
				<a href='?app=ongkir&act=viewongkir&provinceID=<?php echo $dtCost['provinceID']; ?>&cityID=<?php echo $dtCost['cityID'];?>'>
				<i class='ion-ios-search'></i> Detail</a>
             </td>
		</tr>
	<?php
		$no++;
	}

    echo "</tbody></table></div>";

	
	$query = "SELECT A.provinceID FROM provinces A 
					INNER JOIN cities B ON A.provinceID = B.provinceID WHERE A.status = 'Y' AND B.status = 'Y'";
	$sql = mysql_query($query);
	$jmldata = mysql_num_rows($sql);
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);	
    echo "<div id=paging>Halaman : $linkHalaman</div><br>";	
	
    break;
  
  case "viewongkir":
	$provinceID = mysql_real_escape_string($_GET['provinceID']);
	$cityID = mysql_real_escape_string($_GET['cityID']);
	$queryLocation = "SELECT A.provinceName, A.provinceID, B.cityID, B.cityName 
						FROM provinces A INNER JOIN 
							 cities B ON A.provinceID = B.provinceID 
							 WHERE A.provinceID = '$provinceID' AND B.cityID = '$cityID'";
	$sqlLocation = mysql_query($queryLocation);
	$dataLocation = mysql_fetch_array($sqlLocation);
			echo"<div class='well'><table cellpadding='5' cellspacing='5'>
					<tr>
						<td width='100'>Origin</td>
						<td width='10'>:</td>
						<td>Yogyakarta</td>
					</tr>
					<tr>
						<td colspan='3'><b>Tujuan Pengiriman</b></td>
					</tr>
					<tr>
						<td>Propinsi</td>
						<td>:</td>
						<td>$dataLocation[provinceName]</td>
					</tr>
					<tr>
						<td>Kota</td>
						<td>:</td>
						<td>$dataLocation[cityName]</td>
					</tr>
				</table></div>";
			echo"<div class='btn-toolbar'>	
					<a href='?app=ongkir&act=addongkir&provinceID=$provinceID&cityID=$cityID' data-toggle='modal' class='btn btn-primary'>
					<i class='ion-plus-round'></i> Tambah Biaya Kirim</a>
					<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali	
				</div>";
			echo"<table class='table table-bordered table-striped'>
				<thead>
					<tr>
						<th>No</th>
						<th>Ekspedisi </th>
						<th>Layanan</th>
						<th>Biaya Kirim </th>
						<th>Estimasi </th>
						<th>Aksi</th>
					</tr>
				</thead>";
				$queryCost = "SELECT A.shippingID, A.estimateDay, A.provinceID, A.cityID, B.courierName,B.courierDesc
							FROM shipping A INNER JOIN 
								courier B ON A.courierID = B.courierID 
							WHERE A.provinceID = '$provinceID' AND A.cityID = '$cityID' ORDER BY B.courierName ASC";
				$sqlCost = mysql_query($queryCost);
				$no=1;
				while ($dtCost = mysql_fetch_array($sqlCost))					
				{		
					echo"<tr><td>$no</td>
							<td>$dtCost[courierName]</td>
							<td>$dtCost[courierDesc]</td>
							<td>";
							$queryWeightCost = "SELECT * FROM shipping_weight 
												WHERE shippingID = '$dtCost[shippingID]' ORDER BY weightFrom ASC";
							$sqlWeightCost = mysql_query($queryWeightCost);
							while($dtWeightCost = mysql_fetch_array($sqlWeightCost)){
							if ($dtWeightCost['shippingStatus'] == 'K')
							{
								$status = "Per Kg";
							}
							else
							{
								$status = "Borongan / Global";
							}								
							echo"
								&bull; $dtWeightCost[weightFrom] - $dtWeightCost[weightTo] Kg : 
								Rp. $dtWeightCost[shippingCost] ($status)<br>							
								";
							}
						echo"</td>";
						echo"<td>$dtCost[estimateDay]</td>
							<td>
								<a href='?app=ongkir&act=updateongkir&shippingID=$dtCost[shippingID]&provinceID=$dtCost[provinceID]&cityID=$dtCost[cityID]' title='Edit'><i class='ion-android-create'></i> Update</a>
								<a href='?app=ongkir&act=delete&shippingID=$dtCost[shippingID]&provinceID=$dtCost[provinceID]&cityID=$dtCost[cityID]' title='Delete' onClick='return confirm('Anda yakin ingin menghapus biaya kirim ini?')'>
								</a>
							</td>
						</tr>";
				}
				echo"</table>";
				
				
  break;
	
	case "addongkir":
	$provinceID = mysql_real_escape_string($_GET['provinceID']);
	$cityID = mysql_real_escape_string($_GET['cityID']);
	$queryLocation = "SELECT A.provinceName, A.provinceID, B.cityID, B.cityName 
					FROM provinces A INNER JOIN 
						 cities B ON A.provinceID = B.provinceID 
					WHERE A.provinceID = '$provinceID' AND B.cityID = '$cityID'";
	$sqlLocation = mysql_query($queryLocation);
	$dataLocation = mysql_fetch_array($sqlLocation);		
	echo"<div class='well'><table cellpadding='5' cellspacing='5'>
			<tr>
				<td width='100'>Origin</td>
				<td width='10'>:</td>
				<td>Yogyakarta</td>
			</tr>
			<tr><td colspan='3'><b>Tujuan Pengiriman</b></td></tr>
			<tr><td>Propinsi</td><td>:</td>
				<td>$dataLocation[provinceName]</td>
			</tr>
			<tr><td>Kota</td><td>:</td><td>$dataLocation[cityName]</td>
			</tr>
		</table></div>";	
	echo"<div class='well'>
			<form method='POST' action='$aksi?app=ongkir&act=add'>
			<input type='hidden' name='provinceID' value='$provinceID'>
			<input type='hidden' name='cityID' value='$cityID'>		
			<table cellpadding='5' cellspacing='5'>
				<tr>
					<td width='120'>Ekspedisi</td>
					<td width='10'>:</td>
					<td>
						<select name='courierID'>
									<option value=0 selected>- Pilih Ekspedisi -</option>";
									$query = "SELECT * FROM courier ORDER BY courierID";
									$sql  =mysql_query($query);
									while($w=mysql_fetch_array($sql)){
									echo "<option value=$w[courierID]>$w[courierName]</option>";
									}                                
					echo "</select>						
					</td>
				</tr>
				<tr valign='top'>
					<td>Estimasi (Hari)</td>
					<td>:</td>
					<td><input type='text' class='input-xlarge' name='estimateDay' placeholder='Estimasi Pengiriman' style='width: 300px;' required></td>
				</tr>				
				<tr valign='top'>
					<td>Biaya Kirim</td>
					<td>:</td>
					<td><input type='text' class='form-control' name='weightCostStart[]' placeholder='Kg' style='width: 50px; float: left; margin: 5px;' required>
						<input type='text' class='form-control' name='weightCostEnd[]' placeholder='kg' style='width: 50px; float: left; margin: 5px;' required>
						<input type='text' class='form-control' name='shippingCost[]' placeholder='Biaya Kirim' style='width: 300px; float: left; margin: 5px;' required>
						<select class='form-control' name='shippingStatus[]' style='width: 100px; float: left; margin: 5px;' required>
							<option value='K'>Per Kg</option>
							<option value='B'>Borongan / Global</option>
						</select><br>


					</td>
				</tr>
				<tr>
					<td colspan='3'>
						<button type='submit' class='btn btn-primary'>SIMPAN</button>
						<button type='reset' class='btn btn-primary'>RESET</button>
						<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>	
					</td>
				</tr>
			</table>	
			</form></div>";		
		
	break;
	
	case"updateongkir":
	$shippingID = mysql_real_escape_string($_GET['shippingID']);
	$provinceID = mysql_real_escape_string($_GET['provinceID']);
	$cityID = mysql_real_escape_string($_GET['cityID']);
	$queryLocation ="SELECT * FROM shipping A INNER JOIN 
								cities B ON A.cityID = B.cityID INNER JOIN
								provinces C ON A.provinceID=C.provinceID
					WHERE C.provinceID = '$provinceID' AND B.cityID = '$cityID' AND A.shippingID='$shippingID'
					ORDER BY A.shippingID";
	$sqlLocation = mysql_query($queryLocation);
	$dataLocation = mysql_fetch_array($sqlLocation);	
	echo"<div class='well'>
			<table cellpadding='5' cellspacing='5'>
				<tr>
					<td width='100'>Origin</td>
					<td width='10'>:</td>
					<td>Yogyakarta</td>
				</tr>
				<tr>
					<td colspan='3'><b>Tujuan Pengiriman</b></td>
				</tr>
				<tr>
					<td>Propinsi</td>
					<td>:</td>
					<td>$dataLocation[provinceName]</td>
				</tr>
				<tr>
					<td>Kota</td>
					<td>:</td>
					<td>$dataLocation[cityName]</td>
				</tr>
			</table></div>";
			echo"<div class='btn-toolbar'>	
					<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali	
				</div>";			
		echo"<div class='well'><form method='POST' action='$aksi?app=ongkir&act=edit'>
			<input type='hidden' name='shippingID' value='$shippingID'>
			<input type='hidden' name='provinceID' value='$provinceID'>
			<input type='hidden' name='cityID' value='$cityID'>
			<table cellpadding='5' cellspacing='5'>
				<tr>
					<td width='120'>Ekspedisi</td>
					<td width='10'>:</td>
					<td>
						<select name='courierID'>
									<option value=0 selected>- Pilih Ekspedisi-</option>";
									$query = "SELECT * FROM courier ORDER BY courierID";
									$sql  =mysql_query($query);
									while($w=mysql_fetch_array($sql)){
										if($dataLocation['courierID'] == $w['courierID']){
											echo "<option value=$w[courierID] SELECTED>$w[courierName]</option>";
										}
										else{
											echo "<option value=$w[courierID]>$w[courierName]</option>";
										}
									}  
								
						echo "</select>	
					</td>
				</tr>
				<tr valign='top'>
					<td>Estimasi (Hari)</td>
					<td>:</td>
					<td><input type='text' class='form-control' name='estimateDay' value='$dataLocation[estimateDay]'  style='width: 300px;' required></td>
				</tr>		
				<tr valign='top'>
					<td>Biaya Kirim</td>
					<td>:</td>
					<td>";
					$queryWeightCost = "SELECT * FROM shipping_weight 
										WHERE shippingID = '$dataLocation[shippingID]' 
										ORDER BY weightFrom ASC";
					$sqlWeightCost = mysql_query($queryWeightCost);	
					while ($dtWeightCost = mysql_fetch_array($sqlWeightCost)){				
						echo"<input type='hidden' class='form-control' name='weightCostID[]' value='$dtWeightCost[shippingWeightID]' placeholder='Kg' style='width: 4; float: left; margin: 5px;'>
							<input type='text' class'form-control' name='weightCostStart[]' value='$dtWeightCost[weightFrom]' placeholder='Kg' style='width: 40px; float: left; margin: 5px;'>
							<input type='text' class='form-control' name='weightCostEnd[]' value='$dtWeightCost[weightTo]' placeholder='kg' style='width: 40px; float: left; margin: 5px;'>
							<input type='text' class='form-control' name='shippingCost[]' value='$dtWeightCost[shippingCost]' placeholder='Biaya Kirim' style='width: 80px; float: left; margin: 5px;'>
							<select class='form-control' name='shippingStatus[]' style='width: 100px; float: left; margin: 5px;'>";
							?>
								<option value='K' <?php if ($dtWeightCost['shippingStatus'] == 'K'){echo"SELECTED";}?>>Per Kg</option>
								<option value='B' <?php if ($dtWeightCost['shippingStatus'] == 'B'){echo"SELECTED";}?>>Borongan / Global</option>
							<?php
							echo"</select>
							<br>";
					}


						
					echo"</td>
				</tr>
				<tr>
					<td colspan='3'>
						<button type='submit' class='btn btn-primary'>UPDATE</button>
						<button type='reset' class='btn btn-primary'>RESET</button>
					</td>
				</tr>				
			</table>	
			</form>
			</div>";
	break;
  
  
  
	case "tambahongkir":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=ongkir&act=input'>
		    <label>Ekspedisi</label>     
			<select name='courierID'>
						<option value=0 selected>- Pilih Ekspedisi -</option>";
						$query = "SELECT * FROM courier ORDER BY courierID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[courierID]>$w[courierName]</option>";
						}                                
			echo "</select>				
		    <label>Kota Awal</label>     
			<select name='cityID'>
						<option value=0 selected>- Pilih Kota -</option>";
						$query = "SELECT * FROM cities ORDER BY cityID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[cityID]>$w[cityName]</option>";
						}                                
			echo "</select>	
			<label>Kota Tujuan</label>
			<input type='text' name='shippingGo' class='input-xlarge' />	
			<label>Estimasi Hari</label>
			<input type='text' name='estimateDay' class='input-xlarge' />	
			<label>Biaya </label>
			<input type='text' name='shippingCost' class='input-xlarge' />	
			<select name='shippingType' class='input-medium' required>
				<option value='Per Kg' SELECTED>Per Kg</option>
				<option value='Borongan'>Borongan</option>
			</select>					
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editongkir":
    $queryShipping = "SELECT * FROM shipping WHERE shippingID='$_GET[id]'";
	$sqlShipping = mysql_query($queryShipping);
    $dtShipping = mysql_fetch_array($sqlShipping);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=ongkir&act=update>
          <input type=hidden name=id value='$dtShipping[shippingID]'>
		    <label>Ekspedisi</label>     
			<select name='courierID'>
						<option value=0 selected>- Pilih Ekspedisi -</option>";
						$query = "SELECT * FROM courier ORDER BY courierID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtShipping['courierID'] == $w['courierID']){
								echo "<option value=$w[courierID] SELECTED>$w[courierName]</option>";
							}
							else{
								echo "<option value=$w[courierID]>$w[courierName]</option>";
							}
						}  
					
			echo "</select>			  
		    <label>Kota Awal</label>     
			<select name='cityID'>
						<option value=0 selected>- Pilih Kota -</option>";
						$query = "SELECT * FROM cities ORDER BY cityID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtShipping['cityID'] == $w['cityID']){
								echo "<option value=$w[cityID] SELECTED>$w[cityName]</option>";
							}
							else{
								echo "<option value=$w[cityID]>$w[cityName]</option>";
							}
						}  
					
			echo "</select>	
			<label>Kota Tujuan</label>
			<input type='text' name='shippingGo' value='$dtShipping[shippingGo]' class='input-xlarge' />	
			<label>Estimasi Hari</label>
			<input type='text' name='estimateDay' value='$dtShipping[estimateDay]' class='input-xlarge' />	
			<label>Biaya</label>
			<input type='text' name='shippingCost' value='$dtShipping[shippingCost]' class='input-xlarge' />			
			<select name='shippingType' class='input-medium' required>";
	?>
				<option value="Per Kg" <?php if($dtShipping['shippingType']=="Per Kg"){echo "selected";} ?>>Per Kg</option>
				<option value="Borongan" <?php if($dtShipping['shippingType']=="Borongan"){echo "selected";} ?>>Borongan</option>
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
