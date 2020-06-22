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
$aksi="modul/action_favorite.php";

$sql=mysql_query("SELECT * FROM favorite A LEFT JOIN
					products B ON A.productID=B.productID LEFT JOIN
					categories C ON B.categoryID=C.categoryID
					WHERE A.memberID='$_SESSION[useri]'
					ORDER BY A.favoriteID");
$r=mysql_num_rows($sql);
if($r ==''){
    echo "<script>window.alert('Belum ada produk favorit');
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
									<strong><i class='ion-android-done-all'></i> Sukses!</strong> Produk Favorit Anda</div>";										
						}
						if (strpos($full_url, "?suc=delete") == TRUE){
							echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>
									<strong><i class='ion-android-done-all'></i> Sukses!</strong> Barang favorit anda berhasil dihapus
									</div>";		
						}
					echo"<div class='panel b-a'>
							<div class='panel-heading b-b b-light'>
								<span class='font-bold'><i class='ion-android-favorite m-r-xs'></i> Produk Favorit</span>
							</div>
							<table class='table table-striped m-b-none'>
								<thead class='panel-heading b-b b-light'>
									<tr>
										<th>#</th>	
										<th>Kategori</th>	
										<th>Produk</th>
										<th>Harga</th>
										<th>Aksi</th>
									</tr></thead><tbody>";
									$no=1;
									while($data = mysql_fetch_array($sql)){
									$harga  = format_rupiah($data['salePrice']);									
									echo"<tr>
										<td>$no</td>
										<td>$data[categoryName]</td>
										<td>$data[productName]</td>
										<td>$harga</td>
										<td><a href='product-$data[productID]-$data[productSeo].html'><i class='ion-monitor'></i> Detail</a> |
											<a href='$aksi?module=favorite&act=hapus&id=$data[favoriteID]' onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">
												<i class='ion-trash-b'></i> Hapus</a>
										</td>
										</tr>";									
										$no++;
									}
								echo"</tbody></table>	
						</div>";
			echo"</div>
			</div>
		</div>
	</div>";


}
?>