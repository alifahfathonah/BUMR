<?php
    // diskon  
    $harga     = format_rupiah($r['salePrice']);
    $disc      = ($r['discount']/100)*$r['salePrice'];
    $hargadisc = number_format(($r['salePrice']-$disc),0,",",".");

    $d=$r['discount'];
    $hargatetap  = "<span> </span>
                    <span><b> Rp. $hargadisc,-</b></span>";
    $hargadiskon = "<span> $d% -</span>
                    <span><b> Rp. $hargadisc,-</b></span>";
    if ($d!=0){
      $divharga=$hargadiskon;
    }else{
      $divharga=$hargatetap;
    } 

    $stok        = $r['qty'];
    $tombolbeli  = "<a rel='nofollow' href='aksi.php?module=keranjang&act=tambah&id=$r[productID]' data-toggle='tooltip' data-placement='top' title='Beli' class='btn btn-sm btn-icon btn-default' target='_blank'>
					<i class='fa fa-cart-plus'></i> </a>";	
					
    $tombolhabis = "<a rel='nofollow' href='#' data-toggle='tooltip' data-placement='top' title='Stok Habis' class='btn btn-sm btn-icon btn-default'>
					<i class='ion-alert-circled'></i></a>";
					
    $buttonbeli  = "<a class='btn btn-success btn-md btn-block  font-bold' href=\"aksi.php?module=keranjang&act=tambah&id=$r[productID]\"><i class='ion-android-cart'></i> 
					Beli </a>
					";
    $buttonhabis = "<a class='btn btn-danger btn-md btn-block  font-bold' href='#'> Stok Habis <i class='ion-alert'></i></a>";
	
    if ($stok!=0){
      $tombol=$tombolbeli;
    }else{
      $tombol=$tombolhabis;
    } 
	
    if ($stok!=0){
      $button=$buttonbeli;
    }else{
      $button=$buttonhabis;
    } 	
?>
