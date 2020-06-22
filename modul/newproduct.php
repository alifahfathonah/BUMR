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

			var btnUpload3=$('#me3');
			var mestatus3=$('#mestatus3');
			var files3=$('#files3');
			new AjaxUpload(btnUpload3, {
				action: 'upload/upload_image3.php',
				name: 'uploadfile3',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus3.text('Only JPG file are allowed');
						return false;
					}
					mestatus3.html('<img src="images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus3.text('');
					//On completion clear the status
					files3.html('');
					//Add uploaded file to list
					if(response == 'bigger'){
						alert('The file size should not exceed 500kb');
						return false;
					}
					else
					{
						if(response!=="error"){
							$('<li></li>').appendTo('#files3').html('<img src="upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success3');
							$('<li></li>').appendTo('#product3').html('<input type="hidden" name="filename3" value="'+response+'">').addClass('nameupload3');
							
						} else{
							$('<li></li>').appendTo('#files3').text(file).addClass('error3');
						}
					}
				}
			});

			var btnUpload4=$('#me4');
			var mestatus4=$('#mestatus4');
			var files4=$('#files4');
			new AjaxUpload(btnUpload4, {
				action: 'upload/upload_image4.php',
				name: 'uploadfile4',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus4.text('Only JPG file are allowed');
						return false;
					}
					mestatus4.html('<img src="images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus4.text('');
					//On completion clear the status
					files4.html('');
					//Add uploaded file to list
					if(response == 'bigger'){
						alert('The file size should not exceed 500kb');
						return false;
					}
					else
					{
						if(response!=="error"){
							$('<li></li>').appendTo('#files4').html('<img src="upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success4');
							$('<li></li>').appendTo('#product4').html('<input type="hidden" name="filename4" value="'+response+'">').addClass('nameupload4');
							
						} else{
							$('<li></li>').appendTo('#files4').text(file).addClass('error4');
						}
					}
				}
			});

			var btnUpload5=$('#me5');
			var mestatus5=$('#mestatus5');
			var files5=$('#files5');
			new AjaxUpload(btnUpload5, {
				action: 'upload/upload_image5.php',
				name: 'uploadfile5',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus5.text('Only JPG file are allowed');
						return false;
					}
					mestatus5.html('<img src="images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus5.text('');
					//On completion clear the status
					files5.html('');
					//Add uploaded file to list
					if(response == 'bigger'){
						alert('The file size should not exceed 500kb');
						return false;
					}
					else
					{
						if(response!=="error"){
							$('<li></li>').appendTo('#files5').html('<img src="upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success5');
							$('<li></li>').appendTo('#product5').html('<input type="hidden" name="filename5" value="'+response+'">').addClass('nameupload5');
							
						} else{
							$('<li></li>').appendTo('#files5').text(file).addClass('error5');
						}
					}
				}
			});

			var btnUpload6=$('#me6');
			var mestatus6=$('#mestatus6');
			var files6=$('#files6');
			new AjaxUpload(btnUpload6, {
				action: 'upload/upload_image6.php',
				name: 'uploadfile6',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
		                // extension is not allowed 
						mestatus6.text('Only JPG file are allowed');
						return false;
					}
					mestatus6.html('<img src="images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus6.text('');
					//On completion clear the status
					files6.html('');
					//Add uploaded file to list
					if(response == 'bigger'){
						alert('The file size should not exceed 500kb');
						return false;
					}
					else
					{
						if(response!=="error"){
							$('<li></li>').appendTo('#files6').html('<img src="upload/produk/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success6');
							$('<li></li>').appendTo('#product6').html('<input type="hidden" name="filename6" value="'+response+'">').addClass('nameupload6');
							
						} else{
							$('<li></li>').appendTo('#files6').text(file).addClass('error6');
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
$aksi="modul/action_product.php";
switch($_GET[act]){
	default:
	echo"<div id='content' class='main-content bg-lights'><div class='container'>
			<div class='m-t-md'></div>
				<div class='row'>	
				<form method='POST' action='$aksi?module=produk&act=input' onsubmit='return validasi_input(this)'>
					<div class='col-sm-8 link-info'>
						<div class='panel panel-default'>
							<div class='panel-heading font-bold'>Jual Barang</div>
								<div class='panel-body'>	
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Produk</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' name='productName' required='true'>
											<span class='help-block'></span>
										</div>
									</div>
									
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Kategori</label>
										<div class='col-lg-10'>
										<select class='form-control text-sm' name='categoryID' id='categoryID'>
												<option value=0 selected>- Pilih Kategori -</option>";
											    $tampil=mysql_query("SELECT * FROM categories ORDER BY categoryName");
												while($r=mysql_fetch_array($tampil)){
													echo "<option value=$r[categoryID]>$r[categoryName]</option>";
												}                              
										echo "</select>	
											<span class='help-block'></span>
										</div>
									</div>	
							
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Sub Kategori</label>
										<div class='col-lg-10'>
										<select class='form-control text-sm' id='subCategoryID' name='subCategoryID' required>
											<option value=''></option>
										</select>
											<span class='help-block'></span>
										</div>
									</div>	
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Kondisi</label>
										<div class='col-lg-10'>
											<div class='radio'>
												<label for='account_type_business'>
												<input id='account_type' name='condition' value='1' type='radio'>Baru</label>
											</div>
											<div class='radio'>
												<label for='account_type_personal'>
												<input id='account_type' name='condition' value='2' type='radio' >Bekas</label>
											</div>
										</div>
									</div>									
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Harga</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' name='salePrice' value=''>
											<span class='help-block'></span>
										</div>
									</div>										
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Qty(Stok)</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' name='qty' value=''>
											<span class='help-block'></span>
										</div>
									</div>		
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Berat(Kg)</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' name='weight' value=''>
											<span class='help-block'></span>
										</div>
									</div>		
									<div class='form-group '>
										<label class='col-lg-2 control-label'>Diskon</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' required='true' name='discount' value=''>
											<span class='help-block'></span>
										</div>
									</div>	
									<div class='form-group'>
										<label class='col-sm-2 control-label'>Keterangan</label>
										<div class='col-sm-10'>
											<textarea name='description' style='width: 450px; height: 150px;' class='ckeditor'></textarea>
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
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
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
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
																				<div id='product2'>
																					<li class='nameupload2'></li>
																				</div>
																				<div id='files2'>
																					<li class='success2'></li>
																				</div>
																			</div>
																			<span id='mestatus2'></span>
																		</td>	
																		<td>
																			<div id='me3' style='cursor:pointer; height: 70px; width: 75px;'>
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
																				<div id='product3'>
																					<li class='nameupload3'></li>
																				</div>
																				<div id='files3'>
																					<li class='success3'></li>
																				</div>
																			</div>
																			<span id='mestatus3'></span>
																		</td>																		
																	</tr>
																	<tr>
																		<td>
																			<div id='me4' style='cursor:pointer; height: 70px; width: 75px;'>
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
																				<div id='product4'>
																					<li class='nameupload4'></li>
																				</div>
																				<div id='files4'>
																					<li class='success4'></li>
																				</div>
																			</div>
																			<span id='mestatus4'></span>
																		</td>
																		<td>
																			<div id='me5' style='cursor:pointer; height: 70px; width: 75px;'>
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
																				<div id='product5'>
																					<li class='nameupload5'></li>
																				</div>
																				<div id='files5'>
																					<li class='success5'></li>
																				</div>
																			</div>
																			<span id='mestatus5'></span>
																		</td>
																		<td>
																			<div id='me6' style='cursor:pointer; height: 70px; width: 75px;'>
																				<button class='button_profile'><img src='images/input.png' width='50'></button>
																					
																				<div id='product6'>
																					<li class='nameupload6'></li>
																				</div>
																				<div id='files6'>
																					<li class='success6'></li>
																				</div>
																			</div>
																			<span id='mestatus6'></span>
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
											<button type='submit'class='btn btn-black'><i class='ion-checkmark-circled'></i> Simpan</button>
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
	
	break;
}
?>