<?php 
  error_reporting(0);
  ob_start();	
  session_start();
  include "../config/koneksi.php";
?>
<link rel="stylesheet" href="css/login2.css" type="text/css" />
<?php
$username = mysql_real_escape_string($_POST['username']);
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE username = '$username' AND password ='$password'";
$data = mysql_query($sql);
$cek = mysql_num_rows($data);
$data = mysql_fetch_array($data);

if ($cek > 0){
	session_start();
	$last_login = date('Y-m-d H:i:s');
	
		$_SESSION['username'] = $data['username'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['useri'] = $data['userID'];		
		$_SESSION['nama_lengkap'] = $data['fullName'];
		$_SESSION['last_login'] = date('Y-m-d H:i:s');
	
	header("location:beranda.php?app=home");
}
else{
	header("Location: index.php?msg=username atau password tidak valid.");
}


?>