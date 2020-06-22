<?php
  session_start();
  session_destroy();
echo "<center>Anda telah keluar sistem ";
  echo "<meta http-equiv='refresh' content='1;url=../index.php'>";
?>
