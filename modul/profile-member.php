<script>
$(document).ready(function(){
	$("#provinceID").change(function(){
				var province = $("#provinceID").val();
				$.ajax({
					url: "getdata/get_cities.php",
					data: "province="+province,
					cache: false,
					success: function(msg){
						$("#cityID").html(msg);
					}
				});
	});	
});
</script>
<script>
$(document).ready(function(){
	$("#courierID").change(function(){
				var courier = $("#courierID").val();
				$.ajax({
					url: "getdata/get_shipping.php",
					data: "courier="+courier,
					cache: false,
					success: function(msg){
						$("#shippingID").html(msg);
					}
				});
	});	
});
</script>
<?php
if ($_SESSION['email'] != ''){
$queryProfile="SELECT * FROM members A LEFT JOIN
			provinces B ON A.provinceID=B.provinceID LEFT JOIN
			cities C ON A.cityID=C.cityID LEFT JOIN
			shipping D ON A.shippingID=D.shippingID LEFT JOIN
			courier E ON D.courierID=E.courierID LEFT JOIN
			bank F ON A.bankID=F.bankID
		WHERE A.memberID = '$_SESSION[useri]'
		ORDER BY A.memberID";
$sqlProfile = mysql_query($queryProfile);
$r=mysql_fetch_array($sqlProfile);
$login = date('Y-m-d H:i:s');
	if ($r['gender'] == 'L'){
		$checka = 'checked';
	}
	elseif($r['gender'] == 'P'){
		$checkb = 'checked';
	}
	else{
		$checka = '';
		$checkb = '';
	}
?>	
		<div id="content" class="main-content bg-light">
			<div class="bg-black text-white b-b" style="background:url(images/1a.jpg) center center; background-size:cover;background-color: #263845;">
				<div class="bg-gd-dk">
					<div class="container h-md pos-rlt">
						<div class="h-md">
							<div class=" wrapper align-bottom">
								<div>
								<?php
								if($r['photo'] != '' ){
									echo"<img class='pull-left thumb-xl avatar m-r-md' src='upload/member/$r[photo]'>";
								}
								else {
									echo"<img class='pull-left thumb-xl avatar m-r-md' src='images/fb.jpg'>";
								}
								?>
								</div>
								<div class="pull-left">
									<div class="align-bottom m-b-xs w-xxl">
										<span class="h1 text-shadow-sm" itemprop="name"><?php echo $r['memberName']; ?></span>
											<span class="h4 text-info-lter font-bold text-shadow-sm m-l-xs "><?php echo $r['email']; ?></span>
										<p></p>
									</div>
								</div>
							</div>
							<div class="wrapper align-bottom " style="right: 0px;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="container m-t-md">
				<div class="row">
					<div class="col-sm-3 hidden-xs hidden-sm">
						<div class="panel panel-default b-a">
							<div class="panel-heading ">
								<span class="font-bold"><i class='ion-gear-b'></i> Menu Setting</span>
							</div>
							<div class="panel-body link-info">
								<ul class="nav nav-pills nav-stacked nav-sm text-black">
									<li class="dropdown">
										<a href="profile-member.html">Profile </a>
									</li>								
									<li class="dropdown">
										<a href="password.html">Password </a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-9">	
					
						<ul class='nav nav-tabs'>
							<li class='active'><a href='#view' data-toggle='tab' class='text-sm'>Detail Profile</a></li>
							<li><a href='#edit' data-toggle='tab' class='text-sm'>Profile</a></li>								
						</ul>		
						<div>
					
						<div id='myTabContent' class='tab-content'>		
							<div class='tab-pane active in' id='view'>
								<div class="container m-t-md">
									<div class="row">
										<div class="col-sm-9 link-info">
											<div class="row">
												<div class="col-lg-12">									
													<div class="panel panel-default">
														<div class="panel-heading font-bold ">
															<h3 class="h4 font-bold">Detail Profile</h3>           
														</div>
														<div class="wrapper">
															<div class="form-group">
															  <label class="col-lg-2 control-label">Avatar</label>
															  <div class="col-lg-10">
																<?php
																if($r['photo'] != ''){
																	echo"<img class='pull-left thumb-xl avatar m-r-md' src='upload/member/$r[photo]' />";
																}
																else{
																	echo"<img class='pull-left thumb-xl avatar m-r-md' src='images/fb.jpg' />";
																}
																?>
															  </div>
															</div>														
															<div class="row">
																<div class="col-sm-4">Nama Lengkap:</div>
																<div class="col-sm-4"><?php echo $r['memberName']; ?></div>
															</div>
															<div class="row">
																<div class="col-sm-4">Nomor KTP:</div>
																<div class="col-sm-4"><?php echo $r['nomorKTP']; ?></div>
															</div>			
															<div class="row">
																<div class="col-sm-4">Username:</div>
																<div class="col-sm-4"><?php echo $r['username']; ?></div>
															</div>			
															<div class="row">
																<div class="col-sm-4">Email:</div>
																<div class="col-sm-4"><?php echo $r['email']; ?></div>
															</div>															
															<div class="row">
																<div class="col-sm-4">Provinsi:</div>
																<div class="col-sm-4"><?php echo $r['provinceName']; ?></div>
															</div>
															<div class="row">
																<div class="col-sm-4">Kota:</div>
																<div class="col-sm-4"><?php echo $r['cityName']; ?></div>
															</div>		
															<div class="row">
																<div class="col-sm-4">Telp</div>
																<div class="col-sm-4"><?php echo $r['phone']; ?></div>
															</div>
															<div class="row">
																<div class="col-sm-4">Hobi</div>
																<div class="col-sm-4"><?php echo $r['hobi']; ?></div>
															</div>		
															<div class="row">
																<div class="col-sm-4">Tanggal Lahir</div>
																<div class="col-sm-4"><?php echo $r['tanggalLahir']; ?></div>
															</div>														
																													
															<div class="row">
																<div class="col-sm-4">Update :</div>
																<div class="col-sm-4"><?php echo $login; ?></div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>								
							
							<div class='tab-pane fade' id='edit'>
							<div class="panel-body link-info">
								<form class="form-horizontal" action="action_update_profile.php" method="post" enctype='multipart/form-data'>
									<fieldset class="horizontal-form">
									<?php
									$full_url = full_url();
									if (strpos($full_url, "?suc=ok") == TRUE){
										echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
												<strong><i class='ion-android-done-all'></i> Sukses!</strong> Profile berhasil diupdate
											</div>";
									}
									?>									
								<div class="form-group">
								  <label class="col-lg-2 control-label">Nama Lengkap</label>
								  <div class="col-lg-10">
									<input name="memberName" required="true" type="text" value="<?php echo $r['memberName']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>
								</div>
								<div class="form-group">
								  <label class="col-lg-2 control-label">Nomor KTP</label>
								  <div class="col-lg-10">
									<input name="nomorKTP" required="true" type="text" value="<?php echo $r['nomorKTP']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Jenis Kelamin</label>
									<div class="col-lg-10">
										<div class="radio">
											<label for="account_type_business">
											<input id="account_type" type="radio" name="gender" value="L" <?php echo $checka; ?>>Laki-laki
										</div>
										<div class="radio">
											<label for="account_type_personal">
											<input id="account_type" type="radio" name="gender" value="P" <?php echo $checkb; ?>>Perempuan
										</div>
									</div>
								</div>								
								<div class="form-group">
								  <label class="col-lg-2 control-label">Email</label>
								  <div class="col-lg-10">
									<input name="email" required="true" type="text" value="<?php echo $r['email']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>
								</div>
								<div class="form-group">
								<label class="col-lg-2 control-label">Provinsi</label> 
								<div class="col-lg-4">								
									<select class="form-control" name='provinceID' id='provinceID'>
												<option value=0 selected>- Pilih Provinsi -</option>
												<?php
												$query = "SELECT * FROM provinces ORDER BY provinceID";
												$sql  =mysql_query($query);
  
												while($w=mysql_fetch_array($sql)){
													if($r['provinceID'] == $w['provinceID']){
														echo "<option value=$w[provinceID] SELECTED>$w[provinceName]</option>";
													}
													else{
														echo "<option value=$w[provinceID]>$w[provinceName]</option>";
													}
												}  												
												?>
									</select>
									<span class="help-block m-b-none"></span>
								</div>	
								<div class="col-lg-6">
								<span>
								<select class="form-control" id='cityID' name='cityID' required>
									<option value=''>Pilih Kota Anda</option>
								</select></span>
								</div>
								</div>
								
								<!--<div class="form-group">
								<label class="col-lg-2 control-label">Bank</label> 
								<div class="col-lg-4">								
									<select class="form-control" name='bankID'>
												<option value=0 selected>- Pilih Bank -</option>
												<?php
												$query = "SELECT * FROM bank ORDER BY bankID";
												$sql  =mysql_query($query);
  
												while($t=mysql_fetch_array($sql)){
													if($r['bankID'] == $t['bankID']){
														echo "<option value=$t[bankID] SELECTED>$t[bankName]</option>";
													}
													else{
														echo "<option value=$t[bankID]>$t[bankName]</option>";
													}
												}  												
												?>
									</select>
									<span class="help-block m-b-none"></span>
								</div>
								  <div class="col-lg-6">
									<input name="rekening" required="true" type="text" value="<?php echo $r['rekening']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>								
								</div>
								-->						

								<div class="form-group">
								  <label class="col-lg-2 control-label">Phone</label>
								  <div class="col-lg-10">
									<input name="phone" required="true" type="text" value="<?php echo $r['phone']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>
								</div>

								<div class="form-group">
								  <label class="col-lg-2 control-label">Hobi</label>
								  <div class="col-lg-10">
									<input name="hobi" required="true" type="text" value="<?php echo $r['hobi']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>
								</div>

								<div class="form-group">
								  <label class="col-lg-2 control-label">Tanggal Lahir</label>
								  <div class="col-lg-10">
									<input name="tanggalLahir" required="true" type="text" placeholder="Tahun-Bulan-Tanggal" value="<?php echo $r['tanggalLahir']; ?>" class="form-control text-grey">
									<span class="help-block m-b-none"></span>
								  </div>
								</div>							

								<div class="form-group">
									<label class="col-sm-2 control-label">Alamat</label>
									<div class="col-sm-10">
											<textarea name="address" style='width: 450px; height: 150px;' class='ckeditor'><?php echo $r['address']; ?></textarea>
									</div>
								</div>	
								
								<div class="form-group">
								  <label class="col-lg-2 control-label">Images</label>
								  <div class="col-lg-10">
									<img src="upload/member/<?php echo $r['photo']; ?>" width='300px'>
									<span class="help-block m-b-none"></span>
								  </div>
								</div>								
								<div class="form-group">
								  <label class="col-lg-2 control-label">Upload Photo</label>
								  <div class="col-lg-10">
									<input type='file' name='fupload' size=30>
									<span class="help-block m-b-none"></span>
								  </div>
								</div>								
								<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2 m-t-md">
											<input type="hidden" name="upload" value="yes"/>
											<button type="submit" id="submit-btn" class="btn btn-black"><i class='ion-ios-checkmark-outline'></i> Simpan</button>
										</div>

								</div>									
							</fieldset>
							</form>
						</div>
							
						</div>
						
						</div>
	
					</div>

					</div>

				</div>
			</div>

		</div>	
<?php } 
else{
	header("Location: sign-in.html?err=log");
}

?>