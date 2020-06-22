
<?php
if ($_SESSION['email'] != ''){

$queryProfile="SELECT * FROM members A LEFT JOIN
			provinces B ON A.provinceID=B.provinceID LEFT JOIN
			cities C ON A.cityID=C.cityID LEFT JOIN
			shipping D ON A.shippingID=D.shippingID LEFT JOIN
			courier E ON D.courierID=E.courierID LEFT JOIN
			bank F ON A.bankID=F.bankID
		WHERE A.memberID = '$_SESSION[useri]'
		ORDER BY A.memberID";
$sqlProfile = mysql_query($queryProfile);
$r=mysql_fetch_array($sqlProfile);
$login = date('Y-m-d H:i:s');
		
?>	<div id="content" class="main-content bg-light">
			<div class="bg-black text-white b-b" style="background:url(images/1a.jpg) center center; background-size:cover;background-color: #263845;">
				<div class="bg-gd-dk">
					<div class="container h-md pos-rlt">
						<div class="h-md">
							<div class=" wrapper align-bottom">
								<div>
								<?php
								if($r['photo'] != '' ){
									echo"<img class='pull-left thumb-xl avatar m-r-md' src='upload/member/$r[photo]'>";
								}
								else {
									echo"<img class='pull-left thumb-xl avatar m-r-md' src='images/fb.jpg'>";
								}
								?>
								</div>
								<div class="pull-left">
									<div class="align-bottom m-b-xs w-xxl">
										<span class="h1 text-shadow-sm" itemprop="name"><?php echo $r['memberName']; ?></span>
											<span class="h4 text-info-lter font-bold text-shadow-sm m-l-xs "><?php echo $r['email']; ?></span>
										<p></p>
									</div>
								</div>
							</div>
							<div class="wrapper align-bottom" style="right: 0px;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="container m-t-md">
				<div class="row">
					<div class="col-sm-3 hidden-xs hidden-sm">
						<div class="panel panel-default b-a">
							<div class="panel-heading ">
								<span class="font-bold"><i class='ion-gear-b'></i> Menu Setting</span>
							</div>
							<div class="panel-body link-info">
								<ul class="nav nav-pills nav-stacked nav-sm text-black">
									<li class="dropdown">
										<a href="profile-member.html">Profile </a>
									</li><li class="divider"></li>								
									<li class="dropdown">
										<a href="password.html">Password </a>
									</li><li class="divider"></li>
									<li class="dropdown">
										<a href="ekspedisi.html">Ekspedisi</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-9">	
						<ul class='nav nav-tabs'>
							<li class='active'><a href='#view' data-toggle='tab' class='text-sm'>Jasa Ekspedisi</a></li>								
						</ul>		

					
						<div id='myTabContent' class='tab-content'>		
							<div class='tab-pane active in' id='view'>
								<div class="panel-body link-info">								
										<?php
										$full_url = full_url();
										if (strpos($full_url, "?suc=ok") == TRUE){
											echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
													<strong><i class='fa fa-check'></i> Sukses!</strong> Kurir berhasil diupdate
												</div>";
										}
										?>									
										<div class='col-sm-12 link-info'>
										<?php
										echo "<table class='table'>
													<thead><tr>
													<th>#</th>	
													<th>Provinsi</th>
													<th>Kota </th>
													<th>Ekspedisi</th>
													<th>Aksi</th><tbody>
											  </tr>"; 
										  $p      = new Paging3;
										  $batas  = 8;
										  $posisi = $p->cariPosisi($batas);
												 
										$queryCost = "SELECT B.cityID, B.cityName, A.provinceName, A.provinceID
														FROM provinces A INNER JOIN 
															 cities B ON A.provinceID = B.provinceID
															 WHERE A.status = 'Y' AND B.status = 'Y' 
														ORDER BY A.provinceName, B.cityName DESC LIMIT $posisi,$batas";
										$sqlCost = mysql_query($queryCost);
										$numsCost = mysql_num_rows($sqlCost);
										$no = $posisi+1;
										while ($dtCost = mysql_fetch_array($sqlCost))
										{
										?>
										   <tr><td class='data' width='30px'><?php echo $no; ?></td>
												 <td><?php echo $dtCost['provinceName']; ?></td>
												 <td><?php echo $dtCost['cityName']; ?></td>	
												 <td>
												<?php
												$queryShippingCost = "SELECT B.courierName 
																	 FROM shipping A INNER JOIN 
																	 courier B ON A.courierID = B.courierID 
																	 WHERE A.provinceID = '$dtCost[provinceID]' 
																	 AND A.cityID = '$dtCost[cityID]'";
												$sqlShippingCost = mysql_query($queryShippingCost);
												while ($dtShippingCost = mysql_fetch_array($sqlShippingCost))
												{			
												?>
												<?php echo $dtShippingCost['courierName']; ?>,
												 
												<?php } ?>
												 <td>
												 <?php
													echo"<a href='ekspedisi-view.php?module=ekspedisi-view&act=viewongkir&provinceID=$dtCost[provinceID]&cityID=$dtCost[cityID]'>
													<i class='ion-ios-search'></i> Detail</a>";
												?>
												 </td>
											</tr>
										<?php
											$no++;
										}

										echo "</tbody></table>";		
									  $jmldata  = mysql_num_rows(mysql_query("SELECT * FROM provinces A 
																				INNER JOIN cities B ON A.provinceID = B.provinceID WHERE A.status = 'Y' AND B.status = 'Y'"));
									  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
									  $linkHalaman = $p->navHalaman($_GET[halprofile], $jmlhalaman);
									  echo "<div class='pagination'><div class='links'>Halaman : $linkHalaman </div></div>";									  
										?>

										</div>									
								</div>
							</div>								

						
						</div>


					</div>

				</div>
			</div>

		</div>	

		
<?php 
}
else{
	header("Location: sign-in.html?err=log");
}

?>