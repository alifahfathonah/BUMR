<?php
$aksi="modul/finish/aksi_finish.php";
switch($_GET[act]){

  default:
  
    echo "<div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Kustomer </th>	
				<th>ID Transaksi</th>
				<th>Produk</th>
				<th>Tgl Order</th>
				<th>Tgl Selesai</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
	  		  
    $query = "SELECT * FROM orders A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					products C ON A.productID=C.productID
					ORDER BY A.orderID ";
	$sql=mysql_query($query);
    $no = 1;
    while ($dtNew=mysql_fetch_array($sql)){	

	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtNew['memberName']; ?></td>
			 <td><?php echo $dtNew['invoice']; ?></td>		
			 <td><?php echo $dtNew['productName']; ?></td>	
			 <td><?php echo $dtNew['dateOrder']; ?></td>
			 <td><?php echo $dtNew['dateFinish']; ?></td>
			 <?php
				if($dtNew['statusOrder'] == 'Dikembalikan' ){
					echo "<td><span class='label label-danger'><i class='ion-alert-circled'></i> Komplain</span></td>";
				}
				elseif($dtNew['statusOrder'] == 'Dikirim' ){
					echo"<td><span class='label label-success'><i class='ion-paper-airplane'></i> Dikirim</span></td>";
				}
				elseif($dtNew['statusOrder'] == 'Diterima' ){
					echo"<td><span class='label label-success'><i class='ion-android-checkmark-circle'></i> Selesai</span></td>";
				}				
			 ?>

			 <td><a href='?app=new&act=editnew&id=<?php echo $dtNew['orderID']; ?>'><i class='ion-compose'></i> Edit</a> 
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;


  case "editnew":
	$edit = "SELECT * FROM orders A LEFT JOIN
						members B ON A.memberID=B.memberID LEFT JOIN
						shipping C ON B.shippingID=C.shippingID LEFT JOIN
						courier D ON C.courierID=D.courierID LEFT JOIN
						products E ON A.productID = E.productID
						WHERE A.orderID='$_GET[id]'";
	$sql = mysql_query($edit);
    $dtNew=mysql_fetch_array($sql);
    if ($dtNew['statusOrder']=='Pending'){
        $pilihan_status = array('Pending', 'Ditolak', 'Dibayar');
    }
    elseif ($dtNew['statusOrder']=='Dikirim'){
        $pilihan_status = array('Diterima', 'Dikembalikan');    
    }	
    elseif ($dtNew['statusOrder']=='Dibayar'){
        $pilihan_status = array('Dikirim', 'Dikembalikan');    
    }
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $dtNew['statusOrder']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }
	
    echo "<div class='well'>
          <form method=POST action=$aksi?app=new&act=update>
          <input type=hidden name=id value='$dtNew[orderID]'>
		  <table class='table'>
          <tr><td>ID Transaksi</td>  <td> : $dtNew[invoice]</td></tr>
		  <tr><td>Member</td> <td> : $dtNew[memberName] - $dtNew[phone]</td></tr>
          <tr><td>Produk</td>        <td> : $dtNew[productName]</td></tr>		  
          <tr><td>Tgl Order</td> <td> : $dtNew[dateOrder]</td></tr>
          <tr><td>Pengiriman</td> <td> : $dtNew[courierName] - $dtNew[estimateDay]</td></tr>		  
          <tr><td>Status Order      </td><td>: <select name='statusOrder' >$pilihan_order</select> 
         
		 </td></tr>
		  <tr><td colspan=2> <input class='btn btn-primary' type=submit value='Proses'></td></tr>";
			if($r['gambar'] !=''){
			  echo"<tr><td>Bukti Transfer</td><td><img src='../static/foto_kategori/$r[gambar]' width='250' style='border-radius: 10px; border: 3px solid #ccc;'></td></tr>";
			}
			else{
			 echo"<tr><td>Bukti Transfer</td><td><b>TIDAK ADA BUKTI TRANSFER!</b></td></tr>";
			}
			 echo" </table></form></div>";
			 
	$sql2=mysql_query("SELECT * FROM orders_detail A LEFT JOIN
						products B ON A.productID=B.productID 
						WHERE A.orderID = '$_GET[id]'");
	echo "<table class='table'>
			<tr><th>Nama Produk</th>
				<th>Berat(kg)</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Sub Total</th>
			</tr>";
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

		echo"<tr><td>$s[productName]</td>
				  <td>$s[weight]</td>
				  <td>$s[quantity]</td>
				  <td>$harga</td>
				  <td>$subtotal_rp</td>
			 </tr>";
	  }
		$ongkos=mysql_fetch_array(mysql_query("SELECT * FROM orders A LEFT JOIN
												members B ON A.memberID=B.memberID LEFT JOIN
												shipping C ON C.shippingID=B.shippingID
												WHERE A.orderID='$_GET[id]'"));
		$ongkoskirim1=$ongkos['shippingCost'];
		$ongkoskirim=$ongkoskirim1 * $totalberat;
		$grandtotal    = $total + $ongkoskirim; 

		$ongkoskirim_rp = format_rupiah($ongkoskirim);
		$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
		$grandtotal_rp  = format_rupiah($grandtotal); 
		$all = format_rupiah($ongkos['totalOrder']);
		echo "<tr><td colspan=4 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>     
				<tr><td colspan=4 align=right>Total Ongkos Kirim Rp. : </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
				<tr><td colspan=4 align=right>Grand Total        Rp. : </td><td align=right><b>$all (Kode Unik)</b></td></tr>
		</table>";
	  
    break;  
}
?>
