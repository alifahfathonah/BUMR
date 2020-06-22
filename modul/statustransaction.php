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
$sql = mysql_query("SELECT * FROM orders A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					orders_detail C ON C.orderID=A.orderID LEFT JOIN
					products D ON D.productID=C.productID LEFT JOIN
					members E ON A.memberID=E.memberID LEFT JOIN
					shipping F ON E.shippingID=F.shippingID
					WHERE B.memberID='$_SESSION[useri]' 
					ORDER BY A.orderID");
$no =1;	
$t=mysql_num_rows($sql);			
if($t=='0'){
    echo "<script>window.alert('Belum ada History Belanja');
        window.location=('index.php')</script>";
}
else{
	echo"<div id='content' class='main-content bg-lights'>
			<div class='container'><div class='m-t-md'></div>
				<div class='row'>
					<div class='col-sm-12 link-info'>
						<div class='panel b-a'>
							<div class='panel-heading b-b b-light'>
								<span class='font-bold'><i class='fa fa-exchange m-r-xs'></i> Transaksi Belanja</span>
							</div>	
							<table class='table table-striped m-b-none'>
								<thead class='panel-heading b-b b-light'>
									<tr>	
										<th>No</th>	
										<th>No.Tagihan</th>
										<!--<th>No.Resi</th>-->
										<th>Tgl Transaksi</th>
										<th>Produk</th>
										<th>Harga</th>
										<th>Total Bayar</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr></thead><tbody>";									
									while($data = mysql_fetch_array($sql)){
										$harga  = format_rupiah($data['salePrice']);
										$subtotal = ($data['salePrice']) * $data['quantity'];
										$subtotal_rp = format_rupiah($subtotal);
										$total  = $total + $subtotal;			
										$total_rp  = format_rupiah($total);
										$all = format_rupiah($data['totalOrder']);
										$ongkir = format_rupiah($data['shippingCost']);
?>
									<tr>
										<td><?php echo $no;?></td>			
										
										<td><font color='c30f42'>#<?php echo $data['invoice']; ?></font></td>
										
										<!--<?php
										if($data['resi'] == '' ){
											echo "<td><span class='label label-danger'><i class='ion-close-circled'></i> Belum Ada Resi</span></td>";
										}
										else{
											echo"<td> $data[resi]</td>";
										}
										?>-->

										<td> <?php echo $data['dateOrder']; ?></td>
										
										<?php
										echo"<td><a href='product-$data[productID]-$data[productSeo].html' target='_blank'>$data[productName]</a></td>";
										?>
										<td>Rp. <?php echo $harga; ?></td>

										<td>Rp. <?php echo $all; ?></td>
										
										<td>
										<span title='pending' <?php if ($data['pendingOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
															else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-hourglass-half fa-stack-1x fa-inverse"></i></span>

										<!--<span title='dibayar' <?php if ($data['paidOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
															else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
										<i class="fa fa-money fa-stack-1x fa-inverse"></i></span>-->

										<span title='dikirim' <?php if ($data['sendOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
															else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-truck fa-stack-1x fa-inverse"></i></span>
											
										<span title='diterima' <?php if ($data['acceptOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
															else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
											<i class="ion-android-done-all fa-stack-1x fa-inverse"></i></span>		
										</td>		
										<?php
											if($data['statusOrder']=='Dikirim'){
												echo"<td>
													<span class='label label-danger'>
													<a href='add-complete-1-$data[orderID].html'><font color='white'>Konfirmasi diterima?</font></a></td>";
											}
											elseif($data['statusOrder']=='Dibayar'){
												echo"<td><span class='label label-warning'> Menunggu Verifikasi ..</td>";	
											}	
											elseif($data['statusOrder']=='Diterima'){
												echo"<td><span class='label label-success'><i class='ion-android-done'></i> Barang diterima </span> &nbsp;
													</td>";	
											}			
											elseif($data['statusOrder']=='Pending'){
												//echo"<td><span class='label label-danger'><a href='add-paid-1-$data[orderID].html'><font color='white'>Konfirmasi Proses Pengiriman</font></a></span></td>";
													echo"<td><span class='label label-warning'> Menunggu Di Kirim</td>";			
											}
										?> 											
									</tr>
									<?php
									$no++;	
									}
									?>
							<?php
							echo"</td><tr/>";	
	echo "</table></div></div></div></div></div>";								
}
?>