<?php 
error_reporting(0); 
session_start(); 
include "config/koneksi.php";
include "config/fungsi_indotgl.php"; 
include "config/class_paging.php"; 
include "config/fungsi_combobox.php"; 
include "config/library.php"; 
include "config/fungsi_autolink.php"; 
include "config/fungsi_rupiah.php"; 
include "config/fungsi_url.php"; 
include "config/fungsi_seo.php"; 
include "config/time_since.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
 
    <title>BUMR</title>
    <meta name="description" content="Pusat Jualan Online Marketstore" />
    <meta name="keywords" content="BUMR">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="Shortcut icon" href="static/icons.png" />
    <link rel="stylesheet" href="static/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="static/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="static/css/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="static/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="static/css/font.css" type="text/css" />
    <link rel="stylesheet" href="static/js/lightbox/themes/classic/jquery.lightbox.css" />
    <link rel="stylesheet" href="static/js/redactor/redactor.css" />
    <link rel="stylesheet" href="static/css/app2.css" type="text/css" />
    <link href="static/css/ionicons.min.css" media="all" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="static/js/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="static/css/style112.css" type="text/css" />
    <link rel="stylesheet" href="static/css/style111.css" type="text/css" />
    <link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
    <script type="text/javascript" src="js/chat.js"></script>
    <script type="text/javascript" src="js/jquery-1.6.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
    <script type="text/javascript" src="static/liveSearch/livesearch.js"></script>
	<style>
		#result{
			position:absolute;
			top:43px;
			left:375px;
		}
	</style>
</head>
<body>

    <header id="header" class="navbar navbar-fixed-top box-shadow" data-spy="affix" data-offset-top="1">
        <div class="bg-success">
            <div class="container">
                <div class="navbar-header ">
                    <button class="btn btn-link visible-xs pull-right m-r" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="ion-navicon fa-lg icon-true"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
					<!--Mobile-->
					<ul class="nav navbar-nav m-l-n visible-xs">
						<?php if ($_SESSION['email'] == ''){ 
						echo"<li style='padding:1px 10px 10px 20px;'>					
							<div class'm-t-sm'>
								<a rel='nofollow' href='sign-in.html' class='btn btn-black btn-sm'>Login</a>
								<a rel='nofollow' href='sign-up.html' class='btn btn-sm btn-go m-r-xs'>Daftar</a>
							</div>			
							</li>";
						}
						else{
							$sid = $_SESSION['useri'];
							$queryCart = "SELECT SUM(quantity*(salePrice-(discount/100)*salePrice))as total,SUM(quantity) as totaljumlah
											FROM carts A LEFT JOIN
												products B ON A.productID=B.productID
											WHERE A.memberID='$sid' 
											ORDER BY A.cartID";
							$sqlCart = mysql_query($queryCart);			
							while($rowCart=mysql_fetch_array($sqlCart)){
								$total_rp    = format_rupiah($rowCart['total']);
								if ($rowCart['totaljumlah'] != ''){
									echo"
										<a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='badge'>$rowCart[totaljumlah]</span>
										<i class='ion-bag fa-lg icon-true'></i></a>
										<ul class='dropdown-menu'>
										<li class='nav-notifications-header'>
											<a tabindex='-1' href='#'><strong></strong> Transaksi baru</a>
										</li>
										<li class='nav-notification-body text-info'>
											<a href='keranjang-belanja.html'><i class='ion-android-cart'></i> ($rowCart[totaljumlah]) item produk <small class='pull-right'>Rp. $total_rp</small></a>
										</li>
										</ul>
										";
								}
								else{
									echo"
									<a href='keranjang-belanja.html' class='btn btn-sm' title='barang'>
										<span class='badge'></span><i class='ion-bag fa-lg icon-true'></i></a>";				
								}
							}
							
						echo"
						
						<a rel='nofollow' href='#'  data-toggle='dropdown'  class='btn btn-sm' >
							<span class='badge'></span>
							<i class='ion-grid fa-lg icon-true'></i> <b class='caret'></b>
						</a>
						<ul class='dropdown-menu animated fadeInDown' role='menu'>	
							<li><a href='new-product.html'><span> Jual Barang</span></a></li><li class='divider'></li>	
							<li><a href='list-product.html'><span> Daftar Barang</span></a></li><li class='divider'></li>							
							<li><a href='history.html'><span> Status Transaksi</span></a></li><li class='divider'></li>	
							<li><a href='favorite.html'><span> Barang Favorit</span></a></li><li class='divider'></li>		
							<li><a href='logout.php'><span> Logout</span></a></li>
						</ul>";


						}
						?>
							
						<li class="dropdown">
							<a rel="nofollow" href="#" data-toggle="dropdown" class="dropdown-toggle"><span>Kategori</span> <span class="caret"></span></a>
							<ul class="dropdown-menu animated fadeInDown" role="menu">
								<li>
									<a href="promo.html"><span><i class='ion-ios-checkmark-outline'></i> Produk Promo</span></a>
								</li>
								<li class="divider"></li>	
						
								<?php
								$queryCat = "SELECT * FROM categories GROUP BY categoryName";
								$sqlCat = mysql_query($queryCat);
								while($rowCat=mysql_fetch_array($sqlCat)){
										echo"<li>
											<a href='category-$rowCat[categoryID]-1-1-1-0-0-0-$rowCat[categorySeo].html'>
											
											<span>$rowCat[categoryName]</span>
											</a>
										</li>";
								}
								?>
							</ul>
						</li>	
										
					</ul>
				
				
				 
                    <ul class="nav navbar-nav navbar-right">
                        <a rel="nofollow" href="#" class="btn btn-sm ">Blog</a>
                        <a href="#" class="btn btn-sm ">Kontak Kami</a>
                        <a href="#" class="btn btn-sm ">Buka Bantuan</a>
						<a href="articles-0-1-all+articles.html" class="btn btn-sm">Informasi</a>
                    </ul>
					<?php
					if ($_SESSION['email'] != ''){
					?>					
					<ul class="nav navbar-nav navbar-left m-r-xs">			
						<a class="btn btn-sm ">Selamat datang, <font color="#eec401"><?php echo $_SESSION['username']; ?> </font> </a>								
						<a href="promo.html" class="btn btn-sm "> Promo</a>		
						<a href="all-balance.html" class="btn btn-sm "> BukaSaldo</a>						
												
					</ul>						
					<?php } ?>
					
				</div>
            </div>
        </div>
		
        <div class="navbar bg-white-only visible-sm visible-md visible-lg">
            <div class="container">
                <a href="index.php" class="nav navbar-left navbar-brand m-r-n m-l-n-md"><img src="images/logo4.png">&nbsp;&nbsp;&nbsp;</a>
				
                <ul class="nav navbar-nav m-l-n">
					<li class="dropdown">
						<a rel="nofollow" href="#" data-toggle="dropdown" class="dropdown-toggle"><span>Kategori</span> <span class="caret"></span></a>
						<ul class="dropdown-menu animated fadeInDown" role="menu">
							<li>
								<a href="promo.html"><span><i class='ion-ios-checkmark-outline'></i> Produk Promo</span></a>
							</li>
							<li class="divider"></li>	
					
							<?php
							$queryCat = "SELECT * FROM categories GROUP BY categoryName";
							$sqlCat = mysql_query($queryCat);
							while($rowCat=mysql_fetch_array($sqlCat)){
									echo"<li>
										<a href='category-$rowCat[categoryID]-1-1-1-0-0-0-$rowCat[categorySeo].html'>
										
										<span>$rowCat[categoryName]</span>
										</a>
									</li>";
							}
							?>
						</ul>
					</li>

                    <li>
                        <form method="POST" action="result.php" class="navbar-form navbar-form-sm visible-xs visible-md visible-lg">
                            <div class="form-group">
                                <div class="input-group ">
                                    <input type="text" name="search" id="search" style='width: 500px;' class="form-control input-sm bg-light no-border padder" placeholder="Aku mau belanja ...">
                                    <span class="input-group-btn">
										<button type="submit" class="btn btn-sm bg-light "><i class="ion-search"></i></button>
									</span>
                                </div>
							</div>
                        </form>					

                    </li>
	<div id="result"></div>
<script type="text/javascript">
$(document).ready(function() {
 
   $("#search").keyup(function() {
		var name = $('#search').val();
		if (name == "") {
			$("#result").html("");
		}
		else {
			$.ajax({
			type: "POST",
			url: "search.php",
			data: {
				search: name
			},
			success: function(html) {
				$("#result").html(html).show();
			}
			});
		}
	});
 });


</script>
                </ul>
				<ul class="nav navbar-nav  nav-indicators ">
				<?php
				if ($_SESSION['email'] != ''){
					$sid = $_SESSION['useri'];
					$queryCart = "SELECT SUM(quantity*(salePrice-(discount/100)*salePrice))as total,SUM(quantity) as totaljumlah
									FROM carts A LEFT JOIN
										products B ON A.productID=B.productID
									WHERE A.memberID='$sid' 
									ORDER BY A.cartID";
					$sqlCart = mysql_query($queryCart);			
					while($rowCart=mysql_fetch_array($sqlCart)){
						$total_rp    = format_rupiah($rowCart['total']);
						if ($rowCart['totaljumlah'] != ''){
							echo"<li class='dropdown nav-notifications'>
								<a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='badge'>$rowCart[totaljumlah]</span>
								<i class='ion-bag fa-lg icon-true'></i></a>
								<ul class='dropdown-menu'>
								<li class='nav-notifications-header'>
									<a tabindex='-1' href='#'><strong></strong> Transaksi baru</a>
								</li>
								<li class='nav-notification-body text-info'>
									<a href='keranjang-belanja.html'><i class='ion-android-cart'></i> ($rowCart[totaljumlah]) item produk <small class='pull-right'>Rp. $total_rp</small></a>
								</li>
								</ul>
								</li>";
						}
						else{
							echo"<li class='dropdown nav-messages'>
							<a href='keranjang-belanja.html' title='barang'>
								<span class='badge'></span><i class='ion-bag fa-lg icon-true'></i></a></li>";				
						}
					}
					?>
					
					<li class="dropdown nav-notifications">
						<?php
						$jum=mysql_num_rows(mysql_query("SELECT * FROM orders WHERE memberID != '$_SESSION[useri]' AND dibaca='N'"));
						$fine=mysql_fetch_array(mysql_query("SELECT * FROM orders WHERE memberID != '$_SESSION[useri]' AND dibaca='N'"));
						if($jum != ''){
						?>		
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="badge"><?php echo $jum; ?></span>
							<i class="ion-ios-lightbulb-outline fa-lg icon-true"></i></a>
							<ul class="dropdown-menu">
								<li class="nav-notifications-header">
									<a tabindex="-1" href="#"><strong>Selamat <?php echo $jum; ?></strong> Pesanan Baru </a>
								</li>
								<li class="nav-notification-body text-info">
									<a href="history.html"> Pesanan Baru #<?php echo $fine['invoice'];?> <small class="pull-right"><i class='ion-more'></i></small></a>
								</li>
							</ul>
						<?php } 
						else{
						?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="badge"></span>
							<i class="ion-ios-lightbulb-outline fa-lg icon-true"></i></a>
							<ul class="dropdown-menu">
								<li class="nav-notifications-header">
									<a tabindex="-1" href="#"><i class="ion-ios-close-outline"></i> Belum ada notifikasi! </a>
								</li>

							</ul>
						<?php } ?>
						
					</li>
					
					
					<li class='dropdown nav-messages'>
						<a href="status-transaction.html" title="Transaksi">
							<span class="badge"></span>
							<i class="ion-arrow-swap fa-lg icon-true"></i>
						</a>
					</li>					
					<li class='dropdown'>
						<a href="laporan.html" title="Transaksi" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
							<span class="badge"></span>
							<i class="ion-grid fa-lg icon-true"></i> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">	
							<li><a href="new-product.html"><span> Jual Barang</span></a></li><li class="divider"></li>	
							<li><a href="list-product.html"><span> Daftar Barang</span></a></li><li class="divider"></li>							
							<li><a href="history.html"><span> History Transaksi</span></a></li><li class="divider"></li>	
							<li><a href="compare.html"><span> Barang Bandingan</span></a></li>	<li class="divider"></li>	
							<li><a href="favorite.html"><span> Barang Favorit</span></a></li>											
						</ul>				
					</li>					
					<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
								<span class="thumb-sm avatar pull-right m-b-n-sm ">
								<?php
								$queryMember = "SELECT * FROM members WHERE memberID = '$_SESSION[useri]'";
								$sqlMember = mysql_query($queryMember);
								$r=mysql_fetch_array($sqlMember);						
								?>
								<?php if ($r['photo'] !=''){ ?>
									<img src='upload/member/<?php echo $r['photo']; ?>'/> <b class="caret"></b>
								<?php } 
								else {
								?>
									<img src='images/fb.jpg'/> <b class="caret"></b>
								<?php } ?>
								
								</span>
								</a>
								<ul class="dropdown-menu">									
									<li>
										<a href="profile-member.html"><span> My Akun</span></a>
									</li>					
									<li class="divider"></li>									
									<li>
										<a href="profit.html"><span> Penghasilan</span></a>
									</li>
									<li class="divider"></li>																	
									<li>
										<a href="logout.php"><span> Logout</span></a>
									</li>
								</ul>
							</li>	
					</ul>						
	
				<?php
				echo"</ul>";
				}
				else {
				?>


                <ul class="nav navbar-nav nav-indicators ">
					<li>
						<a href="sign-in.html"><i class="ion-android-cart fa-lg icon-true  m-r-xs"></i></a>			
					</li>				
                    <li style="padding:1px 10px 10px 20px;">
                        <div class="m-t-sm">
                            <a rel="nofollow" href="sign-in.html" class="btn btn-black btn-sm ">Login</a>
                            <a rel="nofollow" href="sign-up.html" class="btn btn-sm btn-go m-r-xs">Daftar</a>
                        </div>
                    </li>
                </ul>
				<?php } ?>
            </div>
        </div>

    </header>


    <div class="main-content bg-light">
        <?php include "content.php"; ?>

    </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------- -->

<div class="main-content bg-light">
		<?php include "action_result.php"; ?>
	</div>
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
  
    <!-- footer -->
    <footer id="footer">
        <div class="bg-black ">
            <div class="container ">
                <div class="row m-t-xl m-b-xl">
                    <div class="col-sm-3">
                        <h4 class=" m-b-xl text-white font-thin"><span class="font-bold">Follow</span> kami</h4>
                        <div class="m-b-xl">
                            <a rel="nofollow" href="#" target="_blank" class="btn btn-icon btn-facebook"><i class="fa fa-lg fa-facebook m-t-xxs"></i></a>
                            <a rel="nofollow" href="#" target="_blank" class="btn btn-icon btn-twitter"><i class="fa fa-lg fa-twitter m-t-xxs"></i></a>
                            <a rel="nofollow" href="#" target="_blank" class="btn btn-icon btn-googleplus"><i class="fa fa-lg fa-google-plus m-t-xxs"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h4 class=" m-b text-white font-thin"><span class="font-bold"> Belanja</span></h4>
                        <ul class="list-unstyled ">
                            <li>
                                <a href="about-us.html">Tentang Belanja</a>
                            </li>
                            <li>
                                <a href="conditions.html">Aturan Penggunaan</a>
                            </li>
                            <li>
                                <a href="privacy.html">Kebijakan Privasi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4 class="m-b text-white font-thin"><span class="font-bold">Info</span></h4>
                        <ul class="list-unstyled ">
                            <li>
                                <a href="tips.html">Tips Berbelanja</a>
                            </li>
                            <li>
                                <a href="payment.html">Pembayaran</a>
                            </li>
                            <li>
                                <a href="purchase.html">Pembelian</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4 class=" m-b text-white font-thin"><span class="font-bold">Bantuan</span></h4>
                        <ul class="list-unstyled ">
                            <li>
                                <a href="seller.html">Cara Berjualan</a>
                            </li>
                            <li>
                                <a href="faq.html">FAQ</a>
                            </li>
                            <li>
                                <a href="contact-us.html">Kontak kami</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="bg-black lt">
            <div class="container">
                <div class="row padder-v m-t">
                    <div class="col-xs-8"></div>
                    <div class="col-xs-4 text-right ">Copyright &copy; 
                        <?php echo date( 'Y');?> By BUMR</div>
                </div>
            </div>
        </div>
        <div class="bg-black lt">
            <div class="container">
                <div class="row padder-v m-t">
                    <div class="col-xs-8"></div>
                
                </div>
            </div>
        </div>
    </footer>
    <!-- / footer -->
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/lightbox/jquery.lightbox.min.js"></script>
    <script src="static/js/redactor/redactor.js"></script>
    <script src="static/js/redactor/source.js"></script>
    <script src="static/js/redactor/video.js"></script>
    <!-- Bootstrap -->
    <script src="static/js/bootstrap.js"></script>
    <script src="static/js/ui-load.js"></script>
    <script src="static/js/ui-jp.config.js"></script>
    <script src="static/js/ui-jp.js"></script>
    <script src="static/js/ui-nav.js"></script>
    <script src="static/js/ui-toggle.js"></script>
    <script src="static/js/jquery.appear.js"></script>
    <script src="static/js/landing.js"></script>
    <script src="static/js/extra204.js"></script>
    <script src="static/js/jquery.ui.highlight.min.js"></script>

	<script type="text/javascript" src="scripts/superfish.js"></script>
	<script type="text/javascript" src="scripts/hoverIntent.js"></script>
	<script type="text/javascript" src="scripts/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="scripts/owl.carousel.min.js"></script>
	<script type="text/javascript" src="scripts/counterup.min.js"></script>
	<script type="text/javascript" src="scripts/waypoints.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.sticky-kit.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.twentytwenty.js"></script>
	<script type="text/javascript" src="scripts/jquery.event.move.js"></script>
	<script type="text/javascript" src="scripts/jquery.photogrid.js"></script>
	<script type="text/javascript" src="scripts/jquery.tooltips.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.pricefilter.js"></script>
	<script type="text/javascript" src="scripts/jquery.stacktable.js"></script>
	<script type="text/javascript" src="scripts/jquery.contact-form.js"></script>
	<script type="text/javascript" src="scripts/jquery.jpanelmenu.js"></script>
	<script type="text/javascript" src="scripts/custom.js"></script>
</body>

</html>