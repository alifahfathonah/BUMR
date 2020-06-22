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
					products D ON D.productID=C.productID
					WHERE B.memberID='$_SESSION[useri]'  ORDER BY A.memberID");
$no =1;	
$cek=mysql_num_rows($sql);			

echo"<div id='content' class='main-content bg-lights'>
		<div class='container'><div class='m-t-md'></div>	
			<div class='row'>
					<div class='col-sm-12'>
						<ul class='nav nav-tabs'>
							<li class='active'><a href='#beli' data-toggle='tab' class='text-sm'>Pembelian</a></li>
							<li><a href='#jual' data-toggle='tab' class='text-sm'>Penjualan</a></li>			  					
						</ul>		
						<div id='myTabContent' class='tab-content'>	
						<div class='tab-pane active in' id='beli'>						
							<div class='panel b-a'>
								<div class='panel-heading b-b b-light'>
									<span class='font-bold'><i class='fa fa-exchange m-r-xs'></i> History Pembelian</span>
								</div>		
								<table class='table table-striped m-b-none'>
									<thead class='panel-heading b-b b-light'>
										<tr>
											<th>No</th>	
											<th>No. Tagihan</th>
											<th>Tgl Pemesan</th>
											<th>Produk</th>
											<th>Qty</th>
											<th>Harga</th>		
											<th>Total Pembayaran</th>
											<th>Status</th>
										</tr></thead><tbody>";	
											while($data = mysql_fetch_array($sql)){
												$tanggal=tgl_indo($data['dateOrder']);
												$harga  = format_rupiah($data['salePrice']);
												$subtotal = ($data['salePrice']) * $data['quantity'];
												$subtotal_rp = format_rupiah($subtotal);
												$total  = $total + $subtotal;			
												$total_rp  = format_rupiah($total); 
												$all = format_rupiah($data['totalOrder']);
												if($data['statusOrder']=='Dibayar'){
													$warning="fa-stack fa-lg icon-green";
												} 
												elseif($data['statusOrder']=='Konfirmasi'){
													$warning="fa-stack fa-lg icon-green";
												}
												elseif($data['statusOrder']=='Dikembalikan'){
													$warning="fa-stack fa-lg icon-green";
												}		
												elseif($data['statusOrder']=='Pending'){
													$warning="fa-stack fa-lg icon-green";
												}			
											?>
											<tr>
												<td><?php echo $no;?></td>			
												<td><font color='c30f42'>#<?php echo $data['invoice']; ?></font></td>
												<td> <?php echo $tanggal; ?></td>
												<?php
												echo"<td>$data[productName]</td>";
												?>
												<td><?php echo $data['quantity'];?></td>
												<td>Rp. <?php echo $harga; ?></td>
												<td>Rp. <?php echo $all; ?></td>
												<td>
												<span title='Pending' <?php if ($data['pendingOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
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
				
											</tr>
											<?php
												$no++;
											}
											?>
											<?php
											echo"</td><tr/></table>";	

							echo"</div>
						</div>
						<div class='tab-pane fade' id='jual'>
						<div class='panel b-a'>			
								<div class='panel-heading b-b b-light'>
									<span class='font-bold'><i class='fa fa-exchange m-r-xs'></i>History Penjualan</span>
								</div>";
									$sql=mysql_query("SELECT *
													FROM products A LEFT JOIN
													members B ON A.memberID=B.memberID LEFT JOIN
													categories C ON A.categoryID=C.categoryID LEFT JOIN
													orders_detail D ON A.productID=D.productID LEFT JOIN
													orders E ON E.orderID=D.orderID LEFT JOIN
													cities F ON B.cityID=F.cityID
													WHERE  A.memberID='$_SESSION[useri]' 
													ORDER BY A.productName");										
									$no = 1;		
									$cek1 = mysql_num_rows($sql);	
								
								echo"<table class='table table-striped m-b-none'>
									<thead class='panel-heading b-b b-light'>
									<tr>
										<th>No</th>											
										<th>Produk</th>";

										if($r['orderID'] =='' OR $r['paidOrder'] = 1 OR $r['sendOrder'] = 1 OR $cek1 == 0){
											echo"<th>Transaksi</th>";
											echo"<th>No.Tagihan</th>";
											echo"<th>Tgl</th>";
											echo"<th>Pembeli</th>";
											echo"<th>Qty</th>";
											echo"<th>Harga</th>";
											echo"<th>Total</th>";
										}

										echo"<th>Status</th>
										</tr></thead><tbody>";

									while($r = mysql_fetch_array($sql)){
									$harga  = format_rupiah($r['salePrice']);	
									$dibeli = $r['quantity'] + $r['qty'];
									$terjual = $r['sold']-1;
									$tanggal=tgl_indo($r['dateOrder']);
									$disc        = ($r['discount']/100)*$r['salePrice'];
									$hargadisc   = number_format(($r['salePrice']-$disc),0,",",".");
									$subtotal    = ($r['salePrice']-$disc) * $r['quantity'];
									$total       = $total + $subtotal;  
									$subtotal_rp = format_rupiah($subtotal);
									$total_rp    = format_rupiah($total);
									$harga       = format_rupiah($r['salePrice']);	
									$all		 = format_rupiah($r['totalOrder']);
									if($r['dibaca']=='N' OR $r['orderID']!=''){
									echo "<tr><td><b>$no</b></td>"; 
							

										
										
												echo"<td>$r[productName]</td>";
												?>	
										
												
											<td>
											<span title='pending' <?php if ($r['pendingOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
												else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="fa fa-hourglass-half fa-stack-1x fa-inverse"></i></span>
											
											<!--<span title='dibayar' <?php if ($r['paidOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
																else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="fa fa-money fa-stack-1x fa-inverse"></i></span>-->

											<span title='dikirim' <?php if ($r['sendOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
																else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="fa fa-truck fa-stack-1x fa-inverse"></i></span>
												
											<span title='diterima' <?php if ($r['acceptOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
																else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="ion-android-done-all fa-stack-1x fa-inverse"></i></span>
											</td>
										<?php
										if($r['pendingOrder'] == 1){
											echo"<td><b><font color='c30f42'>#$r[invoice]</font></b></td>";	
											echo"<td><b>$r[dateOrder]</b></td>";
											echo"<td><b>$r[customerName]</b></td>";
											echo"<td><b>$r[quantity]</b></td>";
											echo"<td><b>Rp. $harga</b></td>";
											echo"<td><b>Rp. $all</b></td>";
										}
										?>										
										<?php	
											//if($r['statusOrder']=='Dibayar'){
											//	echo"<td><span class='label label-danger'>
												//<a class='icon-trues' href='send-transaction-1-$r[orderID].html'> Kirim Barang</a></span></td>";
											//}
											if($r['statusOrder']=='Pending'){
												//echo"<td><span class='label label-warning'><i class='ion-alert-circled'></i> Pending</td>";
												echo"<td><span class='label label-danger'>
												<a class='icon-trues' href='send-transaction-1-$r[orderID].html'> Kirim Barang</a></span></td>";
											}		
											elseif($r['statusOrder']=='Dikirim'){
												echo"<td><span class='label label-success'>Dikirim</td>";
											}
											elseif($r['statusOrder']=='Diterima'){
												echo"<td><span class='label label-success'><i class='ion-android-done'></i> Selesai</td>";
											}		
											echo"</tr>";
											
									}
									else{
									//echo "<tr><td>$no</td>									  
											//<td>$r[productName]</td>";
					
										  if($r['paidOrder'] == 1 OR $r['sendOrder']==1){
										?>
											<td>
											<span title='pending' <?php if ($r['pendingOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
												else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="fa fa-hourglass-half fa-stack-1x fa-inverse"></i></span>
											
											<span title='dibayar' <?php if ($r['paidOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
																else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="fa fa-money fa-stack-1x fa-inverse"></i></span>

											<span title='dikirim' <?php if ($r['sendOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
																else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="fa fa-truck fa-stack-1x fa-inverse"></i></span>
												
											<span title='diterima' <?php if ($r['acceptOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
																else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
												<i class="ion-android-done-all fa-stack-1x fa-inverse"></i></span>
											</td>
										<?php
											echo"<td><font color='c30f42'>#$r[invoice]</font></td>";
											echo"<td>$r[dateOrder]</td>";
											echo"<td>$r[customerName]</td>";
											echo"<td>$r[quantity]</td>";
											echo"<td>Rp. $all</td>";
										  }	
										  ?>	
	
										<?php	
											if($r['statusOrder']=='Dibayar'){
												echo"<td><span class='label label-danger'>
													<a class='icon-trues' href='send-transaction-1-$r[orderID].html'><i class='ion-android-share'></i> Kirim Barang</a></span></td>";
											}
											elseif($r['statusOrder']=='Pending'){
												echo"<td><span class='label label-warning'><i class='ion-alert-circled'></i>Pending</td>";
											}		
											elseif($r['statusOrder']=='Dikirim'){
												echo"<td><span class='label label-success'>Dikirim</td>";
											}
											elseif($r['statusOrder']=='Diterima'){
												echo"<td><span class='label label-success'>Selesai</td>";
											}		
											echo"</tr>";										
										
									}
									
									
									
											$no++;
										}	
									echo "</table>";
	?>




		
		<?php
										echo"</div>
									</div>

									
									</div>
									

									</div>
									</div>";	

?>														
				
						</div>
					</div>
					
			</div>
		</div>
	</div>
