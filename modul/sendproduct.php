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
session_start();
$aksi="modul/action_send_product.php";
switch($_GET[act]){
  default:
  echo"
	<div class='container m-t-md'>
		<div class='row'>";
		$edit = mysql_query("SELECT * FROM orders A LEFT JOIN
											members B ON A.memberID=B.memberID LEFT JOIN
											cities C ON B.cityID=C.cityID LEFT JOIN
											shipping D ON B.shippingID=D.shippingID LEFT JOIN
											courier E ON D.courierID=E.courierID
											WHERE A.orderID='$_GET[id]'");
		$r    = mysql_fetch_array($edit);
		$tanggal=tgl_indo($r['dateOrder']);
		
		if ($r['statusOrder']=='Pending'){
			$pilihan_status = array('Dikirim','Dikembalikan');
		}
		$pilihan_order = '';
		foreach ($pilihan_status as $status) {
		   $pilihan_order .= "<option value=$status";
		   if ($status == $r['statusOrder']) {
				$pilihan_order .= " selected";
		   }
		   $pilihan_order .= ">$status</option>\r\n";
		}
		echo "
          <form method=POST action='$aksi?module=send&act=update' id='postform' name='postform'>
          <input type=hidden name=id value=$r[orderID]>
			<div class='col-sm-12 link-info'>
				<div class='panel b-a'> 
          <table class='table table-striped m-b-none'>
          <tr><td>No. Tagihan</td>        <td> $r[invoice]</td></tr>
          <tr><td>Tgl Order</td> <td>  $tanggal</td></tr>
          <tr><td>Alamat Pengirim</td> <td> $r[memberName]</td></tr>		  
          <tr><td>Alamat Pengirim</td> <td> $r[address]</td></tr>
		  <!--<tr><td>Pengiriman</td> <td> $r[courierName] - $r[shippingGo] | Lama Pengiriman : $r[estimateDay] Hari</td></tr>-->";
		?>
		<?php
			echo"<tr><td>Status Sekarang     </td><td><span class='label label-info'>$r[statusOrder]</span></td></tr>";
			//echo"<tr><td>No. Resi     </td><td><input type='text' class='form-control no border text-grey' name='resi'> </td></tr>";
			echo"<tr><td>Aksi   </td><td><select  class='form-control no border text-grey' name='statusOrder'>$pilihan_order</select> </td></tr>";
			echo"<tr><td colspan=2>
			<button type='submit' id='submit-btn' class='btn btn-black'><i class='ion-ios-checkmark-outline'></i> Kirim Barang</button>		  
			</td></tr>
			</table></div></div></form>";		
		?>	

		<?php	
		echo"<div class='col-sm-12 link-info'>
					<div class='panel b-a'>  ";
			$data=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
		?>
		<div class='row-fluid margin-top'>
			<div class='span12'>
				<div >
					<h4>Perhatian:</h4>
					<p>1. Silahkan proses pesanan barang anda ke pelanggan</b></p>
					<!--<p>2. Produk akan dibatalkan apabila tidak diproses selama 2 hari </p>-->
					
				</div>
			</div>
		</div>	  
		</div>			
<?php		  
	echo"</div></div>";	  
    break;  

}
?>