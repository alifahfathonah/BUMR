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
session_start();
$aksi="modul/action_compare.php";

$sql=mysql_query("SELECT * FROM compare A LEFT JOIN
					products B ON A.productID=B.productID LEFT JOIN
					categories C ON B.categoryID=C.categoryID LEFT JOIN
					members D ON A.memberID=D.memberID
					WHERE A.memberID='$_SESSION[useri]'
					ORDER BY A.compareID");
$row=mysql_num_rows($sql);

if($row ==''){
    echo "<script>window.alert('Anda belum menambahkna produk untuk dibandingkan');
        window.location=('index.php')</script>";
}
else {
echo"<div id='content' class='main-content bg-lights'>
		<div class='container'><div class='m-t-md'></div>	
			<div class='row'>
				<div class='col-sm-12 link-info'>";		
					$full_url = full_url();
						if (strpos($full_url, "?suc=ok") == TRUE){
							echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
									<strong><i class='ion-android-done-all'></i> Sukses!</strong> Menambahkan Produk</div>";										
						}
						if (strpos($full_url, "?suc=delete") == TRUE){
							echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>
									<strong><i class='ion-android-done-all'></i> Hapus!</strong> Barang perbandingan berhasil dihapus
									</div>";		
						}
					
					while ($r=mysql_fetch_array($sql)){
						$harga  = format_rupiah($r['salePrice']);
						if($r['conditions'] == '1'){ $ket='Baru';}else{$ket='Bekas';}
						
					echo"<div class='col-md-3 col-sm-6'>
							<div class='item-panel panel b-a'>
								<div class='item m-l-n-xxs m-r-n-xxs'>
									<div class='pos-rlt'>
										<a href='#'>
										<div class='item-header-overlay'></div>
										</a>
										<a href='#'><img src='upload/produk/$r[photo1]' height=120px class='img-full'></a>
									</div>
								</div>
								<div class='row no-gutter m-l-sm item-listing-title'>
									<div class='m-l-sm'>
										<div class='m-r-sm text-md font-bold text-center'>
											<a href='#'><h2 class='text-md font-bold m-t-sm'>$r[productName]</h2></a>
										</div>
									</div>
									<div class='m-l-sm'>
										<div class='m-r-sm text-md  text-sm'>
											<span class='m-l-xs m-b-sm text-muted'> Harga: $harga</span>
										</div>
										<div class='m-r-sm text-md  text-sm'>
											<span class='m-l-xs m-b-sm text-muted'> Kondisi: $ket</span>
										</div>		
										<div class='m-r-sm text-md  text-sm'>
											<span class='m-l-xs m-b-sm text-muted'> View: $r[hits]</span>
										</div>	
										<div class='m-r-sm text-md  text-sm'>
											<span class='m-l-xs m-b-sm text-muted'> Berat: $r[weight] Kg</span>
										</div>											
									</div>									
								</div>
								<div class='row no-gutter item-listing-extra m-t-xs '>


								</div>
								<div class='row no-gutter b-t b-light'>
									<div class='m-l-sm m-t-sm m-b-xs pull-left text-sm'>
										
										<span class='m-l-xs m-b-sm text-muted'><i class='fa fa-user'></i> $r[memberName]</span>
									</div>
									<div class='m-b-sm m-r-sm m-t-sm pull-right'>
										<img src='images/star-on.png' alt=''/>
										<img src='images/star-on.png' alt=''/>
										<img src='images/star-off.png' alt=''/>
										<img src='images/star-off.png' alt=''/>
										<img src='images/star-off.png' alt=''/>
									</div>
								</div>
							</div>
						</div>";						
						
						}
						
			echo"</div>
			</div>
		</div>
	</div>";


}
?>