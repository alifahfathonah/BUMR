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
$data_profile = mysql_fetch_array(mysql_query("SELECT * FROM members A WHERE A.memberID = '$_SESSION[useri]'"));
?>
<?php	
echo"<div id='content' class='main-content bg-lights'><div class='container'>
		<div class='m-t-md'></div>
			<div class='row'>
				<form method=POST action='modul/action_add_balance.php' enctype='multipart/form-data' id='postform' name='postform'>
					<div class='col-sm-8 link-info'>
						<div class='panel panel-default'>
							<div class='panel-heading font-bold'>Buka Saldo</div>";
								echo"<div class='panel-body'>
									<div class='form-group'>
										<label class='col-lg-2 control-label'>Tambah Saldo</label>
										<div class='col-lg-10'>
											<select name='deposit' class='form-control text-sm'>";
											    $tampil=mysql_query("SELECT * FROM balance ORDER BY balanceID");
												while($r=mysql_fetch_array($tampil)){
													$nilai = format_rupiah($r['balanceValue']);
													$harga = format_rupiah($r['balancePrice']);
													echo "<option value=$r[balanceID]>$nilai -  Rp.$harga</option>";
												}
											echo"</select>
											<span class='help-block'></span>
										</div>
									</div>	
									
									<div class='form-group '>
										<label class='col-lg-2 control-label '></label>
										<div class='col-lg-10'>
											<input type='checkbox' name='syarat' value='1' CHECKED DISABLED> 
											Saya sudah membaca dan menyetujui semua syarat dan ketentuan E-Belanja.com 
											<span class='help-block'></span>
										</div>
									</div>									

                                        <div class='form-group'>											
											<label class='col-lg-2 control-label'>Transfer</label>                                  
                                            <div class='col-lg-10'>
											<img src='static/img/mandiri.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'><input value=mandiri name=bank type='radio' required='true'> Mandiri
                                            <img src='static/img/bni.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'><input value=bni name=bank type='radio'> BNI
		                                    <img src='static/img/bri.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'><input value=bri name=bank type='radio'> BRI
		                                    <img src='static/img/bca.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'><input value=bca name=bank type='radio'> BCA											
                                         <span class='help-block'></span>
                                          </div>			
										</div> 

										
									<div class='form-group '>
										<label class='col-lg-2 control-label '></label>
										<div class='col-lg-10'>
											<div class='alert alert-info'>
												<a href='#' class='close' data-dismiss='alert'>&times;</a><strong>
												Catatan :<br/>
												1. Saldo digunakan untuk membuat iklan produk anda! <br/></strong>
											</div>
										</div>
									</div>

									
									<div class='form-group'>
										<div class='col-sm-4 col-sm-offset-2 m-t-md'>
											<input type='hidden' name='upload' value='yes'/>
											<button type='submit' id='submit-btn' class='btn btn-black'><i class='ion-checkmark-circled'></i> Proses</button>
											<a href='javascript:history.go(-1)'><button type='button' class='btn btn-black'><i class='ion-arrow-left-a'></i> Kembali</button></a>											
										</div>
									</div>									
								</div>
							</div>
							
						</div>

							<div class='col-sm-4 '>
							<div class='panel b-a'>
								<div class='panel-heading b-b b-light'>
									<span class='font-bold'><i class='ion-compose m-r-xs'></i> Catatan</span>
								</div>
								<div class='panel-body link-info'>

								<ul>
									<li>Pastikan saldo anda mencukupi dalam beriklan </li>
								</ul>
								</div>
								<div class='panel-footer bg-light lter text-center '>
									<img src='static/img/mandiri.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'>
									<img src='static/img/bni.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'>
									<img src='static/img/bri.png' height='32' width='32' class='m-r-sm m-t-n m-b-n'>
								</div>								
							</div>
						</div>

						
					</form>
				</div>
			</div>
		</div>
		</div>";
?>