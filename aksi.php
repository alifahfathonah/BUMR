<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";

if (empty($_SESSION['email']) AND empty($_SESSION['password'])) {
		header("Location: sign-in.html?err=log");
}
else {

$module=$_GET['module'];
$act=$_GET[act];

if ($module=='keranjang' AND $act=='tambah'){

	$sid = $_SESSION['useri'];
	$query2 = "SELECT qty,salePrice FROM products WHERE productID='$_GET[id]'";
	$sql2 = mysql_query($query2);
	$r=mysql_fetch_array($sql2);
	$stok=$r['qty'];
	$price=$r['salePrice'];

  if ($stok == 0){
      echo "stok habis";
  }
  else{
	$query = "SELECT productID FROM carts
				WHERE productID='$_GET[id]' AND memberID='$sid'";
	$sql = mysql_query($query);
	$ketemu=mysql_num_rows($sql);
	if ($ketemu==0){
		// put the product in cart table
		$queryInsert = "INSERT INTO carts (productID, quantity, memberID, createDate, stockCart, price)
						VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$stok', '$price')";
		mysql_query($queryInsert);
	} else {
		// update product quantity in cart table
		$queryInsert = "UPDATE carts SET quantity = quantity + 1
						WHERE memberID ='$sid' AND productID='$_GET[id]'";
		mysql_query($queryInsert);
	}	
	deleteAbandonedCart();
	header('Location:keranjang-belanja.html');
  }				
}

elseif ($module=='keranjang' AND $act=='hapus'){
	$queryDelet = "DELETE FROM carts WHERE cartID='$_GET[id]'";
		mysql_query($queryDelet);
	header('Location:index.php');				
}

elseif ($module=='keranjang' AND $act=='update'){
  $id       = $_POST[id];
  $jml_data = count($id);
  $jumlah   = $_POST[jml]; // quantity
  for ($i=1; $i <= $jml_data; $i++){
	$query2 = "SELECT stockCart FROM carts WHERE cartID='".$id[$i]."'";
	$sql2 = mysql_query($query2);
	while($r=mysql_fetch_array($sql2)){
    if ($jumlah[$i] > $r['stockCart']){
        echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
        window.location=('keranjang-belanja.html')</script>";
    }
    elseif($jumlah[$i] == 0){
        echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');
        window.location=('keranjang-belanja.html')</script>";
    }
    else{
		$queryUpdate = "UPDATE carts SET quantity = '".$jumlah[$i]."'
                                      WHERE cartID = '".$id[$i]."'";
		mysql_query($queryUpdate);							  
      header('Location:keranjang-belanja.html');
    }
  }
  }
}
}

/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM carts 
	        WHERE createDate < '$kemarin'");
}
?>
