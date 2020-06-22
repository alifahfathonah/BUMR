<?php
include "../config/koneksi.php";
?>
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
if ($_SESSION['email'] == ''){
	header("Location: sign-in.html?err=log");
}
else{
$sid = $_SESSION['useri'];
$queryCart = "SELECT * FROM carts A LEFT JOIN
						products B ON A.productID=B.productID
						WHERE A.memberID='$sid' 
						ORDER BY A.cartID";
$sql = mysql_query($queryCart);
$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
    echo "<script>window.alert('Keranjang Anda Masih Kosong!');
			window.location=('index.php')</script>";
    }	
	else{
 	echo"<div class='container m-t-md'>
				<div class='row'>
					<div class='col-sm-12 link-info'>
						<div class='panel b-a'>
							<div class='panel-heading b-b b-light'>
								<span class='font-bold'><i class='fa fa-cart-plus m-r-xs'></i> Keranjang Belanja</span>
							</div>
						<div>
					<form method='post' action='aksi.php?module=keranjang&act=update'>
					<table class='table table-striped m-b-none'>
					<thead class='panel-heading b-b b-light'>
					<tr>
						<th>#</th>
						<th>Image</th>
						<th>Barang</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
					</thead>
					<tbody>";
		$no=1;
		while($r=mysql_fetch_array($sql)){
		$disc        = ($r['discount']/100)*$r['salePrice'];
		$hargadisc   = number_format(($r['salePrice']-$disc),0,",",".");
		$subtotal    = ($r['salePrice']-$disc) * $r['quantity'];
		$total       = $total + $subtotal;  
		$subtotal_rp = format_rupiah($subtotal);
		$total_rp    = format_rupiah($total);
		$harga       = format_rupiah($r['salePrice']);	
		echo"<tr>
					<td>$no</td>
						<input type=hidden name=id[$no] value=$r[cartID]>
					<td>
						<div class='item m-l-n-xxs m-r-n-xxs'>
							<a href='#'><img src='upload/produk/$r[photo1]' width='100px' height='70px'></a>
						</div>
					</td>
					<td >$r[productCode] - $r[productName]</td>
					<td>		
						<select class='form-control no border text-grey' name='jml[$no]' value=$r[quantity] onChange='this.form.submit()'>";
							for ($j=1;$j <= $r['qty'];$j++){
							  if($j == $r['quantity']){
							   echo "<option selected>$j</option>";
							  }else{
							   echo "<option>$j</option>";
							  }
						  }
					echo "</select>
					</td>	
					<td>Rp. $hargadisc</td>
					<td>Rp. $subtotal_rp</td>
					<td><a href='aksi.php?module=keranjang&act=hapus&id=$r[cartID]'>
							<i class='fa fa-trash-o' aria-hidden='true'></i></a></td>
			</tr>";
		$no++;			
		}
	echo"</tbody></table></div></div></div>
			<a href='index.php' class='btn btn-info m-t-md m-b-sm' type='subtmit'> Lanjutkan Belanja</a>
			<a href='save-view.html' class='btn btn-black m-t-md m-b-sm' type='submit'> Lanjutkan Pembayaran</a>
		</div>";
	}
}	
?>