<script type="text/javascript" src="js/ajaxupload.3.5.js"></script>
<link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css"/>
<style>
	li{
		list-style: none;
	}
</style>
<script>
$(document).ready(function(){

			var btnUpload1=$('#me1');
			var mestatus1=$('#mestatus1');
			var files1=$('#files1');
			new AjaxUpload(btnUpload1, {
				action: 'upload/upload_ads.php',
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
							$('<li></li>').appendTo('#files1').html('<img src="upload/ads/'+response+'" alt="" width="70" height="70" style="border-radius: 10px; margin-left: -3px; margin-top:-75px; border: 3px solid #ccc"/><br />').addClass('success1');
							$('<li></li>').appendTo('#product1').html('<input type="hidden" name="filename1" value="'+response+'">').addClass('nameupload1');
							
						} else{
							$('<li></li>').appendTo('#files1').text(file).addClass('error1');
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
$aksi="modul/action_ads.php";
switch($_GET[act]){
	default:
	echo"<div id='content' class='main-content bg-lights'><div class='container'>
			<div class='m-t-md'></div>
				<div class='row'>	
				<form method='POST' action='$aksi?module=ads&act=input' onsubmit='return validasi_input(this)'>
					<div class='col-sm-8 link-info'>
							<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>
								<strong><i class='ion-alert-circled'></i> Pastikan Saldo Anda Mencukupi Transaksi Iklan Anda, Admin akan mengecek transaksi anda !</strong>
							</div>
						<div class='panel panel-default'>
						
							<div class='panel-heading font-bold'>Tambah Iklan</div>
								<div class='panel-body'>";
									$sql1 = mysql_query("SELECT SUM(A.total1) as totals, C.adsValue, D.totalPaid
														FROM balance_order A LEFT JOIN	
														members B ON A.memberID=B.memberID LEFT JOIN
														ads_order C ON B.memberID=C.memberID LEFT JOIN
														orders D ON C.memberID=B.memberID
														WHERE B.memberID='$_SESSION[useri]' AND A.finish=1 
														ORDER BY A.balanceOrderID");
									$r1=mysql_fetch_array($sql1);									
									$cek1=mysql_num_rows($sql1);
									$all = ($r1['totals'] - $r1['adsValue']);
									if($cek1 < 1){	
									echo "<script>window.alert('Saldo Anda Masih Kosong!');
											window.location=('index.php')</script>";
									}
									else{
											echo"
													<input type='hidden' class='form-control text-sm' type='text' name='adsTotal' value='$all' >											
													";	
									}
										
										
									echo"<div class='form-group'>
										<label class='col-lg-2 control-label'>Nama Produk</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' name='adsName' required='true'>
											<span class='help-block'></span>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Link URL</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' name='adsUrl'>
											<span class='help-block'></span>
										</div>
									</div>									
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Kategori Iklan</label>
										<div class='col-lg-10'>
										<select class='form-control text-sm' name='adsID'>
												<option value=0 selected>- Pilih Kategori -</option>";
											    $tampil=mysql_query("SELECT * FROM ads ORDER BY adsID");
												while($r=mysql_fetch_array($tampil)){
													$price = format_rupiah($r['adsPrice']);
													echo "<option value=$r[adsID]>$r[adsTitle] [ $price ]</option>";
												}                              
										echo "</select>	
											<span class='help-block'></span>
										</div>
									</div>	
									<div class='form-group'>
										<label class='col-sm-2 control-label'>Keterangan</label>
										<div class='col-sm-10'>
											<textarea name='adsDescription' style='width: 450px; height: 150px;' class='ckeditor'></textarea>
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
	
	break;
}
?>