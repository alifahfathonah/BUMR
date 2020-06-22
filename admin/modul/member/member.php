<?php
session_start();
if (empty(  $_SESSION['useri'] ) AND empty( $_SESSION['email'])){
	echo "
				<section id='error-number'>
					<img src='img/lock.png'>
					<h1>MODUL TIDAK DAPAT DIAKSES</h1>
					<p><span class style=\"font-size:14px; color:#ccc;\">Untuk akses modul, Anda harus login terlebih dahulu</p></span><br/>
				</section>
";
}
else{
$aksi="modul/member/aksi_member.php";
switch($_GET[act]){
  // Tampil 
  default:
    echo "<h2>Member</h2>

          <table class='table'>
          <tr><th>#</th>
		  <th>Username</th>
		  <th>Email</th>
		  <th>Phone</th>
		  <th>Login </th>
		  <th>Status</th>
		  <th align='tengah'>Aksi</th></tr>"; 
		$sql=mysql_query("SELECT * FROM members
					ORDER BY memberID");
    $no=1;
    while ($r=mysql_fetch_array($sql)){
										if ($r['status'] == 'Y'){
											$status = "<span class='label label-success'><i class='ion-android-done'></i> Terverifikasi</span>";
										}
										else{
											$status = "<span class='label label-warning'><i class='ion-alert-circled'></i> Tidak Aktif</span>";
										}
										if ($r['kelamin'] == 'L'){
											$kelamin = "Laki-laki";
										}
										else{
											$kelamin = "Wanita";
										}										
		$last = date('Y-m-d H:i:s');
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
			 <td>$r[email]</td>
			 <td>$r[phone]</td>
			 <td>$last</td>
			 <td>$status</td>
             <td>
				<a href='?app=member&act=viewmember&id=$r[memberID]'>Edit</a> |";
?>
					
	
								
<?php								
			echo"<a href=$aksi?module=member&act=hapus&id=$r[memberID] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
	
	case "viewmember":
	$r = mysql_fetch_array(mysql_query("SELECT * FROM members A LEFT JOIN 
														provinces B ON A.provinceID=B.provinceID LEFT JOIN
														cities C ON A.cityID=C.cityID
														WHERE A.memberID = '$_GET[id]'"));	
	if ($r['status'] == 'Y'){
		$status = "Aktif";
	}
	else{
		$status = "Tidak Aktif";
	}	

	echo "<h2>Edit Member</h2>
	<div class='well'>
	<table class='table'>
		<tr>
			<td>Status</td>
			<td>$status</td>
		</tr>	
		<tr>
			<td>Username</td>
			<td>$r[username]</td>
		</tr>	
		<tr>
			<td>Nama Lengkap</td>
			<td>$r[memberID]</td>
		</tr>
		<tr>
			<td>Kota</td>
			<td>$r[cityName]</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>$r[email]</td>
		</tr>
		<tr>
			<td>Hp</td>
			<td>$r[phone]</td>
		</tr>		
		";
?>
					<?php if ($r['status'] == 'Y'){ ?>
								<form method="POST" action="modul/member/not_active.php?app=member&act=change">
									<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
									<input type='submit' name='submit' class='btn btn-success' value='Non Aktifkan'>
								</form>
								<?php } else{ ?>
								<form method="POST" action="modul/member/active.php?app=member&act=change">
									<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
									<input type='submit' name='submit' class='btn btn-success' value='Aktifkan'>
								</form>
					<?php } ?>	
					&nbsp;<input type='button' class='btn btn-success' value='Kembali' onclick='self.history.back()'>
<?php					
	echo"</table></div>";
break;
}
}
?>