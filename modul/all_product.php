<?php
$aksi="modul/action_favorite.php";
$com="modul/action_compare.php";
$queryHits = "UPDATE products SET hits=hits+1 WHERE productID = '$_GET[id]'";
mysql_query($queryHits);

$queryProduct = " SELECT A.photo1,A.photo2,A.photo3,A.photo4,A.photo5,A.photo6,A.productName,A.productCode,A.productSeo,B.subCategoryID,A.weight,
					B.subCategoryName,C.categoryName,C.categoryID,A.hits,A.createDate,A.salePrice,
					A.conditions,A.description,A.qty,A.weight,A.productID,A.createDate,A.discount,A.conditions,
					D.memberID,D.memberName,D.username,D.email,D.photo
					FROM products A LEFT JOIN
					sub_categories B ON A.subCategoryID = B.subCategoryID LEFT JOIN
					categories C ON A.categoryID = C.categoryID LEFT JOIN
					members D ON A.memberID=D.memberID
					WHERE A.productID = '$_GET[id]'
					ORDER BY A.productID";
$no=1;	
$sqlProduct = mysql_query($queryProduct);					
$r = mysql_fetch_array($sqlProduct);	
$ago = time_since(strtotime($r['createDate']));	
$member_user = $r['username'];
include "disc.php";	
if($r['conditions'] == '1'){
	$kondisi = "Baru";
}
else{ 
	$kondisi = "Bekas";
}
?>

<div class="bg-light lter b-b wrapper">
	<div class="container m-b-xs">
		<div>
				<div class="row">
					<div class="col-sm-8">
							<div>
								<img class="pull-left thumb-lg m-r-md img-rounded" src="upload/produk/<?php echo $r['photo1']; ?>" width='640px' height='50px'>
							</div>
							<div>
								<h1 class="h2"><?php echo $r['productName']; ?></h1>
								 Kondisi : <span class="label label-danger"><?php echo $kondisi;?></span> |
								 ID Produk : <?php echo $r['productCode'];?> |
								<?php
								$t=mysql_fetch_array(mysql_query("SELECT count(productID) as total FROM favorite
													WHERE productID='$_GET[id]' ORDER BY favoriteID"));
									echo"<span temprop='description' class='text-sm'><i class='ion-heart'></i>  $t[total] </span>";						
								?>
								 
							</div>	
					</div>
					<div class="col-sm-4">
							<div class="col-sm-5 text-md">
								<div class="row text-sm">
									<i class="fa fa-calendar m-r-xs"></i> Tgl Iklan
								</div>
								<div class="row text-sm">
									<i class="fa fa-folder m-r-xs"></i> Kategori 
								</div>
								<div class="row text-sm">
									<i class="fa fa-eye m-r-xs"></i> Dilihat
								</div>								
							</div>
							<div class="col-sm-6 text-md">
								<div class="row text-sm">: <?php echo $ago; ?></div>
								<div class="row text-sm">
									<a href="#" class='text-sm'>: <?php echo $r['categoryName']; ?></a> / <a href="#" class='text-sm'>
									<?php echo $r['subCategoryName']; ?></a>
								</div>		
								<div class="row text-sm">: <?php echo $r['hits']; ?></div>									
							</div>

						
					</div> <div class="col-sm-4 "></div>    
				</div>
				<div class="no-gutter">
				<ul class='nav nav-tabs'>
					<li class='active'><a href='#produk' data-toggle='tab' class='text-sm'>Detail Produk</a></li>		  					
				</ul>
				</div>					
		</div>
	</div>
</div>
<div id='myTabContent' class='tab-content'>
		<div class='tab-pane active in' id='produk'>
			<div class="container m-t-md">
				<div>
					<div class="col-sm-8 link-info">

						<div class="panel b-a">
							<div class="item m-l-n-xxs m-r-n-xxs">
								<img src="upload/produk/<?php echo $r['photo1']; ?>" width='640px' height='450px' class="img-full">
							</div>
						</div>
						<div class="row m-t-md">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading font-bold ">
										<h3 class="h4 font-bold">Screenshots</h3>
									</div>
									<div class="">
										<div class="panel-body row row-sm clear ">
											<div class="col-xs-2 ">
												<div class="item b-a bg-light m-t-sm m-b-sm lter">
													<div class="screenshot-box ">
														<a rel="nofollow" class="lightbox" href="upload/produk/<?php echo $r['photo1']; ?>" rel="screenshots">
														<img class="screenshot-thumb" src="upload/produk/<?php echo $r['photo1']; ?>"></a>
													</div>
												</div>
											</div>
											<div class="col-xs-2 ">
												<div class="item b-a bg-light m-t-sm m-b-sm lter">
													<div class="screenshot-box ">
														<a rel="nofollow" class="lightbox" href="upload/produk/<?php echo $r['photo2']; ?>" rel="screenshots">
														<img class="screenshot-thumb" src="upload/produk/<?php echo $r['photo2']; ?>"></a>
													</div>
												</div>
											</div>		

											<div class="col-xs-2 ">
												<div class="item b-a bg-light m-t-sm m-b-sm lter">
													<div class="screenshot-box ">
														<a rel="nofollow" class="lightbox" href="upload/produk/<?php echo $r['photo3']; ?>" rel="screenshots">
														<img class="screenshot-thumb" src="upload/produk/<?php echo $r['photo3']; ?>"></a>
													</div>
												</div>
											</div>

											<div class="col-xs-2 ">
												<div class="item b-a bg-light m-t-sm m-b-sm lter">
													<div class="screenshot-box ">
														<a rel="nofollow" class="lightbox" href="upload/produk/<?php echo $r['photo4']; ?>" rel="screenshots">
														<img class="screenshot-thumb" src="upload/produk/<?php echo $r['photo4']; ?>"></a>
													</div>
												</div>
											</div>

											<div class="col-xs-2 ">
												<div class="item b-a bg-light m-t-sm m-b-sm lter">
													<div class="screenshot-box ">
														<a rel="nofollow" class="lightbox" href="upload/produk/<?php echo $r['photo5']; ?>" rel="screenshots">
														<img class="screenshot-thumb" src="upload/produk/<?php echo $r['photo5']; ?>"></a>
													</div>
												</div>
											</div>

											<div class="col-xs-2 ">
												<div class="item b-a bg-light m-t-sm m-b-sm lter">
													<div class="screenshot-box ">
														<a rel="nofollow" class="lightbox" href="upload/produk/<?php echo $r['photo6']; ?>" rel="screenshots">
														<img class="screenshot-thumb" src="upload/produk/<?php echo $r['photo6']; ?>"></a>
													</div>
												</div>
											</div>

											
										</div>
									</div>
								</div>
							</div>
						</div>						

					<!--	<a href="#" id="display-screenshots" onclick="$('.extra-screenshot').fadeToggle();$('#hide-screenshots').removeClass('hidden');$('#display-screenshots').addClass('hidden');return false;" class="btn btn-block btn-default btn-lg m-b-md">Lihat gambar lain</a>
						<a href="#" id="hide-screenshots" onclick="$('.extra-screenshot').fadeToggle();$('#hide-screenshots').addClass('hidden');$('#display-screenshots').removeClass('hidden');return false;" class="btn btn-block btn-default m-b-md btn-lg hidden">Sembunyikan</a>
						-->		
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading font-bold ">
										<h3 class="h4 font-bold">Detail</h3>           
									</div>
									<div class="panel-body item-description text-sm">
										<p> <?php echo $r['description']; ?> </p>
											</div>
								</div>
							</div>
						</div>						
					</div>
					
					<div class="col-sm-4 link-info">
						<div class="panel text-md b-a ">
							<div class="panel-body">
								<div class="clear">
									<form action="#" id="purchase-form" method="post" name="purchase-form">
										<div class="pull-right text-right font-bold">
											<span  class="m-l-xs price">
											<span class="h1 price_in_rupiah text-right-xs text-grey "><b><?php echo $divharga; ?></b></span>
											</span>
										</div>
									</div>
									<div class="clear m-t-md m-b-md text-grey">
										<i class="fa fa-check-circle text-success fa-fw"></i> 100% Jaminan Uang Kembali<br>
										<i class="fa fa-check-circle text-success fa-fw"></i> Sistem Pembayaran Bebas Penipuan<br>
									</div>
										<?php
										if ($_SESSION['useri'] != $r['memberID'] AND $_SESSION['useri'] != ''){								
										?>									
										<?php echo $button; ?>
										<!--<a class='btn btn-info btn-md btn-block' href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $member_user; ?>')">LIVE CHAT NOW</a>-->
										<?php
										$queryM="SELECT * FROM favorite WHERE memberID ='$_SESSION[useri]' AND productID ='$_GET[id]'
												ORDER BY favoriteID";
										$sqlM=mysql_query($queryM);
										$ketemu=mysql_num_rows($sqlM);
											if($ketemu != ''){
												echo"<a class='btn btn-black btn-md btn-block  font-bold' href='#' onClick=\"return confirm('Produk sudah ditambahkan di menu favorit')\">
													<i class='ion-android-favorite'></i> Favorit saya</a>";	
											}
											else{							
												echo"<a class='btn btn-default btn-md btn-block  font-bold' href='$aksi?module=favorite&act=input&id=$r[productID]'>
													<i class='ion-android-favorite-outline'></i> Favoritkan</a>";										
											}
										
										echo"<a class='btn btn-info btn-md btn-block  font-bold' href='$com?module=compare&act=input&id=$r[productID]'>
													<i class='ion-code'></i> Bandingkan</a>";	
										
										?>
										<?php } ?>
								</form>
							</div>
						</div>		
						<div class="panel b-a">
							<div class="panel-heading h-xs bg-black lter no-border wrapper-lg"></div>
							<div class="text-center m-b clearfix">
								<div class="thumb-lg avatar m-t-n-xxl">
								<?php if ($r['photo'] !=''){ ?>
									<img src='upload/member/<?php echo $r['photo']; ?>' class="b b-3x b-white"/>
								<?php } 
								else{
									echo"<img src='static/img/fb.jpg' class='b b-3x b-white'/>";
								}
								?>	
								</div>
								<div class="h3 font-thin"><?php echo $r['memberName']; ?></div>
								<div class="text-muted"><?php echo $r['email']; ?></div>
								<div class="text-muted">Tergabung: <?php echo $ago; ?></div>							
								<div class="m-t-md">
									<a href="profile-<?php echo $r['productID']; ?>-1-1-1-<?php echo $r['username']; ?>.html" class="btn btn-black">Lihat profile</a>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading font-bold">Information</div>
							<table class="table table-striped m-b-none">
							<tbody>
							<tr>
								<td>Stok Barang</td>
								<td><?php echo $r['qty']; ?></td>
							</tr>
							<tr>
								<td>Berat</td>
								<td><?php echo $r['weight']; ?></td>
							</tr>
							<tr>
								<td>Kondisi</td>
								<td><?php echo $kondisi; ?></td>
							</tr>
							<tr>
								<td>Tags</td>
								<td>
									<a href="#"><span class="m-b-xs "><?php echo $r['categoryName']; ?></span></a>,
									<a href="#"><span class="m-b-xs "><?php echo $r['subCategoryName']; ?></span></a>

								</td>
							</tr>
							</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>	
		</div>
		

		<div class='tab-pane fade' id='review'>
			<div class="container m-t-md">
				<div class="row">
					<div class="col-sm-8 link-info">
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading font-bold ">
										<h3 class="h4 font-bold">Detail</h3>           
									</div>
									<div class="panel-body item-description text-sm">
										<p>Layar: Monitor layar lebar 13,3 inci (diagonal) dengan lampu latar glossy LED dengan dukungan untuk jutaan warna Resolusi yang didukung: 1280 x 800 (asli), 1152 x 720, 1024 x 640, dan 800 x 500 piksel pada rasio aspek 16:10; 1024 x 768, 800 x 600, dan 640 x 480 piksel pada rasio aspek 4:3; 1024 x 768, 800 x 600, dan 640 x 480 piksel pada rasio aspek direnggangkan 4:3; 720 x 480 piksel pada rasio aspek 3:2; 720 x 480 piksel pada rasio aspek direnggangkan 3:2	            
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

</div>