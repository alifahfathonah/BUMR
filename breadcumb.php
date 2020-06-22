<?php
if($_GET['module'] == 'allcategory'){
	$query = "SELECT categoryName from categories where categoryID='$_GET[id]'";
	$sql = mysql_query($query);
	$r = mysql_fetch_array($sql);	
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span>Kategori</span> / <span>$r[categoryName]</span> ";		
}
elseif($_GET['module'] == 'signup'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Daftar Member</span></a></span> ";		
}

elseif($_GET['module'] == 'map'){
	echo "<span><a href='home' class='text-grey'><span>Google Map</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Google Map</span></a></span> ";		
}


elseif($_GET['module'] == 'success'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Activate Sending</span></a></span> ";		
}
elseif($_GET['module'] == 'promo'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Produk Promo &amp; Diskon</span></a></span> ";		
}
elseif($_GET['module'] == 'checkout'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Checkout</span></a></span> ";		
}
elseif($_GET['module'] == 'profit'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Penghasilan Saya</span></a></span> ";		
}

elseif($_GET['module'] == 'signin'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Login Member</span></a></span> ";		
}
elseif($_GET['module'] == 'addsaldo'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Tambah Saldo</span></a></span> ";		
}
elseif($_GET['module'] == 'detaildana'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Rincian Dompet</span></a></span> ";		
}
elseif($_GET['module'] == 'paidsaldo'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Bayar Saldo</span></a></span> ";		
}
elseif($_GET['module'] == 'alldana'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Penarikan Dana</span></a></span> ";		
}
elseif($_GET['module'] == 'tarikdana'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Rincian Pencairan</span></a></span> ";		
}
elseif($_GET['module'] == 'pencairan'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Pencarian Dana</span></a></span> ";		
}
elseif($_GET['module'] == 'allsaldo'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Transaksi Saldo</span></a></span> ";		
}
elseif($_GET['module'] == 'chat'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Daftar Chat</span></a></span> ";		
}
elseif($_GET['module'] == 'sendtransaction'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Kirim Barang</span></a></span> ";		
}
elseif($_GET['module'] == 'readchat'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Pesan Chat</span></a></span> ";		
}
elseif($_GET['module'] == 'profile'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Profile Member</span></a></span> ";		
}
elseif($_GET['module'] == 'keranjangbelanja'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Cart Belanja</span></a></span> ";		
}
elseif($_GET['module'] == 'savetransaction'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Checkout</span></a></span> ";		
}
elseif($_GET['module'] == 'statustransaction'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span> Transaksi</span></a></span> ";		
}
elseif($_GET['module'] == 'add-complete'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Barang Diterima</span></a></span> ";		
}
elseif($_GET['module'] == 'history'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>History Transaksi</span></a></span> ";		
}
elseif($_GET['module'] == 'favorite'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Produk Favorite</span></a></span> ";		
}
elseif($_GET['module'] == 'compare'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Produk Bandingan</span></a></span> ";		
}
elseif($_GET['module'] == 'add-paid'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Pembayaran</span></a></span> ";		
}
elseif($_GET['module'] == 'newproduct'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Add Produk Baru</span></a></span> ";		
}
elseif($_GET['module'] == 'listproduct'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Daftar Produk</span></a></span> ";		
}
elseif($_GET['module'] == 'listads'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Daftar Iklan</span></a></span> ";		
}
elseif($_GET['module'] == 'editproduct'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Edit Produk</span></a></span> ";		
}
elseif($_GET['module'] == 'articles'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Informasi</span></a></span> ";		
}
elseif($_GET['module'] == 'openads'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>BukaIklan</span></a></span> ";		
}
elseif($_GET['module'] == 'addads'){
	echo "<span><a href='home' class='text-grey'><span>Home</span></a></span>  / 
				<span><a href='#' class='text-grey'><span>Transaksi Iklan</span></a></span> ";		
}
elseif($_GET['module'] == 'subcategory_detail'){
	$query = "SELECT * FROM products A LEFT JOIN
										sub_categories B ON A.subCategoryID=B.subCategoryID LEFT JOIN
										categories C ON A.categoryID=C.categoryID
										WHERE  A.categoryID='$_GET[id]'  AND B.subCategoryID='$_GET[cat]'
										ORDER BY A.productID";
	$sql = mysql_query($query);
	$r = mysql_fetch_array($sql);
	if($r['subCategoryID'] != ''){
		echo "Kategori  <b>$r[categoryName] / $r[subCategoryName]</b>";	
	}
	else {
		echo "Kategori  <b><i class='ion-alert-circled'></i> Kosong</b>";	
	}
}
?>