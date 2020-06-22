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
 
    <title>Poli-Market</title>
    <meta name="description" content="Pusat Jualan Online Marketstore" />
    <meta name="keywords" content="E-Lapak">
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
								<a rel='nofollow' href='googlemap.html' class='btn btn-black btn-sm'>Cari Tempat</a>
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
                    </ul>
					<?php
					if ($_SESSION['email'] != ''){
					?>					
					<ul class="nav navbar-nav navbar-left m-r-xs">			
						<a class="btn btn-sm ">Selamat datang, <font color="#eec401"><?php echo $_SESSION['username']; ?> </font> </a>								
						<a href="promo.html" class="btn btn-sm "> Promo</a>		
						<a href="all-balance.html" class="btn btn-sm "> BukaSaldo</a>						
						<a href="open-ads.html" class="btn btn-sm "> BukaIklan</a>	
												
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
					
					<li class="dropdown nav-notifications">
						<?php
						$chat = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_to = '$_SESSION[useri]' AND recd = 0"));
						$sql_ads = mysql_query("SELECT A.chat_id, B.memberID, A.sent, B.username, A.recd, A.message, 
												A.chat_to, A.chat_from,B.email FROM chat A 
												INNER JOIN members B ON B.memberID = A.chat_from
												WHERE A.chat_to = '$_SESSION[useri]' ORDER BY A.sent ");	
												
						$dtChat = mysql_fetch_array($sql_ads);
						if($chat != ''){
						?>		
							<a href="chat.html" class="dropdown-toggle" data-toggle="dropdown">
							<span class="badge"><?php echo $chat; ?></span>
							<i class="ion-chatbubble-working fa-lg icon-true"></i></a>
							<ul class="dropdown-menu">
								<li class="nav-notifications-header">
									<a tabindex="-1" href="#">Kamu memiliki <strong><?php echo $chat; ?></strong> chat baru</a>
								</li>
								<li class="nav-notification-body text-info">
									<a href="chat.html"><i class="ion-chatbubble-working"></i> Pesan dari <?php echo $dtChat['username']; ?> <small class="pull-right"><i class='ion-more'></i></small></a>
								</li>
							</ul>
						<?php } 
						else{
						?>
							<a href="chat.html" class="dropdown-toggle" data-toggle="dropdown">
							<span class="badge"></span>
							<i class="ion-chatbubble-working fa-lg icon-true"></i></a>
							<ul class="dropdown-menu">
								<li class="nav-notifications-header">
									<a tabindex="-1" href="#"><i class="ion-ios-close-outline"></i> Belum ada chat! </a>
								</li>

							</ul>
						<?php } ?>
						
					</li>

				
					
					<li class='dropdown nav-messages'>
						<a href="status-transaction.html" title="transaksi">
							<span class="badge"></span>
							<i class="ion-arrow-swap fa-lg icon-true"></i>
						</a>
					</li>					
					<li class='dropdown'>
						<a href="laporan.html" title="transaksi" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
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
										<a href="list-ads.html"><span> Iklan Saya</span></a>
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
                            <a rel="nofollow" href="map.html" class="btn btn-black btn-sm"> Cari Tempat </a>
                        </div>
                    </li>
                </ul>
				<?php } ?>
            </div>
        </div>

    </header>


    <div class="main-content bg-light">

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
							<li class='active'><a href='#view' data-toggle='tab' class='text-sm'>Detail Ekspedisi</a></li>								
						</ul>		

					
						<div id='myTabContent' class='tab-content'>		
							<div class='tab-pane active in' id='view'>
								<div class="panel-body link-info">								
									<?php
$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='ekspedisi-view' AND $act=='viewongkir'){
	$provinceID = mysql_real_escape_string($_GET['provinceID']);
	$cityID = mysql_real_escape_string($_GET['cityID']);
	$queryLocation = "SELECT A.provinceName, A.provinceID, B.cityID, B.cityName 
						FROM provinces A INNER JOIN 
							 cities B ON A.provinceID = B.provinceID 
							 WHERE A.provinceID = '$provinceID' AND B.cityID = '$cityID'";
	$sqlLocation = mysql_query($queryLocation);
	$dataLocation = mysql_fetch_array($sqlLocation);
			echo"<table class='table'>
					<tr>
						<td colspan='3'><b>Tujuan Pengiriman</b></td>
					</tr>
					<tr>
						<td>Propinsi</td>
						<td>:</td>
						<td>$dataLocation[provinceName]</td>
					</tr>
					<tr>
						<td>Kota</td>
						<td>:</td>
						<td>$dataLocation[cityName]</td>
					</tr>
				</table>";

			echo"<table class='table table-bordered table-striped'>
				<thead>
					<tr>
						<th>No</th>
						<th>Ekspedisi </th>
						<th>Layanan</th>
						<th>Biaya Kirim </th>
						<th>Estimasi </th>
					</tr>
				</thead>";
				$queryCost = "SELECT A.shippingID, A.estimateDay, A.provinceID, A.cityID, B.courierName,B.courierDesc
							FROM shipping A INNER JOIN 
								courier B ON A.courierID = B.courierID 
							WHERE A.provinceID = '$provinceID' AND A.cityID = '$cityID' ORDER BY B.courierName ASC";
				$sqlCost = mysql_query($queryCost);
				$no=1;
				while ($dtCost = mysql_fetch_array($sqlCost))					
				{		
					echo"<tr><td>$no</td>
							<td>$dtCost[courierName]</td>
							<td>$dtCost[courierDesc]</td>
							<td>";
							$queryWeightCost = "SELECT * FROM shipping_weight 
												WHERE shippingID = '$dtCost[shippingID]' ORDER BY weightFrom ASC";
							$sqlWeightCost = mysql_query($queryWeightCost);
							while($dtWeightCost = mysql_fetch_array($sqlWeightCost)){
							if ($dtWeightCost['shippingStatus'] == 'K')
							{
								$status = "Per Kg";
							}
							else
							{
								$status = "Borongan / Global";
							}								
							echo"
								&bull; $dtWeightCost[weightFrom] - $dtWeightCost[weightTo] Kg : 
								Rp. $dtWeightCost[shippingCost] ($status)<br>							
								";
							}
						echo"</td>";
						echo"<td>$dtCost[estimateDay]</td>
						</tr>";
				}
				echo"</table>";	
			echo"<div class='btn-toolbar'>	
					<input class='btn btn-black' type='button' value='Kembali' onclick='javascript:history.go(-1)'>	
				</div>";				
}									
									?>
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

    </div>




  
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
                    <div class="col-xs-4 text-right ">Copyright &copy; 2015 -
                        <?php echo date( 'Y');?> By E-Belanja</div>
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