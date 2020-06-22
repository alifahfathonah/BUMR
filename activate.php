<?php
error_reporting(0);
include "config/koneksi.php";

$queryFind = "SELECT * FROM members WHERE email = '$_GET[email]' AND status = 'N' AND codeVerication = '$_GET[code]'";
$sqlFind = mysql_query($queryFind);
$nums = mysql_num_rows($sqlFind);
if ($nums > 0){
	$queryUpdate = "UPDATE members SET status = 'Y'	WHERE email = '$_GET[email]'";
	mysql_query($queryUpdate);
	header("Location: congratulation.html");	
}
else{
	header("Location: index.php");
}
?>