
<?php

$sql = mysql_query ("SELECT * FROM members A LEFT JOIN
					products B ON A.memberID=B.memberID
					WHERE B.productID='$_GET[id]'
					ORDER BY A.memberID");
					
$t=mysql_fetch_array($sql);
$login = date('Y-m-d H:i:s');
	if ($t['kelamin'] == 'L'){
		$checka = 'checked';
	}
	elseif($t['kelamin'] == 'P'){
		$checkb = 'checked';
	}
	else{
		$checka = '';
		$checkb = '';
	}
?>	
		<div id="content" class="main-content bg-light">
			<div class="bg-black text-white b-b " style="background:url(static/img/1a.jpg) center center; background-size:cover;background-color: #263845;">
				<div class="bg-gd-dk">
					<div class="container h-md pos-rlt">
						<div class="h-md">
							<div class=" wrapper align-bottom">
								<div>
								
								<?php
								if($t['photo'] != '' ){
									echo"<img class='pull-left thumb-xl avatar m-r-md' src='upload/member/$t[photo]'>";
								}
								else {
									echo"<img class='pull-left thumb-xl avatar m-r-md' src='static/img/fb.jpg'>";
								}
								?>

								</div>
								<div class="pull-left">
									<div class="align-bottom m-b-xs w-xxl">
										<span class="h1 text-shadow-sm" itemprop="name"><?php echo $t['memberName']; ?></span>
											<span class="h4 text-info-lter font-bold text-shadow-sm m-l-xs "><?php echo $t['email']; ?></span>
										<p></p>
									</div>
								</div>
							</div>
							<div class="wrapper align-bottom " style="right: 0px;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="container m-t-md">
				<div class="row">
					<div class="col-sm-3 link-info">
						<div class="panel b-a">
							<div class="panel-heading b-b b-light">
								<span class="font-bold"><i class="ion-person m-r-xs"></i>Tentang saya</span>
							</div>
							<div class="panel-body"><?php echo $t['email']; ?></div>
						</div>
						<div class="panel b-a">
							<div class="panel-heading b-b b-light">
								<span class="font-bold"><i class="ion-gear-b m-r-xs"></i> Info</span>
							</div>
							<div class="wrapper">
								<div class="row">
									<div class="col-sm-6">Alamat:</div>
									<div class="col-sm-6"><?php echo $t['address']; ?></div>
								</div>

								<div class="row">
									<div class="col-sm-6">Telp</div>
									<div class="col-sm-6"><?php echo $t['phone']; ?></div>
								</div>
								<div class="row">
									<div class="col-sm-6">Update :</div>
									<div class="col-sm-6"><?php echo $login; ?></div>
								</div>
							</div>
						</div>

					</div>
					
					<?php
					$p      = new Paging3;
					$batas  = 6;
					$posisi = $p->cariPosisi($batas);					
					$sql = mysql_query("SELECT * FROM products A LEFT JOIN
													members B ON A.memberID=B.memberID
													WHERE A.productID='$_GET[id]'
										ORDER BY A.productID DESC LIMIT $posisi,$batas ");		 
					$jumlah = mysql_num_rows($sql);	
					if ($jumlah > 0){
						while ($r=mysql_fetch_array($sql)){
							$content_slide = strip_tags($r['description']);  
							$content_s = substr($content_slide,0,100); 
							$content_s = substr($content_s,0,strrpos($content_slide," "));					
							include "disc.php";							
					echo"<div class='col-md-3 col-sm-4'>
							<div class='item-panel panel b-a'>
								<div class='item m-l-n-xxs m-r-n-xxs'>
									<div class='pos-rlt'>
										<div class='ribbon ribbon-success'>
											<span>Baru</span>
										</div>
										<a href='product-$r[productID]-$r[productSeo].html'>
										<img src='upload/produk/$r[photo1]' width='640px' height='150px' class='img-full'></a>
									</div>
								</div>
								<div class='row no-gutter '>
									<div class='m-l-sm m-b-xs m-r-sm m-t-xs font-bold'>
										<a class='text-sm' href='product-$r[productID]-$r[productSeo].html'>$r[productName] </a>
									</div>
								</div>	
								<div class='row no-gutter item-listing-desc'>
									<div class='m-l-sm m-b-xs m-r-sm m-t-xs'>
										$content_s
									</div>
								</div>
								<div class='row no-gutter item-listing-extra'>
									<div class='m-l-sm m-b-sm pull-left'>
										<a href='product-$r[productID]-$r[productSeo].html' rel='nofollow'  alt='beli' data-toggle='tooltip' data-placement='top' class='btn btn-sm btn-icon btn-default' >
										<i alt='beli' class='fa fa-eye'></i></a>
									</div>

									<div class='m-b-sm m-r-sm m-t-sm pull-right font-bold  text-lg'>
										<a href='#' class='btn btn-success m-t-n-md '><del></del> $divharga</a>
				      				</div>		
									
								</div>
								
							</div>
						</div>";
					}
					?>	
				</div>
				<?php
				  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM products"));
				  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);				
				  echo "<div class='text-right m-b-sm'>
						<ul class='pagination pagination-md'>
							<li><a href='#'>Halaman : $linkHalaman </a></li>
						</ul></div>";				
				}
			else{
				echo "<p align=center>Belum ada produk pada kategori ini.</p>";
			}				
				?>
			</div>

		</div>	