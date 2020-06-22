<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
</div>
<div class="container w-xxl w-auto-xs">
	<div class="m-t-md"></div>
	<div class="m-b-lg">	
<?php
	$full_url = full_url();
	if (strpos($full_url, "log=e_log") == TRUE){
		echo "<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert'>&times;</a><strong><i class='ion-alert-circled'></i> Username atau password tidak valid</strong></div>";
	}
	elseif (strpos($full_url, "suc=code") == TRUE){
		echo "<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert'>&times;</a><strong><i class='ion-alert-circled'></i> 
				Kode Captcha tidak valid</strong></div>";
	}	
?>
<form name="form" action="action_sign_in.php" class="form-validation" id="frm_sign_in" method="post">
	<?php
		if (strpos($full_url, "?frm=yes") == TRUE){
			echo "<input type='hidden' name='iden' value='1'>";
		}
	?>
    <p class="text-center m-t-lg m-b"><small>Masukan Email Dan Password Anda</small></p>	
	<div class="list-group list-group-sm">
		<div class="list-group-item">
			<input id="username" name="email" type="text" placeholder="Email" class="form-control no-border text-grey" required></div>
		<div class="list-group-item">
			<input id="password" name="password" type="password" placeholder="Password" class="form-control no-border text-grey" required>
		</div>
		<!--<div class="list-group-item">
			<img src='captcha.php' width='100' height='30' /><p class="help-block notif">
			<input name='kode' type="text" class="form-control no-border text-grey"  placeholder="Kode Captcha"/></p>	
		</div>-->
	</div>
	<button type="submit" type="submit" name="login" value="yes" class="btn btn-lg btn-black btn-block">
		<input type="hidden" name="login"/><i class='ion-log-in'></i> Login
	</button>

	<div class="line line-dashed"></div>
		<p class="text-center">
			<small>Belum mempunyai akun?</small>
		</p>
	<a href="sign-up.html" class="btn btn-lg btn-success btn-block"><i class='ion-person-add'></i> Daftar</a>
</form>
</div>
</div>