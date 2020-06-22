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
$aksi="modul/action_delete_product.php";
switch($_GET[act]){
	default:
    $p      = new Paging;
    $batas  = 1;
    $posisi = $p->cariPosisi($batas);	
	$sql=mysql_query("SELECT * FROM products A LEFT JOIN
						members B ON A.memberID=B.memberID LEFT JOIN
						categories C ON A.categoryID=C.categoryID LEFT JOIN
						sub_categories D ON A.subCategoryID=D.subCategoryID
						WHERE A.memberID = '$_SESSION[useri]'
						ORDER BY A.productName");
    $no = $posisi+1;	
	$t=mysql_num_rows($sql);			
	if($t=='0'){
		echo "<script>window.alert('Produk barang masih kosong');
			window.location=('index.php')</script>";
	}
	else{
	echo"<div id='content' class='main-content bg-lights'>
		<div class='container'><div class='m-t-md'></div>
			<div class='row'>
				<div class='col-sm-12 link-info'>";
				$full_url = full_url();
				if (strpos($full_url, "?suc=ok") == TRUE){
					echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong><i class='ion-checkmark-circled'></i> Sukses!</strong> Produk anda berhasil ditambahkan
					</div>";
				}
				if (strpos($full_url, "?suc=edit") == TRUE){
					echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong><i class='ion-ios-checkmark-outline'></i> Sukses!</strong> Produk anda berhasil diupdate
					</div>";
				}				
				if (strpos($full_url, "?suc=delete") == TRUE){
					echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong><i class='ion-ios-checkmark-outline'></i> Sukses!</strong> Produk anda berhasil dihapus
					</div>";
				}					
					echo"<div class='panel b-a'>
							<div class='panel-heading b-b b-light'>
								<span><i class='ion-ios-list-outline m-r-xs'></i> Daftar Lapak</span>
							</div>	
						<table class='table table-striped m-b-none'>
							<thead class='panel-heading b-b b-light'>
								<tr>
									<th>No</th>	
									<th>Kategori</th>					
									<th>Nama</th>
									<th>Harga</th>
									<th>Stok</th>		
									<th>Tanggal</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr></thead><tbody>";	
							while($r = mysql_fetch_array($sql)){
										$tanggal=tgl_indo($r['createDate']);
										$harga  = format_rupiah($r['salePrice']);
										if($r['status'] == 'Y'){
											$status = "Aktif";
										}
							echo "<tr><td>$no</td>
									  <td>$r[categoryName]</td>
									  <td>$r[productCode]-$r[productName]</td>
									  <td>Rp.$harga </td>
									  <td>$r[qty]</td>
									  <td>$tanggal</td>
									  <td><span class='label label-success'><i class='ion-android-done-all'></i> $status</span></td>
									  <td><a class='text-sm' href='edit-product-1-1-$r[productID].html'><i class='ion-edit'></i> Edit</a> |
											<a class='text-sm' href='product-$r[productID]-$r[productSeo].html'><i class='ion-eye'></i> Detail</a> |
											<a href='$aksi?module=produk&act=delete&productID=$r[productID]&file1=$r[photo1]&file2=$r[photo2]&file3=$r[photo3]&file4=$r[photo4]&file5=$r[photo5]&file6=$r[photo6]' onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">
													<i class='ion-close'></i> Hapus</a>
										</td></tr>";
								$no++;
							}
						echo "</table>
	
						</div></div></div>";	
						$jmldata = mysql_num_rows(mysql_query("SELECT * FROM products"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

				  echo "<div class='text-right m-b-sm'>
						<ul class='pagination pagination-md'>
							<li><a href='#'>Halaman : $linkHalaman </a></li>
						</ul></div></div>";	
	}
	
break;	
}	
?>