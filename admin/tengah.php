<?php
include "../config/koneksi.php";
include "../config/class_paging.php";
include "../config/fungsi_combobox.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET['app']=='home'){
?>
			<div class='block'>
                <p class='block-heading'>Administrator</p>
                <div class='block-body'>
				<p>Selamat datang di Administrator Sistem</p>
				</div>
            </div>	


			
<?php
}
elseif ($_GET['app']=='password'){
	include "modul/password/password.php";
}
elseif ($_GET['app']=='bukadompet'){
	include "modul/bukadompet/bukadompet.php";
}
elseif ($_GET['app']=='member'){
	include "modul/member/member.php";
}
elseif ($_GET['app']=='header'){
	include "modul/header/header.php";
}
elseif ($_GET['app']=='kaartikel'){
	include "modul/kaartikel/kaartikel.php";
}
elseif ($_GET['app']=='artikel'){
	include "modul/artikel/artikel.php";
}
elseif ($_GET['app']=='lokasi'){
	include "modul/lokasi/lokasi.php";
}
elseif ($_GET['app']=='kategori'){
	include "modul/kategori/kategori.php";
}

elseif ($_GET['app']=='sub'){
	include "modul/sub/sub.php";
}
elseif ($_GET['app']=='deposit'){
	include "modul/deposit/deposit.php";
}
elseif ($_GET['app']=='supplier'){
	include "modul/supplier/supplier.php";
}
elseif ($_GET['app']=='provinsi'){
	include "modul/provinsi/provinsi.php";
}
elseif ($_GET['app']=='kota'){
	include "modul/kota/kota.php";
}
elseif ($_GET['app']=='ekspedisi'){
	include "modul/ekspedisi/ekspedisi.php";
}
elseif ($_GET['app']=='ongkir'){
	include "modul/ongkir/ongkir.php";
}
elseif ($_GET['app']=='produk'){
	include "modul/produk/produk.php";
}
elseif ($_GET['app']=='users'){
	include "modul/users/users.php";
}
elseif ($_GET['app']=='kadeposit'){
	include "modul/kadeposit/kadeposit.php";
}

elseif ($_GET['app']=='new'){
	include "modul/new/new.php";
}
elseif ($_GET['app']=='finish'){
	include "modul/finish/finish.php";
}
elseif ($_GET['app']=='member'){
	include "modul/member/member.php";
}
else{
  echo "<p><b>Modul Belum ada</b></p>";
}
?>
