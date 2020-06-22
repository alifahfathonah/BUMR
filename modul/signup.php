<?php
include "config/koneksi.php";
?>

	<div class="offset-header"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 margin-bottom-md">
				<h3 align="center" class="fg-red"><strong>Form Registrasi</strong></h3>
			</div>
		</div>
		
		<div style="margin-bottom: 20px;" class="row">
			<div style=" border-bottom: dotted 2px #e9e9ea; padding: 0 0 20px 0;" class="col-md-8 col-md-offset-2">


				<?php
				$full_url = full_url();			
				if (strpos($full_url, "error=Error") == TRUE){
					echo "<div class='col-md-12'>
									<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;
									</span></button>
								<p><i class='fa fa-times' aria-hidden='true'></i> Registrasi Gagal, silahkan ulangi kembali!</p>
							</div>					
					</div>";
				}
				if (strpos($full_url, "error=Exist") == TRUE){
					echo "<div class='col-md-12'>
									<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;
									</span></button>
								<p><i class='fa fa-times' aria-hidden='true'></i> Email terverifikasi, silahkan gunakan email yang valid!</p>
							</div>					
					</div>";
				}					
				?>					
				<form name="form" action="action_sign_up.php" class="form-validation" id="frm_sign_in" method="post">
					<div class="col-md-12">						
						<div class="col-md-6">
						<div style="border-bottom: solid 2px #e9e9ea; margin-bottom: 10px;" class="div"></div>
							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="username" placeholder="Username" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-user fg-gray"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="memberName" placeholder="Nama Lengkap" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-user fg-gray"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="nomorKTP" placeholder="Nomor KTP" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-user fg-gray"></i>
										</div>
									</div>
								</div>
							</div>


							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="email" placeholder="Email" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-envelope-o fg-gray"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="tanggalLahir" placeholder="Tanggal Lahir (Format : YYYY-MM-DD)" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-user fg-gray"></i>
										</div>
									</div>
								</div>
							</div>

							
													
						</div>
					
						<div class="col-md-6">
						<div style="border-bottom: solid 2px #e9e9ea; margin-bottom: 10px;" class="div"></div>
							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="password" name="password" placeholder="Password" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-lock fg-gray"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input name="retype_password" type="password" placeholder="Ulangi Password" required='true' class="form-control right-border-less" required>
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-lock fg-gray"></i>
										</div>
									</div>
								</div>
							</div>
								

							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="hobi" placeholder="Hobi (ex: Membaca)" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-user fg-gray"></i>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 no-padding">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="phone" placeholder="No. Telp (ex: +6281234567890)" required='true' class="form-control right-border-less">
										<div class="input-group-addon bg-white left-border-less radius-5-right">
											<i class="fa fa-phone fg-gray"></i>
										</div>
									</div>
								</div>
							</div>


						</div>
						
					
					</div>

					<div class="col-md-12">
						<div class="col-md-12 center">
							
							<p class="margin-top-xs">
								<input type='checkbox' checked onclick="return true;"> Dengan mendaftar, Anda telah menyetujui <a href="syaratketentuan.php"> <font color="blue">syarat dan ketentuan </font></a></text>  dari BUMR 
							</p>
							<button class="btn btn-success btn-block center">Daftar </button>
							<div style="border-bottom: solid 2px #e9e9ea; margin-bottom: 10px;" class="div"></div>

						</div>
					</div>
				</form>
					<div class="col-md-12">
						<div class="col-md-12 center">
							<div style="border-bottom: solid 2px #e9e9ea; margin-bottom: 10px;" class="div"></div>
							<p class="font-15">
								<a class='btn btn-danger btn-block center' href="sign-in.html" target="_self" class="hover-underline"> Login</a>
							</p>
						</div>
					</div>				
			</div>
		</div>
	</div>