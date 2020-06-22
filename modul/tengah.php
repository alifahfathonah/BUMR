<?php
include "../config/koneksi.php";
include "../config/class_paging.php";


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
	include "modul/password.php";
}

else{
  echo "<p><b>Modul Belum ada</b></p>";
}
?>
