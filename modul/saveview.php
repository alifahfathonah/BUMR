<script>
$(document).ready(function(){
	$("#courierID").change(function(){
				var courier = $("#courierID").val();
				$.ajax({
					url: "getdata/get_courier.php",
					data: "courier="+courier,
					cache: false,
					success: function(msg){
						$("#shippingID").html(msg);
					}
				});
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
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
	echo"<div class='container m-t-md'>
			<div class='row'>	
				<div class='col-sm-12'>	
						<ul class='nav nav-tabs'>
							<li class='active'><a href='#view' data-toggle='tab' class='text-sm'>ALAMAT PENERIMA</a></li>
							<!--<li><a href='#edit' data-toggle='tab' class='text-sm'>PILIH EKSPEDISI</a></li>	-->		
							<span>
								<a href='save-transaction.html' class='btn btn-black'>
								<i class='ion-checkmark-circled'></i> Lanjutkan Konfirmasi Pesanan </a>
							</span>	
						</ul>";
?>
						<?php
						$queryProfile="SELECT * FROM members A LEFT JOIN
										provinces B ON A.provinceID=B.provinceID LEFT JOIN
										cities C ON A.cityID=C.cityID LEFT JOIN
										shipping D ON A.shippingID=D.shippingID LEFT JOIN
										courier E ON D.courierID=E.courierID
									WHERE A.memberID = '$_SESSION[useri]'
									ORDER BY A.memberID";
						$sqlProfile = mysql_query($queryProfile);
						$r=mysql_fetch_array($sqlProfile);
						?>								
						<div id='myTabContent' class='tab-content'>		
							<div class='tab-pane active in' id='view'>
								<div class="container m-t-md">
									<div class="row">	
									<p>
									Pastikan alamat penerima anda benar, apabila ingin diganti silahkan update alamat penerima anda!
									</p>
									<?php
										$full_url = full_url();
										if (strpos($full_url, "?suc=ok") == TRUE){
											echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
													<strong><i class='ion-android-done-all'></i> Sukses!</strong> Alamat Penerima berhasil diupdate
												</div>";
										}
									?>										
										<div class="col-sm-9 link-info">
											<div class="row">
												<div class="col-lg-12">
													<div class="panel panel-default">

														<div class="wrapper">
																			
															<div class="row">
																<div class="col-sm-4">Nama Lengkap</div>
														
																<div class="col-sm-4"><?php echo $r['memberName']; ?></div>
															</div>					
															<div class="row">
																<div class="col-sm-4">Email</div>
																
																<div class="col-sm-4"><?php echo $r['email']; ?></div>
															</div>			
															<div class="row">
																<div class="col-sm-4">Telp</div>
																
																<div class="col-sm-4"><?php echo $r['phone']; ?></div>
															</div>																
															<div class="row">
																<div class="col-sm-4">Provinsi</div>
															
																<div class="col-sm-4"><?php echo $r['provinceName']; ?></div>
															</div>
															<div class="row">
																<div class="col-sm-4">Kota</div>
																
																<div class="col-sm-4"><?php echo $r['cityName']; ?></div>
															</div>											
															<div class="row">
																<div class="col-sm-4">Alamat</div>
															
																<div class="col-sm-4"><?php echo $r['address']; ?></div>
															</div>
															<?php
															if($r['courierID'] != ''){
																echo "
																<div class='row'>
																	<div class='col-sm-4'>Ekspedisi/Kurir</div>
																
																	<div class='col-sm-4'>$r[courierName]</div>
																</div>";
															}
															?>
														</div>
														<div class="panel-heading font-bold ">
															<a href="edit-address-1-1-<?php echo $r['memberID'];?>.html" class="btn btn-black">
															 Update Penerima </a>														
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
									<form class="form-horizontal" action="action_edit_courier.php" method="post">
										<?php
										$full_url = full_url();
										if (strpos($full_url, "?suc=ok") == TRUE){
											echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
													<strong><i class='fa fa-check'></i> Sukses!</strong> Kurir berhasil diupdate
												</div>";
										}

										?>	
										
										<p>Silahkan pilih jasa ekspedisi / kurir yang disediakan, pemilihan ekspedisi dan kurir ditentukan oleh sistem sesuai dengan alamat pengiriman, tidak semua kota dijangkau oleh jasa kurir / ekspedisi tertentu, oleh karena itu kami hanya 
									menampilkan daftar kurir / ekspedisi yang tersedia dikota Anda.</p>				
										<div class='col-sm-9 link-info'>										
											<div class='panel panel-default'>
												<div class='panel-heading font-bold'>Metode Pengiriman</div>
												<div class='panel-body'>
												<div class="form-group">
												<label class="col-lg-2 control-label">Ekspedisi</label> 
												<div class="col-lg-4">								
													<select class="form-control" name='courierID' id='courierID'>
																<option value=0 selected>- Pilih Ekspedisi Kurir -</option>
																<?php																
																$query = "SELECT * FROM courier ORDER BY courierID";
																$sql  =mysql_query($query);
																while($w=mysql_fetch_array($sql)){
																echo "<option value=$w[courierID]>$w[courierName]</option>";
																}               
																?>
													</select>
													<span class="help-block m-b-none"></span>
												</div>
												</div>
												<div class='form-group'>
													<label class='col-lg-2 control-label'>Kota Pengiriman</label>
													<div class='col-lg-10'>
															<select class='form-control text-sm' id='shippingID' name='shippingID' required>
																<option value=''>Provinsi</option>
															</select><span class='help-block'></span>
													</div>
												</div>												

												<div class='form-group'>
														<div class='col-sm-4 col-sm-offset-2 m-t-md'>
															<button type='submit' id='submit-btn' class='btn btn-black'><i class='fa fa-check-circle'></i> Pilih</button>											
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
<?php		
	
}

?>
