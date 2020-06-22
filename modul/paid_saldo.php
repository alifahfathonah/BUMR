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
<?php
session_start();
$aksi="modul/action_update_saldo.php";
switch($_GET[act]){
  default:
  echo"
	<div class='container m-t-md'>
		<div class='row'>
			<div class='col-sm-12 link-info'>
				<div class='panel b-a'> ";
					$sql=mysql_query("SELECT * FROM balance_order A 
													INNER JOIN balance B ON B.balanceID=A.balanceID
													WHERE A.balanceOrderID='$_GET[id]'
													ORDER BY A.balanceOrderID");
				$s=mysql_fetch_array($sql);
					$price = format_rupiah($s['balancePrice']);
					$deposit = format_rupiah($s['balanceValue']);				
					$date=date('Y-m-d H:i:s');	
					
    if ($s['statusDeposit']=='Pending'){
        $pilihan_status = array('Dibayar');
    }
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $s['statusDeposit']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

	
				echo"<form method=POST action='$aksi?module=paidsaldo&act=update' id='postform' name='postform' enctype='multipart/form-data'>
					<input type=hidden name=id value=$s[balanceOrderID]>
				
					 <table class='table table-striped m-b-none'>
						<tr><td>No. Transaksi</td><td> $s[orderInvoice]</td></tr>
						<tr><td>Deposit</td><td><span class='label label-info'>Rp. $deposit</span></td></tr>
						<tr><td>Transfer Pembayaran</td><td>Bank $s[bank]</td></tr>		
						<tr><td>Aksi</td><td>
							<select  class='form-control no border text-grey' name=statusDeposit>$pilihan_order</select>
						</td></tr>	
						<tr><td>Nama Penyetor</td><td><input type='text' class='form-control no border text-grey' name='depoName'></td></tr>
						<tr><td>Bukti Transfer</td><td><input type='file' name='fupload' size=30></td></tr>
						<tr><td></td><td>
							<button type='submit' id='submit-btn' class='btn btn-black'><i class='ion-ios-checkmark-outline'></i> Bayar</button>		  
						</td></tr>";						
					
				echo"</table></form>
			</div>
		</div>
	</div>";

   break;  
	
}
?>	