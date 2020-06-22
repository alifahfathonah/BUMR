
<?php
if ($_GET['type'] == 1){
	$a = "SELECTED";
}
elseif ($_GET['type'] == 2){
	$b = "SELECTED";
}
elseif ($_GET['type'] == 3){
	$c = "SELECTED";
}
elseif ($_GET['type'] == 4){
	$d = "SELECTED";
}
elseif ($_GET['type'] == 5){
	$e = "SELECTED";
}
elseif ($_GET['type'] == 6){
	$f = "SELECTED";
}
else{
	$a = "";
	$b = "";
	$c = "";
	$d = "";
	$e = "";
	$f = "";
}

$full_url = full_url();
$q = explode("?q=", $full_url);

if ($q[1] != ''){
	$k = "?q=".$q[1];
}
else{
	$k = "";
}

if ($_GET['verified'] == 0){
	$v1 = "SELECTED"; 
}
elseif ($_GET['verified'] == 1){
	$v2 = "SELECTED"; 
}
elseif ($_GET['verified'] == 2){
	$v3 = "SELECTED"; 
}
else{
	$v1 = "";
	$v2 = "";
	$v3 = "";
}
?>
            <div class="b-b bg-light lter">
                <div class="container m-b-sm p-t-sm ">
                    <div class="row">
					<?php
						$queryF = "SELECT * FROM categories WHERE categoryID = '$_GET[id]'";
						$sqlF= mysql_query($queryF);
						$name=mysql_fetch_array($sqlF);
						
					
					?>
                        <div class="col-md-7">
                            <h1 class="font-thin h2 m-t-md m-b-sm">
							<img class="thumb-xs m-r-md m-b-xs" src="images/product.png">Semua Produk <?php echo $name['categoryName'];?></h1>
                            <p class="text-black font-thin m-b-sm"><?php echo $name['title'];?></p>
                        </div>
                        <div class="col-sm-5  visible-lg visible-md">

                        </div>
                    </div>
                </div>
            </div>
            <div class="container m-t-lg">
                <div class="row">
                    <div class="col-sm-3 m-b-lg">
					<div class="panel b-a ">	
					
					<div class="panel-heading bg-white b-b b-light font-bold ">Kategori Produk </div>
					<div class="list-group no-radius alt">
					<ul class="nav  nav-pills nav-stacked nav-sm text-black">
						<?php
						$nm = strtolower(str_replace(" ", "+", $_GET['nm']));
						$queryC = "SELECT * FROM categories ORDER BY categoryName ASC";
						$sqlC = mysql_query($queryC);
						while($rowC=mysql_fetch_array($sqlC)){
							$queryNum = "SELECT * FROM sub_categories WHERE categoryID = '$rowC[categoryID]'";
							$sqlNum = mysql_query($queryNum);
							$nums = mysql_num_rows($sqlNum);
							if ($nums > 0){
								echo"<li>
									<a class='list-group-item' data-toggle='collapse' href='#$rowC[categorySeo]'>$rowC[categoryName] 
									<i class='ion-android-arrow-dropdown'></i></a>
									<ul id='$rowC[categorySeo]' class='nav m-l-md nav-pills nav-stacked nav-sm'>";
								
									$sql = "SELECT * FROM sub_categories
											WHERE categoryID = '$rowC[categoryID]' ORDER BY subCategoryName ASC";
									$sql_ct=mysql_query($sql);
									
									while ($data_ct = mysql_fetch_array($sql_ct)){
										echo "<li><a class='btn-now' href='subcategory-$rowC[categoryID]-$_GET[div]-$_GET[page]-1-$_GET[verified]-$_GET[pid]-$data_ct[subCategoryID]-$nm.html'>
												<i class='ion-ios-checkmark-empty'></i> $data_ct[subCategoryName] </a></li>";				
									}
									echo "</ul></li>";
							}
							else{	
								echo "<li><a class='btn-now' href='subcategory-$rowC[categoryID]-1-1-1-$_GET[verified]-$_GET[pid]-0-$nm.html'>$rowC[categoryName]</a></li>";
							}
							
						}
						?>
					
					</ul>

					</div>
					</div>
					</div>
				



				
					<div class="col-sm-9">
                        <div class="row row-sm">
							<?php
							$queryS="SELECT * FROM sub_categories WHERE categoryID = '$_GET[id]' ORDER BY subCategoryID ASC";
							$sqlS = mysql_query($queryS);
							$r=mysql_fetch_array($sqlS);
							$queryP="SELECT * FROM products A LEFT JOIN
										sub_categories B ON A.subCategoryID=B.subCategoryID LEFT JOIN
										categories C ON A.categoryID=C.categoryID
										WHERE  A.categoryID='$_GET[id]'
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
			</div>