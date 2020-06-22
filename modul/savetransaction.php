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
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$useri = $_SESSION['useri'];

function generate_unik($length = 2){
		$chars =  '0123456789';
		$str = '';
		$max = strlen($chars) - 1;
		
		for ($i=0; $i < $length; $i++)
			$str .= $chars[rand(0, $max)];
			
		return $str;
}
	
	
$sql = "SELECT * FROM members A LEFT JOIN		
		provinces B ON A.provinceID = B.provinceID LEFT JOIN
		cities C ON A.cityID = C.cityID LEFT JOIN
		shipping D ON A.shippingID=D.shippingID LEFT JOIN
		orders E ON A.memberID=E.memberID LEFT JOIN
		courier F ON D.courierID=F.courierID LEFT JOIN
		shipping_weight G ON D.shippingID=G.shippingID
		WHERE A.memberID = '$useri' AND A.email = '$email'
		ORDER BY A.memberID";
		
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);

// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
	$isikeranjang = array();
	$sid = $_SESSION['useri'];
	$sql = mysql_query("SELECT * FROM carts WHERE memberID='$sid'");
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date('Y-m-d H:i:s');	

$id = mysql_fetch_array(mysql_query("SELECT memberID,memberName FROM members WHERE email='$email'"));

// mendapatkan nomor,nama kustomer
$id_kustomer=$id['memberID'];
$customer=$id['memberName'];

$ref_id = BL.$_SESSION['useri'].date('Ymdhis');


// simpan data pemesanan 
mysql_query("INSERT INTO orders(dateOrder,memberID,customerName,pendingOrder,invoice) 
				VALUES('$tgl_skrg','$id_kustomer','$customer','1','$ref_id')");


  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(orderID, productID, quantity) 
               VALUES('$id_orders',{$isikeranjang[$i]['productID']}, {$isikeranjang[$i]['quantity']})");
	//update id_produk pada table orders		   
	mysql_query("UPDATE orders SET productID={$isikeranjang[$i]['productID']}
					WHERE orderID='$id_orders'");
	
}

for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM carts
	  	         WHERE cartID = {$isikeranjang[$i]['cartID']}");
}

    echo "<div class='container m-t-md'>
				<div class='row'>
					<div class='col-sm-12 link-info'>

			<div class='panel-heading b-b b-light'>
				<span class='font-bold'><i class='fa fa-exchange m-r-xs'></i> Keranjang Belanja</span>
			</div>
	 <table class='table table-striped m-b-none'>
      <tr><td>No. Tagihan     </td><td><font color='c30f42'> #$ref_id </font> </td></tr>	 
      <tr><td>Jasa Pengiriman   </td><td> : $r[courierName]</td></tr>
	  <tr><td>Estimasi Hari		     </td><td> : $r[estimateDay] </td></tr>	  
	  <tr><td>Status	     </td>
	  <td> : ";
?>
			<span title='pending' <?php if ($r['pendingOrder'] == '1'){ echo "class='fa-stack fa-lg icon-green'";}
								else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
				<i class="fa fa-hourglass-half fa-stack-1x fa-inverse"></i></span>

			<span title='dibayar' <?php if ($r['paidOrder'] == '0'){ echo "class='fa-stack fa-lg icon-green'";}
								else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
				<i class="fa fa-money fa-stack-1x fa-inverse"></i></span>

			<span title='dikirim' <?php if ($r['sentOrder'] == '0'){ echo "class='fa-stack fa-lg icon-green'";}
								else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
				<i class="fa fa-truck fa-stack-1x fa-inverse"></i></span>
				
			<span title='diterima' <?php if ($r['acceptOrder'] == '0'){ echo "class='fa-stack fa-lg icon-green'";}
								else { echo "class='fa-stack fa-lg icon-grey'";} ?>><i class="fa fa-circle fa-stack-2x"></i>
				<i class="ion-android-done-all fa-stack-1x fa-inverse"></i></span>

<?php	  
	 echo" </td>
	  
	  </tr>	  	
	  </table>
	  <a href='status-transaction.html' class='btn btn-black m-t-md m-b-sm' type='submit'> Bayar Sekarang</a>
      
";
	 
      $daftarproduk=mysql_query("SELECT * FROM orders_detail,products 
                                 WHERE orders_detail.productID=products.productID 
                                 AND orderID='$id_orders'");

echo "<table class='table table-striped table-hover' cellpadding='2' cellspacing='0'>
      <tr><th>No</th><th>Nama Produk</th><th>Berat(Kg)</th><th>Qty</th><th>Harga</th><th>Sub Total</th></tr>";
      
$pesan="Terimakasih telah melakukan pemesanan online di toko online kami<br />
        Nama: $r[memberName] <br />
        Alamat: $r[address] <br/>
        Telp: $r[phone] <br /><hr />
        
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftarproduk)){
   $disc        = ($d[discount]/100)*$d[salePrice];
   $hargadisc   = number_format(($d[salePrice]-$disc),0,",","."); 
   $subtotal    = ($d[salePrice]-$disc) * $d[quantity];

   $subtotalberat = $d[weight] * $d[quantity]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d[salePrice]);
   
   
   
   echo "<tr><td>$no</td>
			<td>$d[productName]</td>
			<td align=center>$d[weight]</td>
			<td align=center>$d[quantity]</td>
            <td align=right>$harga</td>
			<td align=right>$subtotal_rp</td></tr>";

   $pesan.="$d[quantity] $d[productName] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}

$shipping=$r['shippingID'];

$ongkos=mysql_fetch_array(mysql_query("SELECT shippingCost FROM shipping_weight WHERE shippingID='$shipping'"));
$ongkoskirim1=$ongkos['shippingCost'];
$ongkoskirim = $ongkoskirim1 * $totalberat;
$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);
$grandtotal_all  = $grandtotal;  
$uniqueCode = generate_unik();
$replace = substr($grandtotal_rp, 0, -2);
$gtotal = $replace.$uniqueCode;

$replace = substr($grandtotal_all, 0, -2);
$alltotal = $replace.$uniqueCode;
// dapatkan email_pengelola dan nomor rekening dari database
$sql2 = mysql_query("select email,rekening,contact from users");
$j2   = mysql_fetch_array($sql2);

$pesan.="<br /><br />Total : Rp. $total_rp 
         <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
         <br />Total Berat : $totalberat Kg
         <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
         <br />Grand Total : Rp. $gtotal 
         <br /><br />Silahkan lakukan pembayaran sebanyak Grand Total yang tercantum, rekeningnya: $j2[rekening]
         <br />Apabila sudah transfer, konfirmasi ke nomor: $j2[contact]";
		 
mysql_query("UPDATE orders SET totalOrder = '$alltotal'
					WHERE orderID='$id_orders'");

					
mysql_query("INSERT INTO withdraw(orderID,tagihanID,customerID,incomeDraw,dateCreate)
			VALUES('$id_orders','$ref_id','$id_kustomer','$alltotal','$tgl_skrg')");
			
					
$subjek="Pemesanan Online";

// Kirim email dalam format HTML
$dari = "From: $j2[email]\r\n";
$dari .= "Content-type: text/html\r\n";

// Kirim email ke kustomer
mail($email,$subjek,$pesan,$dari);

// Kirim email ke pengelola toko online
mail("$j2[email]",$subjek,$pesan,$dari);



echo "<tr><td colspan=5 align=right>Total Harga: Rp. </td><td align=right><b>$total_rp</b></td></tr>

      <tr><td colspan=5 align=right>Biaya Pengiriman : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$gtotal</b></td></tr>
      </table>";
echo "<hr /><p>
			<div style='color:#E1473D;border:1px solid #E78686;padding:10px;background:#FFE1E1;'>
			  Catatan: <br/>
			   1. Batas Maksimal Pembayaran adalah 1x24 jam setelah anda melakukan pembelian <br/>
			   2. Segera melakukan konfirmasi pembayaran produk anda</p>    	
								
              </div><br/><br/>
          </div>    
          </div>
          </div>
		  <meta http-equiv='refresh' content='1;url=status-transaction.html'>";  


?>