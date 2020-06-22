<?php
error_reporting(0);
include "config/koneksi.php";

function generate_password($length = 10){
	$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$str = '';
	$max = strlen($chars) - 1;
			
	for ($i=0; $i < $length; $i++)
			$str .= $chars[rand(0, $max)];
					
	return $str;
}	

$query_sign_up = "SELECT * FROM members WHERE email = '$_POST[email]'";
$sql_sign_up = mysql_query($query_sign_up);
$nums = mysql_num_rows($sql_sign_up);

if ($_POST['password'] != $_POST['retype_password']){
	header("Location: sign-up.html?error=Error");
}
else{
	if ($nums > 0){
		header("Location: sign-up.html?error=Exist");
	}
	else{	
	$phone = mysql_real_escape_string($_POST['phone']);
	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$memberName = mysql_real_escape_string($_POST['memberName']);
	$nomorKTP= mysql_real_escape_string($_POST['nomorKTP']);
	$tanggalLahir= mysql_real_escape_string($_POST['tanggalLahir']);
	$hobi= mysql_real_escape_string($_POST['hobi']);
	$password = md5($_POST['password']);
	$createdDate = date('Y-m-d H:i:s');
	$verificationCode = generate_password();
	
	$queryRegister = "INSERT INTO members	 (	email,
												username,
												nomorKTP,
												tanggalLahir,
												hobi,
												password,
												memberName,
												phone,
												address,
												provinceID,
												cityID,
												shippingID,
												gender,
												status,
												createdDate,
												codeVerication)
												VALUES	('$email',
														 '$username',
														 '$nomorKTP',
														 '$tanggalLahir',
														 '$hobi',
														 '$password',
														 '$memberName',
														 '$phone',
														 '',
														 '',
														 '',
														 '',
														 '',
														 'N',
														 '$createdDate',
														 '$verificationCode')";
		mysql_query($queryRegister);
		$to = $_POST['email'];
		$pass = $_POST['password'];
		$username = $_POST['username'];		
		$subject = "Akun anda akan segera diverifikasi oleh Admin";
		$html = "<h5>Thank you for your registration at poli-market.com</h5>
					<p>
					Your username : $username <br>
					Your email account : $to <br>
					Your password : $pass <br><br>
					
					Your activation code is $verification <br><br>
					For activation please click this url: <br>
					<a href='http://www.ecommerce.com/activate.php?code=$verification&email=$email'>http://www.ecommerce.com/activate.php?code=$verificationCode&email=$email</a>
					<br><br><br>
					Thank You<br>
					This is an automated email. Do not reply. For trouble send to <a href='mailto: admin@ecommerce.com'>admin@ecommerce.com</a><br><br>
					E-lapak.com
					</p>
					";	
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= 'From: Membership <membership@ecommerce.com>' . "\r\n";

		mail($to, $subject, $html, $headers);
		
		header("Location: success.html");				
	}
}
?>