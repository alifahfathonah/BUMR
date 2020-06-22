	<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
	</div>	
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="notification notice margin-bottom-30">
			</div>
		</div>

	</div>

	<!-- Row / Start -->
	<div class="row">


		<div class="col-md-12">
			<h4 class="headline with-border margin-bottom-35">Pilihan daftar harga Iklan terbaik untuk anda</h4>
		</div>

		<?php
		$r1=mysql_fetch_array(mysql_query("SELECT * FROM ads WHERE adsTitle='Basic' ORDER BY adsID"));
		$harga1 =format_rupiah($r1['adsPrice']);
		?>
		<!-- Plan #1 -->
		<div class="col-md-4 col-sm-6">
			<div class="plan color-1">
				<div class="plan-price">
					<h3><?php echo $r1['adsTitle'];?></h3>
					<span class="plan-currency">IDR</span>
					<span class="value"><?php echo $harga1;?></span>
					
				</div>
				<div class="plan-features">
					<ul>
						<li><?php echo $r1['adsDesc'];?></li>
					</ul>
					<a class="button" href="add-ads.html"><i class="ion-plus-round"></i> Order Sekarang</a>
				</div>
			</div>
		</div>
		<?php
		$r2=mysql_fetch_array(mysql_query("SELECT * FROM ads WHERE adsTitle='Enterprise'"));
		$harga2 =format_rupiah($r2['adsPrice']);
		?>
		<div class="col-md-4 col-sm-6">
			<!-- Plan #2 -->	
			<div class="plan color-2">
				<div class="plan-price">
					<h3><?php echo $r2['adsTitle'];?></h3>
					<span class="plan-currency">IDR</span>
					<span class="value"><?php echo $harga2;?></span>
				</div>
				<div class="plan-features">
					<ul>
						<li><?php echo $r2['adsDesc'];?></li>
					</ul>
					<a class="button" href="add-ads.html"><i class="ion-plus-round"></i> Order Sekarang</a>
				</div>
			</div>
		</div>
		<?php
		$r3=mysql_fetch_array(mysql_query("SELECT * FROM ads WHERE adsTitle='Expert'"));
		$harga3 =format_rupiah($r3['adsPrice']);
		?>
		<div class="col-md-4 col-sm-6">
			<!-- Plan #3 -->
			<div class="plan color-3">
				<div class="plan-price">
					<h3><?php echo $r3['adsTitle'];?></h3>
					<span class="plan-currency">IDR</span>
					<span class="value"><?php echo $harga3;?></span>
				</div>
				<div class="plan-features">
					<ul>
						<li><?php echo $r3['adsDesc'];?></li>
					</ul>
					<a class="button" href="add-ads.html"><i class="ion-plus-round"></i> Order Sekarang</a>
				</div>
			</div>
		</div>

	</div>
	<!-- Row / End -->

</div>