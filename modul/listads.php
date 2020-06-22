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
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);	
	$sql=mysql_query("SELECT * FROM ads_order A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					ads C ON A.adsID=C.adsID
					WHERE A.memberID='$_SESSION[useri]' 
					ORDER BY A.adsOrderID DESC");
    $no = $posisi+1;	
	$t=mysql_num_rows($sql);			
	if($t=='0'){
		echo "<script>window.alert('Ads barang masih kosong');
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
					<strong><i class='ion-checkmark-circled'></i> Sukses!</strong> Iklan anda berhasil ditambahkan
					</div>";
				}			
					
					echo"<div class='panel b-a'>
							<div class='panel-heading b-b b-light'>
								<span><i class='ion-ios-list-outline m-r-xs'></i> Daftar Iklan</span>
							</div>	
						<table class='table table-striped m-b-none'>
							<thead class='panel-heading b-b b-light'>
								<tr>
									<th>#</th>	
									<th>Image</th>					
									<th>ID Iklan</th>
									<th>Jenis</th>
									<th>Nama</th>
									<th>Harga</th>		
									<th>Tanggal</th>
									
								</tr></thead><tbody>";	
							while($r = mysql_fetch_array($sql)){
										$tanggal= tgl_indo($r['adsDate']);
							echo"<tr><td>$no</td>
									  <td><div class='item m-l-n-xxs m-r-n-xxs'>
											<a href='#'><img src='upload/ads/$r[image1]' width='100px' height='70px'></a>
											</div>
										</td>
									  <td>$r[adsInvoice]</td>
									  <td><span class='label label-warning'>$r[adsTitle]</span></td>
									  <td>$r[adsName] </td>
									  <td>$r[adsUrl]</td>
									  <td>$tanggal</td>
									 ";
									  if($r['statusAds'] == 'Waiting'){
										echo"<td><span class='label label-warning'><i class='ion-loop'></i> Waiting</span></td>";
									  }
									  else{
										echo"<td><span class='label label-success'><i class='ion-android-done-all'></i> Aktif</span></td>";
									  }
									  echo"</tr>";
								$no++;
							}
						echo "</table>
	
						</div></div></div>";	
						$jmldata = mysql_num_rows(mysql_query("SELECT * FROM ads_order"));
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