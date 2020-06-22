<script type="text/javascript" src="js/ajaxupload.3.5.js"></script>
<link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css"/>
<style>
	li{
		list-style: none;
	}
</style>

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
					url: "getdata/get_sub_categories.php",
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
				action: 'upload/upload_image1.php',
				name: 'uploadfile1',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus1.text('Only JPG file are allowed');
						return false;
					}
					mestatus1.html('<img src="images/ajax-loader.gif" height="16" width="16">');
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
							$('<li></li>').appendTo('#files1').html('<img src="upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success1');
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
				action: 'upload/upload_image2.php',
				name: 'uploadfile2',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus2.text('Only JPG file are allowed');
						return false;
					}
					mestatus2.html('<img src="images/ajax-loader.gif" height="16" width="16">');
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
							$('<li></li>').appendTo('#files2').html('<img src="upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success2');
							$('<li></li>').appendTo('#product2').html('<input type="hidden" name="filename2" value="'+response+'">').addClass('nameupload2');
							
						} else{
							$('<li></li>').appendTo('#files2').text(file).addClass('error2');
						}
					}
				}
			});			
});
</script>

<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
</div>
<?php
session_start();
$dtProduct = mysql_fetch_array(mysql_query("SELECT * FROM products A WHERE A.productID = '$_GET[id]'"));
$desc = str_replace("\'", "'", $dtProduct['description']);

	echo"<div id='content' class='main-content bg-lights'><div class='container'>
			<div class='m-t-md'></div>
				<div class='row'>	
				<form method='POST' action='modul/action_edit_product.php'  onsubmit='return validasi_input(this)'>
					<input type='hidden' name='id' value='$dtProduct[productID]' />
					<input type='hidden' name='div' value='$_GET[div]' />
					<input type='hidden' name='page' value='$_GET[page]' />	
					<input type='hidden' name='oldfile1' value='$dtProduct[photo1]'>
					<input type='hidden' name='oldfile2' value='$dtProduct[photo2]'>					
					<div class='col-sm-8 link-info'>
						<div class='panel panel-default'>
							<div class='panel-heading font-bold'>Jual Barang</div>
								<div class='panel-body'>	
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Produk</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' value='$dtProduct[productName]' name='productName' required='true'>
											<span class='help-block'></span>
										</div>
									</div>
									
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Kategori</label>
										<div class='col-lg-10'>
										<select class='form-control text-sm' name='categoryID' id='categoryID'>
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
											<span class='help-block'></span>
										</div>
									</div>	
							
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Sub Kategori</label>
										<div class='col-lg-10'>
										<select class='form-control text-sm' name='subCategoryID' id='subCategoryID'>
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
											<span class='help-block'></span>
										</div>
									</div>";
									?>
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Kondisi</label>
										<div class='col-lg-10'>
											<div class='radio'>
												<label for='account_type_business'>
												<input type="radio" name="conditions" value="1" <?php if($dtProduct['conditions'] == 1){ echo "CHECKED"; } ?>> Baru
												</label>
											</div>
											<div class='radio'>
												<label for='account_type_personal'>
												<input type="radio" name="conditions" value="2" <?php if($dtProduct['conditions'] == 2){ echo "CHECKED"; } ?>> Bekas</label>
											</div>
										</div>
									</div>	
									<?php
								echo"<div class='form-group '>
										<label class='col-lg-2 control-label'>Harga</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' value='$dtProduct[salePrice]' name='salePrice'>
											<span class='help-block'></span>
										</div>
									</div>										
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Qty(Stok)</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' value='$dtProduct[qty]' name='qty'>
											<span class='help-block'></span>
										</div>
									</div>		
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Berat(Kg)</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' value='$dtProduct[weight]' name='weight'>
											<span class='help-block'></span>
										</div>
									</div>		
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Diskon</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' value='$dtProduct[discount]' name='discount'>
											<span class='help-block'></span>
										</div>
									</div>	
									<div class='form-group'>
										<label class='col-sm-2 control-label'>Keterangan</label>
										<div class='col-sm-10'>
											<textarea name='description' style='width: 450px; height: 150px;' class='ckeditor'>$dtProduct[description]</textarea>
										</div>
									</div>									
									<div class='form-group'>
										<label class='col-lg-2 control-label m-t-md '>Gambar</label>
											<tr valign='top'>
												<td style='padding-bottom: 5px; padding-top: 5px; padding-right: 5px;'>
													<table>
														<tr>
															<td width='280'>
																<table>
																	<tr>
																		<td height='90'>
																			<div id='me1' style='cursor:pointer; height: 70px; width: 75px;'>
																				<button class='button_profile'>
																					<img src='images/input.png' width='50'>
																				</button>
																				<div id='product1'>
																					<li class='nameupload1'></li>
																				</div>
																				<div id='files1'>
																					<li class='success1'></li>";
																					if($dtProduct['photo1'] != ''){
																						echo"<img src='upload/produk/thumb/small_$dtProduct[photo1]' width='70' height='70' style='border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc'><br>
																						<a href='upload/delete_image.php?app=produk&act=delimage&no=1&pid=$dtProduct[productID]&file=$dtProduct[photo1]' onClick='return confirm('Anda yakin ingin menghapus gambar 1?')'>Hapus</a>";												
																					}
																				echo"</div>
																			</div>
																			<span id='mestatus1'></span>
																		</td>
																		<td>
																			<div id='me2' style='cursor:pointer; height: 70px; width: 75px;'>
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
																				<div id='product2'>
																					<li class='nameupload2'></li>
																				</div>
																				<div id='files2'>
																					<li class='success2'></li>";
																					if($dtProduct['photo2'] != ''){
																							echo"<img src='upload/produk/thumb/small_$dtProduct[photo2]' width='70' height='70' style='border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc'><br>
																							<a href='upload/delete_image.php?app=produk&act=delimage&no=2&pid=$dtProduct[productID]&file=$dtProduct[photo2]' onClick='return confirm('Anda yakin ingin menghapus gambar 1?')'>Hapus</a>";												
																					}											
																				echo"</div>
																			</div>
																			<span id='mestatus2'></span>
																		</td>																				
																	</tr>
																</table>
															</td>
															<td align='left'>
																<div class='alert'>
																	&bull; Iklan dengan banyak foto, lebih direspon oleh pembeli.<br>
																	&bull; Iklan dengan foto mampu meningkatkan respon hingga 3x lipat.
																</div>
															</td>
														</tr>
													</table>						
												</td>
											</tr>
									</div>	
									<div class='form-group'>
										<div class='col-sm-4 col-sm-offset-2 m-t-md'>
											<input type='hidden' name='upload' value='yes'/>
											<button type='submit' id='submit-btn' class='btn btn-black'><i class='ion-checkmark-circled'></i> Simpan</button>
											<a href='javascript:history.go(-1)'><button type='button' class='btn btn-black'><i class='ion-arrow-left-a'></i> Kembali</button></a>											
										</div>
									</div>											
								</div>
							</div>
						</div>
					</div>
				</form>
				</div>
		</div>";

?>