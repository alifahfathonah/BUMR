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
$sql=mysql_query("SELECT * FROM products A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					orders_detail C ON A.productID=C.productID LEFT JOIN
					orders D ON D.orderID=C.orderID  LEFT JOIN
					withdraw E ON A.memberID=E.memberID
					WHERE  A.memberID='$_SESSION[useri]' AND totalPaid!='' AND acceptOrder=1 
					ORDER BY A.productName");	

$s=mysql_fetch_array($sql);

echo"<div id='content' class='main-content bg-lights'>
		<div class='container'><div class='m-t-md'></div>	
			<div class='row'>
					<div class='col-sm-12'>
						<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong><i class='ion-alert-circled'></i> Pencairan dana hanya dilakukan dalam sekali saja, cairkan dana anda sekarang juga!</strong>
						</div>";
						if ($s['statusDraw'] =='Selesai'){
							echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong><i class='ion-checkmark-circled'></i> Dana telah masuk dalam rekening anda, silahkan dicek rekening anda</strong>
							</div>";
						}							
						echo"<ul class='nav nav-tabs'>
							<li class='active'><a href='#dompet' data-toggle='tab' class='text-sm'>BukaDompet</a></li>
							<li><a href='#deposit' data-toggle='tab' class='text-sm'>ListSaldo</a></li>			  					
						</ul>		
						<div id='myTabContent' class='tab-content'>	
						<div class='tab-pane active in' id='dompet'>						
							<div class='panel b-a'>
	
								<table class='table table-striped m-b-none'>
									<thead class='panel-heading b-b b-light'>
										<tr>
											<th>#</th>	
											<th>No. Transaksi</th>
											<th>Tgl Transaksi</th>
						
											<th>BukaDompet</th>
											<th>Mutasi</th>
											<th>Sisa</th>
											<th></th>";

										echo"</tr></thead><tbody>";	
											$query=mysql_query("SELECT * 
																FROM withdraw A LEFT JOIN
																orders B ON A.orderID=B.orderID LEFT JOIN
																products C ON C.productID=B.productID LEFT JOIN
																members D ON C.memberID=D.memberID
																WHERE A.customerID!='$_SESSION[useri]'
																ORDER BY A.withdrawID");	

											$no =1;											
											while($data = mysql_fetch_array($query)){
												$tanggal=tgl_indo($data['dateCreate']); 
												$all = format_rupiah($data['incomeDraw']);
												$tot=format_rupiah($data['tagDraw']);
												$sisa=format_rupiah($data['incomeDraw']-$data['tagDraw']);
											
											?>
											<tr>
												<td><?php echo $no;?></td>			
												<td><font color='c30f42'>#<?php echo $data['tagihanID']; ?></font></td>
												<td> <?php echo $tanggal; ?></td>

												
												<td><font color='c30f42'>Rp. <?php echo $all; ?>,-</font></td>
												<td><font color='2cb02f'>Rp. <?php echo $tot; ?>,-</font></td>
												<td><font color='2cb02f'>Rp. <?php echo $sisa; ?>,-</font></td>
												<?php
												if($data['statusDraw'] == 'Masuk'){
												echo"<td>
														<span class='label label-danger'>
														<a class='icon-trues' href='pencairan-2-$data[withdrawID].html'>Cairkan Dana</a>
														</span></td>";
												}
												if($data['tagDraw'] !=''){
														echo"<td><span class='label label-danger'>
														<a class='icon-trues' href='detail-dana-1-$data[withdrawID].html'>Rincian</a></span>";
												}
												echo"</td>";
												
												?>
	
											</tr>
											
											<?php
												$no++;
											}
											?>
											<?php
											echo"</table>";	
											

							echo"</div>
						</div>
									
						<div class='tab-pane fade' id='deposit'>
						<div class='panel b-a'>";
									$sql=mysql_query("SELECT * FROM balance_order A LEFT JOIN
														members B ON A.memberID=B.memberID LEFT JOIN
														balance C ON A.balanceID=C.balanceID
													WHERE B.memberID='$_SESSION[useri]' AND A.finish=1
													ORDER BY A.balanceOrderID");										
									$no = 1;									
								echo"<table class='table table-striped m-b-none'>
									<thead class='panel-heading b-b b-light'>
									<tr>
										<th>#</th>	
										<th>ID Transaksi</th>	
										<th>Tgl Transaksi</th>
										<th>Deposit</th>
										<th>Aksi</th>
										</tr></thead><tbody>";
									while($r = mysql_fetch_array($sql)){
										$d +=$r['total1'];
										$tanggal1=tgl_indo($r['dateCreate']); 
										
										$g=format_rupiah($r['balanceValue']);
										if($r['finish'] == 1){
											$war="Valid";
										}
									echo "<tr><td>$no</td>
											<td>$r[orderInvoice]</td>
											<td>$tanggal1</td>
											<td>$g</td>
											<td><span class='label label-success'><i class='ion-android-done'></i> $war</span></td>";				
											$no++;
										}	
									echo "</tr>
									
									</table>
									<div class='panel-heading b-b b-light'>
										<a href='add-balance.html' class='btn btn-black font-bold btn-sm w-full'>
										Tambah Deposit</a>
									</div>	";
									
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
