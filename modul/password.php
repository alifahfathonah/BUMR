
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
		
?>	<div id="content" class="main-content bg-light">
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
							<div class="wrapper align-bottom" style="right: 0px;"></div>
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
									</li><li class="divider"></li>								
									<li class="dropdown">
										<a href="password.html">Password </a>
									</li><li class="divider"></li>
									<!--<li class="dropdown">
										<a href="ekspedisi.html">Ekspedisi</a>
									</li>-->
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-9">	
						<ul class='nav nav-tabs'>
							<li class='active'><a href='#view' data-toggle='tab' class='text-sm'>Update Password</a></li>								
						</ul>		

					
						<div id='myTabContent' class='tab-content'>		
							<div class='tab-pane active in' id='view'>
								<div class="panel-body link-info">								
									<form class="form-horizontal" action="action_update_password.php" method="post" enctype="multipart/form-data">
										<?php
										$full_url = full_url();
										if (strpos($full_url, "?suc=ok") == TRUE){
											echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
													<strong><i class='fa fa-check'></i> Sukses!</strong> Password berhasil diupdate
												</div>";
										}
										?>									
										<div class='col-sm-12 link-info'>
											<div class='panel panel-default'>
												<div class='panel-heading font-bold'>Update password dibawah ini</div>
												<div class='panel-body'>

												<div class='row entry'>
													<div class='col-md-12'>
														<div class='col-md-4 no-padding no-margin'>
															<p>
																Password Lama
															</p>
														</div>
														<div class='col-md-8 no-padding no-margin'>
															<div class='form-group'>
																<input name='pass_lama' required='true' class='form-control placehold-italic'></div>
														</div>
													</div>
												</div>		
												<div class='row entry'>
													<div class='col-md-12'>
														<div class='col-md-4 no-padding no-margin'>
															<p>
																Password Baru
															</p>
														</div>
														<div class='col-md-8 no-padding no-margin'>
															<div class='form-group'>
																<input name='pass_baru' required='true' class='form-control placehold-italic'></div>
														</div>
													</div>
												</div>	
												<div class='row entry'>
													<div class='col-md-12'>
														<div class='col-md-4 no-padding no-margin'>
															<p>
																Masukan Lagi Password Baru
															</p>
														</div>
														<div class='col-md-8 no-padding no-margin'>
															<div class='form-group'>
																<input name='pass_ulangi' required='true' class='form-control placehold-italic'></div>
														</div>
													</div>
												</div>	

													
												<div class='form-group'>
														<div class='col-sm-4 col-sm-offset-2 m-t-md'>
															<input type='hidden' name='upload' value='yes'/>
															<button type='submit' id='submit-btn' class='btn btn-primary'><i class='fa fa-check-circle'></i> Update</button>
															<a href='javascript:history.go(-1)'><button type='button' class='btn btn-primary'><i class='fa fa-share'></i> Kembali</button></a>											
														</div>
												</div>									
												</div>
											</div>
										</div>									
									</form>
								</div>
							</div>								

						
						</div>


					</div>

				</div>
			</div>

		</div>	

		
<?php 
}
else{
	header("Location: sign-in.html?err=log");
}

?>