<div id="liveRequestResults"></div>	
<div id='mainResult'>	
<?php
/*
if($_SESSION['email'] != ''){
	$queryProfile="SELECT * FROM members A LEFT JOIN
				provinces B ON A.provinceID=B.provinceID LEFT JOIN
				cities C ON A.cityID=C.cityID LEFT JOIN
				shipping D ON A.shippingID=D.shippingID LEFT JOIN
				courier E ON D.courierID=E.courierID
			WHERE A.memberID = '$_SESSION[useri]'
			ORDER BY A.memberID";
	$sqlProfile = mysql_query($queryProfile);
	$r=mysql_fetch_array($sqlProfile);
	echo"<div class='row'>
			<div class='col-lg-12'>";
			if($r['cityID'] == ''){
				echo"<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong><i class='ion-alert-circled'></i> PROFILE BELUM DIUPDATE</strong>, 
							Silahkan update profile anda sebelum bertransaksi ! <a href='profile.html'>
							<span class='label label-success'>Klik disini</span></a></div>";
			}
	echo"</div></div>";
}
*/
?>
<div class="container">
	<div class="info-boxes wow fadeInUp">
		<div class="info-boxes-inner">
			<div class="row">
				<div class="col-md-6 col-sm-4 col-lg-4">
					<div class="info-box">
						<div class="row">
							<div class="col-xs-12">
								<h4><img src="images/save.png"></h4>
								<h4 class="info-box-heading green">Jaminan 100% Aman</h4>
							</div>
						</div>
						<h6 class="text">Payment system menjamin keamanan uang Anda dalam bertransaksi.</h6>
					</div>
				</div>
				<div class="hidden-md col-sm-4 col-lg-4">
					<div class="info-box">
						<div class="row">
							<div class="col-xs-12">
								<h4><img src="images/cart.png"></h4>
								<h4 class="info-box-heading green">Kemudahan Berbelanja</h4>
							</div>
						</div>
						<h6 class="text">Kemudahan dalam bertransaksi jadi semakin nyaman berbelanja</h6>
					</div>
				</div>
				<div class="col-md-6 col-sm-4 col-lg-4">
					<div class="info-box">
						<div class="row">
							<div class="col-xs-12">
								<h4><img src="images/courier.png"></h4>
								<h4 class="info-box-heading green">Bebas Penipuan</h4>
							</div>
						</div>
						<h6 class="text">Berbelanja tanpa khawatir akan penipuan</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="headline centered "></h3>
		</div>
	</div>

	<div class="row">

		<!-- Projects -->
		<div class="col-md-12 projects latest">
			<div class="owl-carousel">
				<?php
				$sql=mysql_query("SELECT * FROM header ORDER BY id_header");
				while($r=mysql_fetch_array($sql)){
					echo"<div class='item'>
						<a href='#'>
							<img src='upload/header/$r[icon]' alt='' />
							<div class='overlay'>
								<div class='overlay-content'>
									<h4>$r[judul]</h4>
									<span>$r[createDate]</span>
								</div>
							</div>
							<div class='plus-icon'></div>
						</a>
					</div>";
				}

				?>


				
			</div>


		</div>

	</div>

</div>




		<div class="b-q bg-light lter">

			<div class="container">
				<div class="">
					<div class="wrapper"></div>
				</div>
				<div class="row row-sm">
					<?php
			            $kategori=mysql_query("SELECT A.categoryName, A.categoryID, A.icons,A.categorySeo, A.title
                                  FROM categories A LEFT JOIN
								  products B ON A.categoryID=B.categoryID 
                                  GROUP BY A.categoryName");
						while($r=mysql_fetch_array($kategori)){

						echo"<div class='col-md-3 col-sm-6'>
							<div class=' panel b-a'>
							<div class='clearfix '>
								<a href='#' class='pull-left m-l-sm m-t-sm m-r-sm thumb-md'>
								<img width='30px' src='upload/kategori/$r[icons]'></a>
								<div class='clear'>
									<div class='m-r-xs text-md font-bold'>
										<a href='category-$r[categoryID]-1-1-1-0-0-0-$r[categorySeo].html'>
										<h2 class='text-md font-bold m-t-sm text-ellipsis'>$r[categoryName]  </h2></a>
									</div>



								</div>
							</div>
						</div>
						</div>";
						}
					?>					
				</div>
							
			</div>
		</div>

			<div class="container  m-t-lg">
				<div class="row">
					<!--<div class="wrapper">
						<h3 class=" m-t-none font-thin">Produk Terbaru</span> 
						<a class="text-sm pull-right m-t-sm font-normal" href="#">Lihat semua</a></span>
					</div>-->
					<div class="col-md-12" ><h3 class="headline centered with-border margin-bottom-30"><center>Produk Terbaru</center><span></span></div>
				</div>
				
				<div class="row row-sm">
				<?php
				$queryR=mysql_query("SELECT * FROM products A LEFT JOIN				
									sub_categories B ON A.subCategoryID=B.subCategoryID LEFT JOIN	
									categories C ON A.categoryID=C.categoryID
									ORDER BY A.productID DESC LIMIT 4");
				while($r=mysql_fetch_array($queryR)){
				$content_slide = strip_tags($r['description']); 
				$content_s = substr($content_slide,0,90); 
				$content_s = substr($content_s,0,strrpos($content_slide," "));
				include "disc.php";				
									echo"
									<div class='col-md-3 col-sm-6'>
										<div class='item-panel panel b-a'>
										   <div class='item m-l-n-xxs m-r-n-xxs'>
												<div class='pos-rlt'>
													<div class='ribbon ribbon-success'><span>NEW</span>
													</div>
													<a href='#'>
														<img alt='#' src='upload/produk/$r[photo1]' width='600px' height='150px'  class='img-full'>
													</a>
												</div>
											</div>
											<div class='row no-gutter '>
												<div class='m-l-sm m-b-xs m-r-sm m-t-xs font-bold'>
													<a class='text-sm' href='product-$r[productID]-$r[subCategoryID]-$r[productSeo].html'> $r[productName] </a>
												</div>
											</div>
											<div class='row no-gutter item-listing-desc '>
												<div class='m-l-sm m-b-xs m-r-sm m-t-xs '>
													$content_s
												</div>
											</div>
											<div class='row no-gutter item-listing-extra'>
												<div class='m-l-sm m-b-sm pull-left'>
													<a rel='nofollow' href='product-$r[productID]-$r[subCategoryID]-$r[productSeo].html' data-toggle='tooltip' data-placement='top' title='Detail' class='btn btn-sm btn-icon btn-default'>
														<i class='fa fa-desktop'></i>
													</a>
													$tombol
												</div>
												<div class='m-b-sm m-r-sm m-t-sm pull-right font-bold  text-lg'>
													<a href='#' class='btn btn-black m-t-n-md '><del></del> $divharga</a>
												</div>
											</div>
										</div>
									</div>";
				}
				?>
				</div>
		</div>
		
	<!--<div class="b-q bg-light lter">-->
	<div class="col-md-12" ><h3 class="headline centered with-border margin-bottom-30"><center>Kantor Badan Usaha Milik Rakyat</center><span></span></div>
			
<div class="peta-responsive">
	<center><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1986.9487593911124!2d97.15669797573088!3d5.120213335775574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304783c1fafe4577%3A0xa9bd7ec6a7f6244b!2sPoliteknik+Negeri+Lhokseumawe!5e0!3m2!1sid!2sid!4v1527775489091" width="1300" height="260" frameborder="0" style="border:0" allowfullscreen></iframe></center>
</div>		
	</div>		
	</div>
<!--<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="headline centered with-border margin-bottom-30">Brand Resmi</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			
			Carousel 
			<div class="logo-carousel">
			    <div class="item"><img src="images/logo-02.png" alt="" /></div>
			    <div class="item"><img src="images/logo-03.png" alt="" /></div>
			    <div class="item"><img src="images/logo-04.png" alt="" /></div>
			    <div class="item"><img src="images/logo-05.png" alt="" /></div>
			    <div class="item"><img src="images/logo-06.png" alt="" /></div>
			    <div class="item"><img src="images/logo-07.png" alt="" /></div>
			</div>

		</div>
	</div>
</div>
</div>-->
<script>liveReqInit('livesearch','liveRequestResults','search.php','','mainResult');</script>