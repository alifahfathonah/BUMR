<script type="text/javascript" src="../js/ajaxupload.3.5.js"></script>
<link rel="stylesheet" type="text/css" href="../css/Ajaxfile-upload.css">
<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
<style>
	li{
		list-style: none;
	}
</style>
<?php
if ($_GET['act'] == 'tambahproduk' || $_GET['act'] == 'editproduk' ){
?>
<script>
		function validasi_input(form){
			var salePriceManagement = $("#salePriceManagement").val();
			var buyPrice = parseInt(form.buyPrice.value);
			var salePrice = parseInt(form.salePrice.value);
			var discountPrice = parseInt(form.discountPrice.value);
			
			if (salePriceManagement == '1'){
				if (salePrice <= buyPrice){
					alert("Harga normal (jual) tidak boleh lebih murah dari Harga beli");
					form.salePrice.focus();
					return (false);
				}
				else if (salePrice <= discountPrice){
					alert("Harga normal (jual) tidak boleh lebih murah dari Harga diskon");
					form.salePrice.focus();
					return (false);
				}
				else if (discountPrice <= buyPrice){
					alert("Harga diskon tidak boleh lebih murah dari Harga beli");
					form.discountPrice.focus();
					return (false);
				}
				
				
				return (true);
			}
		}
$(document).ready(function(){
			$("#categoryID").change(function(){
				var category = $("#categoryID").val();
				$.ajax({
					url: "../getdata/get_sub_categories.php",
					data: "category="+category,
					cache: false,
					success: function(msg){
						$("#subCategoryID").html(msg);
					}
				});
			});
			var btnUpload1=$('#me1');
			var mestatus1=$('#mestatus1');
			var files1=$('#files1');
			new AjaxUpload(btnUpload1, {
				action: '../upload/upload_image1.php',
				name: 'uploadfile1',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus1.text('Only JPG file are allowed');
						return false;
					}
					mestatus1.html('<img src="../images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus1.text('');
					//On completion clear the status
					files1.html('');
					//Add uploaded file to list
					if(response == 'bigger'){
						alert('The file size should not exceed 500kb');
						return false;
					}
					else
					{
						if(response!=="error"){
							$('<li></li>').appendTo('#files1').html('<img src="../upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success1');
							$('<li></li>').appendTo('#product1').html('<input type="hidden" name="filename1" value="'+response+'">').addClass('nameupload1');
							
						} else{
							$('<li></li>').appendTo('#files1').text(file).addClass('error1');
						}
					}
				}
			});
			
			var btnUpload2=$('#me2');
			var mestatus2=$('#mestatus2');
			var files2=$('#files2');
			new AjaxUpload(btnUpload2, {
				action: '../upload/upload_image2.php',
				name: 'uploadfile2',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus2.text('Only JPG file are allowed');
						return false;
					}
					mestatus2.html('<img src="../images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus2.text('');
					//On completion clear the status
					files2.html('');
					//Add uploaded file to list
					if(response == 'bigger'){
						alert('The file size should not exceed 500kb');
						return false;
					}
					else
					{
						if(response!=="error"){
							$('<li></li>').appendTo('#files2').html('<img src="../upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success2');
							$('<li></li>').appendTo('#product2').html('<input type="hidden" name="filename2" value="'+response+'">').addClass('nameupload2');
							
						} else{
							$('<li></li>').appendTo('#files2').text(file).addClass('error2');
						}
					}
				}
			});			
});
		
</script>
<?php
}
?>	
<?php
$aksi="modul/produk/aksi_produk.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=produk&act=tambahproduk' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Nama Produk </th>
				<th>Kategori</th>
				<th>Sub Kategori</th>
				<th>Qty</th>
				<th>Harga Beli</th>
				<th>Harga Jual</th>
				<th>Diskon</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);	  		  
    $queryProduct = "SELECT * FROM products A LEFT JOIN 	
				sub_categories B ON A.subCategoryID=B.subCategoryID LEFT JOIN
				categories C ON A.categoryID=C.categoryID LEFT JOIN
				suppliers D ON A.supplierID=D.supplierID
				ORDER BY A.productID DESC LIMIT $posisi,$batas";
	$sqlProduct=mysql_query($queryProduct);
    $no=$posisi+1;
    while ($dtProduct=mysql_fetch_array($sqlProduct)){	
	$jual = format_rupiah($dtProduct['salePrice']);
	$beli = format_rupiah($dtProduct['buyPrice']);	
	if($dtProduct['status'] == 'Y'){
		$status = "Aktif";
	}
	else{
		$status = "Tidak Aktif";
	}
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
			 <td><?php echo $dtProduct['productCode']; ?>-<?php echo $dtProduct['productName']; ?></td> 		
			 <td><?php echo $dtProduct['categoryName']; ?></td>	
			 <td><?php echo $dtProduct['subCategoryName']; ?></td>	
			 <td><?php echo $dtProduct['qty']; ?></td>
			 <td><?php echo $jual; ?></td>
			 <td><?php echo $beli; ?></td>
			 <td><?php echo $dtProduct['discount']; ?></td>
			 <td><?php echo $status; ?></td>
			 <td><a href='?app=produk&act=editproduk&id=<?php echo $dtProduct['productID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=produk&act=hapus&id=<?php echo $dtProduct['productID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $dtProduct['productName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	$query = "SELECT * FROM products";
	$sql = mysql_query($query);
	$jmldata = mysql_num_rows($sql);
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);	
    echo "<div id=paging>Halaman : $linkHalaman</div><br>";		
    break;
  
  case "tambahproduk":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=produk&act=input' onsubmit='return validasi_input(this)'>			
			<label>Nama Produk</label>
			<input type='text' name='productName' class='input-xlarge' />
		    <label>Kategori</label>     
			<select name='categoryID' id='categoryID'>
						<option value=0 selected>- Pilih Kategori -</option>";
						$query = "SELECT * FROM categories ORDER BY categoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[categoryID]>$w[categoryName]</option>";
						}                                
			echo "</select>		
			<label>Sub Kategori</label>
			<select id='subCategoryID' name='subCategoryID' required>
				<option value=''></option>
			</select>
		    <label>Supplier</label>     
			<select name='supplierID'>
						<option value=0 selected>- Pilih Supplier -</option>";
						$query = "SELECT * FROM suppliers ORDER BY supplierID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
						echo "<option value=$w[supplierID]>$w[supplierName]</option>";
						}                                
			echo "</select>			
			<label>Kondisi Barang</label>
				<select name='condition' class='input-medium' required>
					<option value='Baru' SELECTED>Baru</option>
					<option value='Bekas'>Bekas</option>
				</select>					
			<label>Berat (Kg)</label>
			<input type='text' name='weight' class='input-mini' />			
			<label>Qty(Stok)</label>
			<input type='text' name='qty' class='input-mini' />		
			<label>Diskon</label>
			<input type='text' name='discount' class='input-mini' />			
			<label>Harga Beli</label>
			<input type='text' name='buyPrice' class='input-xlarge' />	
			<label>Harga Jual</label>
			<input type='text' name='salePrice' class='input-xlarge' />		
			<label>Gambar</label>
						<table>
							<tr>
								<p>File size should not exceed uploaded 500 KB and only JPG/JPEG allowed.</p>
							</tr>
							<tr>
								<td>
									<div id='me1' style='cursor:pointer; height: 70px; width: 75px;'>
										<button class='button_profile'><img src='../images/input.png' width='50'></button>
											
										<div id='product1'>
											<li class='nameupload1'></li>
										</div>
										<div id='files1'>
											<li class='success1'></li>
								        </div>
									</div>
									<span id='mestatus1'></span>
								</td>
								<td>
									<div id='me2' style='cursor:pointer; height: 70px; width: 75px;'>
										<button class='button_profile'><img src='../images/input.png' width='50'></button>
											
										<div id='product2'>
											<li class='nameupload2'></li>
										</div>
										<div id='files2'>
											<li class='success2'></li>
								        </div>
									</div>
									<span id='mestatus2'></span>
								</td>

							</tr>
						</table>			
				<label>Keterangan</label>
				<textarea  name='description' class='ckeditor'></textarea>
				<label>Status</label>
				<select name='status' class='input-medium' required>
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

  case "editproduk":
    $queryProduct = "SELECT * FROM products WHERE productID='$_GET[id]'";
	$sqlProduct = mysql_query($queryProduct);
    $dtProduct = mysql_fetch_array($sqlProduct);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=produk&act=update >
          <input type=hidden name='id' value='$dtProduct[productID]'>
		  <input type='hidden' name='oldfile1' value='$dtProduct[photo1]'>
		  <input type='hidden' name='oldfile2' value='$dtProduct[photo2]'>
			<label>Kode Produk</label>
			<input type='text' name='productCode' value='$dtProduct[productCode]' DISABLED class='input-xlarge' />		  
			<label>Nama Produk</label>
			<input type='text' name='productName' value='$dtProduct[productName]' class='input-xlarge' />				
		    <label>Kategori</label>     
			<select name='categoryID' id='categoryID'>
						<option value=0 selected>- Pilih Kategori -</option>";
						$query = "SELECT * FROM categories ORDER BY categoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtProduct['categoryID'] == $w['categoryID']){
								echo "<option value=$w[categoryID] SELECTED>$w[categoryName]</option>";
							}
							else{
								echo "<option value=$w[categoryID]>$w[categoryName]</option>";
							}
						}  
					
			echo "</select>	
		    <label>Sub Kategori</label>     
			<select name='subCategoryID' id='subCategoryID'>
						<option value=0 selected>- Pilih Sub Kategori -</option>";
						$query = "SELECT * FROM sub_categories ORDER BY categoryID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtProduct['subCategoryID'] == $w['subCategoryID']){
								echo "<option value=$w[subCategoryID] SELECTED>$w[subCategoryName]</option>";
							}
							else{
								echo "<option value=$w[subCategoryID]>$w[subCategoryName]</option>";
							}
						}  
					
			echo "</select>		
		    <label>Supplier</label>     
			<select name='supplierID' >
						<option value=0 selected>- Pilih Supplier -</option>";
						$query = "SELECT * FROM suppliers ORDER BY supplierID";
						$sql  =mysql_query($query);
						while($w=mysql_fetch_array($sql)){
							if($dtProduct['supplierID'] == $w['supplierID']){
								echo "<option value=$w[supplierID] SELECTED>$w[supplierName]</option>";
							}
							else{
								echo "<option value=$w[supplierID]>$w[supplierName]</option>";
							}
						}  
					
			echo "</select>				
			<label>Berat (Kg)</label>
			<input type='text' name='weight' value='$dtProduct[weight]' class='input-mini' />
			<label>Qty (Stok)</label>
			<input type='text' name='qty' value='$dtProduct[qty]' class='input-mini' />	
			<label>Diskon</label>
			<input type='text' name='discount' value='$dtProduct[discount]' class='input-mini' />				
			<label>Harga Beli</label>
			<input type='text' name='buyPrice' value='$dtProduct[buyPrice]' class='input-xlarge' />	
			<label>Harga Jual</label>
			<input type='text' name='salePrice' value='$dtProduct[salePrice]' class='input-xlarge' />
			<label>Status</label>
			<select name='status' class='input-medium' required>";
	?>
				<option value="Y" <?php if($dtProduct['status']=="Y"){echo "selected";} ?>>Aktif</option>
				<option value="N" <?php if($dtProduct['status']=="N"){echo "selected";} ?>>Tidak Aktif</option>
	<?php
			echo"</select>	
			<label>Gambar</label>
						<table>
							<tr>
								<p>Ukuran format image yang digunkan adalah JPG/JPEG.</p>
							</tr>
							<tr>
								<td>
									<div id='me1' style='cursor:pointer; height: 70px; width: 75px;'>
										<button class='button_profile'><img src='../images/input.png' width='50'></button>
											
										<div id='product1'>
											<li class='nameupload1'></li>
										</div>
										<div id='files1'>
											<li class='success1'></li>";
											if($dtProduct['photo1'] != ''){
													echo"<img src='../upload/produk/thumb/small_$dtProduct[photo1]' width='70' height='70' style='border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc'><br>
													<a href='../upload/delete_image.php?app=produk&act=delimage&no=1&pid=$dtProduct[produkID]&file=$dtProduct[photo1]' onClick='return confirm('Anda yakin ingin menghapus gambar 1?')'>Hapus</a>";												
											}
											
								        echo"</div>
									</div>
									<span id='mestatus1'></span>
								</td>
								<td>
									<div id='me2' style='cursor:pointer; height: 70px; width: 75px;'>
										<button class='button_profile'><img src='../images/input.png' width='50'></button>
											
										<div id='product2'>
											<li class='nameupload2'></li>
										</div>
										<div id='files2'>
											<li class='success2'></li>";
											if($dtProduct['photo2'] != ''){
													echo"<img src='../upload/produk/thumb/small_$dtProduct[photo2]' width='70' height='70' style='border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc'><br>
													<a href='../upload/delete_image.php?app=produk&act=delimage&no=1&pid=$dtProduct[produkID]&file=$dtProduct[photo2]' onClick='return confirm('Anda yakin ingin menghapus gambar 1?')'>Hapus</a>";												
											}											
								        echo"</div>
									</div>
									<span id='mestatus2'></span>
								</td>

							</tr>
						</table><br/><br/>	
			<label>Keterangan</label>
			<textarea class='ckeditor' name='description'>$dtProduct[description]</textarea>
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
