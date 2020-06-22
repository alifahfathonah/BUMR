<script language="javascript" src="js/ri-fungsi.js"></script>
<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
</div>
<body onLoad="document.postform.elements['biaya'].focus();">	
<?php
session_start();
$aksi="modul/action_paid.php";
switch($_GET[act]){
  default:
echo"<div class='container m-t-md'>
		<div class='row'>
			<div class='col-sm-12 link-info'>
				<div class='panel b-a'>";
				$sql2=mysql_query("SELECT * FROM orders_detail A LEFT JOIN
										products B ON A.productID=B.productID
										WHERE A.orderID='$_GET[id]' ORDER BY A.orderID");		
				echo"<table class='table table-striped m-b-none'>		
						<tr><th>#</th>
							<th>Produk</th>
							<th>Berat(Kg)</th>
							<th>Qty</th>
							<th>Harga</th>
							<th>Diskon</th>
							<th>Sub Total</th>
						</tr>";				
				$no=1;
				while($s=mysql_fetch_array($sql2)){	
				$disc        = ($s['discount']/100)*$s['salePrice'];
				$hargadisc   = number_format(($s['salePrice']-$disc),0,",","."); 
				$subtotal    = ($s['salePrice']-$disc) * $s['quantity'];	
				$total       = $total + $subtotal;
				$subtotal_rp = format_rupiah($subtotal);    
				$total_rp    = format_rupiah($total);    
				$harga       = format_rupiah($s['salePrice']);				
				$subtotalberat = $s['weight'] * $s['quantity'];  
				$totalberat  = $totalberat + $subtotalberat; 				
			echo"<tr><td>$no</td>
					 <td>$s[productName]</td>
					 <td>$s[weight]</td>
					 <td>$s[quantity]</td>
					<td>$harga</td><td>$s[discount]%</td>
					<td>$subtotal_rp</td></tr>";
			  $no++;
			}
			$ongkos=mysql_fetch_array(mysql_query("SELECT * FROM shipping A LEFT JOIN		
													members B ON A.shippingID=B.shippingID LEFT JOIN
													orders C ON B.memberID=C.memberID LEFT JOIN
													shipping_weight D ON A.shippingID=D.shippingID
													WHERE C.orderID = '$_GET[id]'"));
			$ongkoskirim1=$ongkos['shippingCost'];
			$ongkoskirim=$ongkoskirim1 * $totalberat;		
			$grandtotal= $total + $ongkoskirim;	
			$ongkoskirim_rp = format_rupiah($ongkoskirim);
			$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
			$grandtotal_rp  = format_rupiah($grandtotal);    			
			$all = format_rupiah($ongkos['totalOrder']);
			echo "<tr><td colspan=6 align=right>Total  : </td><td><b>Rp. $total_rp</b></td></tr>
					<tr><td colspan=6 align=right>Ongkos Kirim : 	</td><td><b> Rp. $ongkoskirim_rp</b></td></tr>      
					<tr><td colspan=6 align=right><b>Total Pembayaran </b> : </td><td ><b> Rp. $all (Kode Unik)</b></td></tr>
		</table>
		</div>";	
		$data=mysql_fetch_array(mysql_query("SELECT * FROM users"));
		echo"<div class='row-fluid margin-top'>
			<div class='span12'>
				<div class='alert alert-success'>
					<h4>Perhatian:</h4>
					<p>1. Silahkan transfer dengan jumlah nominal pada total transfer sebesar<b> Rp. $all </b></p>
					<p>2. Silahkan transfer pada rekening E-Belanja.com : <b><i class='ion-android-checkmark-circle'></i> $data[rekening] </b></p>
					<p>3. Apabila butuh bantuan kontak E-Belanja.com : <b><i class='ion-android-call'></i> Telp. $data[contact] - <i class='ion-android-mail'></i> E-mail. $data[email]</b></p>					
				</div>
			</div>
		</div>	  
		</div>";
		$edit = mysql_query("SELECT * FROM orders A LEFT JOIN
										members B ON A.memberID=B.memberID LEFT JOIN
										shipping C ON B.shippingID=C.shippingID LEFT JOIN
										courier D ON C.courierID=D.courierID
										WHERE A.orderID='$_GET[id]'
										ORDER BY A.orderID");
		$r    = mysql_fetch_array($edit);
		
		if ($r['statusOrder']=='Pending'){
			$pilihan_status = array('Dibayar');
		}
			$pilihan_order = '';
		foreach ($pilihan_status as $status) {
			$pilihan_order .= "<option value=$status";
			if ($status == $r['statusOrder']) {
				$pilihan_order .= " selected";
			}
				$pilihan_order .= ">$status</option>\r\n";
		}		
		echo"<form method=POST action='$aksi?module=paid&act=update' id='postform' name='postform' enctype='multipart/form-data'>
			<input type=hidden name=id value=$r[orderID]>
			<div class='col-sm-12 link-info'>
				<div class='panel b-a'> 
			<table class='table table-striped m-b-none'>
				<tr><td>ID Tagihan</td>        <td><font color='c30f42'>#$r[invoice]</font></td></tr>	  
				<tr><td>Tgl Order</td> <td>  $r[dateOrder]</td></tr>
				<tr><td>Pengiriman</td> <td> $r[courierName]</td></tr>
				<tr><td>Lama Pengiriman</td> <td> $r[estimateDay]</td></tr>				  
				<tr><td>Bank Transfer</td><td>
					<select name='accountBank' class='form-control no border text-grey'>";?>
						<option value='BCA' <?php if($r['accountBank']=='BCA'){echo 'selected';} ?>>BCA</option>
						<option value='BNI' <?php if($r['accountBank']=='BNI'){echo 'selected';} ?>>BNI</option>
						<option value='BRI' <?php if($r['accountBank']=='BRI'){echo 'selected';} ?>>BRI</option>
						<option value='MANDIRI' <?php if($r['accountBank']=='MANDIRI'){echo 'selected';} ?>>MANDIRI</option>	
					</select></td></tr>
				<tr><td>Jumlah transfer</td><td>
				<input class='form-control border text-grey' onKeyup='ri();' type='text' name='totalPaid' required="true" ></td></tr>	
				<tr><td>Upload Bukti Trasfer</td><td>
					<input type='file' name='fupload' size=30></td></tr>
		<?php
			echo"<tr><td>Status Order</td>
					 <td><select  class='form-control no border text-grey' name=statusOrder>$pilihan_order</select> </td></tr>
				<tr><td></td><td>
					<button type='submit' id='submit-btn' class='btn btn-black'><i class='ion-ios-checkmark-outline'></i> Simpan</button>		  
				</td></tr>
				</table></div></div></form></div></div>";		
		
		
		
    break;  
}
?>
</body>		