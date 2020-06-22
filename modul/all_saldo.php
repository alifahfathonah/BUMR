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
$sql = mysql_query("SELECT * FROM balance_order A INNER JOIN
					members B ON A.memberID=B.memberID INNER JOIN
					balance C ON C.balanceID=A.balanceID
					WHERE B.memberID ='$_SESSION[useri]'
					ORDER BY A.balanceOrderID");
$no =1;	
$t=mysql_num_rows($sql);			
if($t=='0'){
    echo "<script>window.alert('Belum ada History Transaksi');
        window.location=('index.php')</script>";
}
else{
echo "<div id='content' class='main-content bg-lights'>
<div class='container'><div class='m-t-md'></div>
				<div class='row'>
					<div class='col-sm-12 link-info'>
						<div class='panel b-a'>";
						$full_url = full_url();
						if (strpos($full_url, "?suc=ok") == TRUE){
							echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong><i class='ion-checkmark-circled'></i> Saldo berhasil dibayar!</strong> Transaksi Anda
							</div>";
						}				
						echo"<table class='table table-striped m-b-none'>
							<thead class='panel-heading b-b b-light'>
								<tr>
									<th>#</th>	
									<th>No.Transaksi</th>
									<th>Tgl Pemesan</th>								
									<th>Deposit</th>
									<th>Penyetor</th>
									<th>Status</th>
								</tr></thead><tbody>";
							while($data = mysql_fetch_array($sql)){
								$tanggal=tgl_indo($data['dateCreate']);
								$price = format_rupiah($data['balancePrice']);
								$deposit = format_rupiah($data['balanceValue']);
								
								$tot+=$data['total'];	
							echo"<tr>
								<td>$no</td>	
								<td>$data[orderInvoice]</td>
								<td>$tanggal</td>";							
								echo"<td>$deposit</td>		
									<td>$data[depoName]</td>
								<td>";
									if($data['statusDeposit']=='Pending'){
										echo"<span class='label label-danger'><a href='paid-balance-1-$data[balanceOrderID].html'><font color='white'>
										<i class='ion-android-add'></i> Bayar sekarang</font></a></span>";			
									}
									if($data['statusDeposit']=='Dibayar'){
										echo"<span class='label label-warning'><i class='ion-android-done'></i> Menunggu Verifikasi ..";
									}
									if($data['statusDeposit']=='Selesai'){
										echo"<span class='label label-success'><i class='ion-checkmark'></i> Valid";
									}							
								echo"</tr>
							";
								
							$no++;
							}
echo"
									</table></div></div></div></div></div>";	
	
}
					
?>