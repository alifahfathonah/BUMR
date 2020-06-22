<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
</div>

<div class="container m-t-lg">
					<div class="col-sm-9">
                        <div class="row row-sm">
							<?php
							$queryS="SELECT * FROM sub_categories WHERE categoryID = '$_GET[id]' ORDER BY subCategoryID ASC";
							$sqlS = mysql_query($queryS);
							$r=mysql_fetch_array($sqlS);
							$queryP="SELECT * FROM products A LEFT JOIN
										sub_categories B ON A.subCategoryID=B.subCategoryID LEFT JOIN
										categories C ON A.categoryID=C.categoryID
										WHERE  A.discount!='0'
										ORDER BY A.productID";
							$sqlP=mysql_query($queryP);
							$cek = mysql_num_rows($sqlP);
							while($r=mysql_fetch_array($sqlP)){
								$content_slide = strip_tags($r['description']); 
								$content_s = substr($content_slide,0,90); 
								$content_s = substr($content_s,0,strrpos($content_slide," "));
								$price = format_rupiah($r['salePrice']);
								include "disc.php";
								if($cek !=''){
									echo"
									<div class='col-md-4 col-sm-5'>
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
													<a class='text-sm' href='product-$r[productID]-$r[subCategoryID]-$r[productSeo].html'>$r[subCategoryName] <i class='ion-ios-arrow-right'></i> $r[productName] </a>
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
								else{
									echo"<div class='alert alert-info'>
											<a href='#' class='close' data-dismiss='alert'>&times;</a>
											<strong><i class='ion-close-round'></i> Produk masih kosong</strong></div>";									
								}
							}
							
							
							?>

							
						</div>
					</div>
</div>