<?php
$aksi="modul/deposit/aksi_deposit.php";
switch($_GET[act]){

  default:
  
    echo "<div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Kustomer </th>	
				<th>ID Tagihan</th>
				<th>Deposit</th>
				<th>Tgl Order</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
	  		  
    $query = "SELECT * FROM balance_order A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					balance C ON A.balanceID=C.balanceID
					ORDER BY A.balanceOrderID ";
	$sql=mysql_query($query);
    $no = 1;
    while ($dtNew=mysql_fetch_array($sql)){	
	$harga=format_rupiah($dtNew['balanceValue']);
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtNew['memberName']; ?></td>
			 <td><?php echo $dtNew['orderInvoice']; ?></td>		
			 <td><?php echo $harga; ?></td>	
			 <td><?php echo $dtNew['dateCreate']; ?></td>
			 <?php
				if($dtNew['statusDeposit'] == 'Dibayar' ){
					echo "<td><span class='label label-info'><i class='ion-clock'></i> Dibayar</span></td>";
				}
				elseif($dtNew['statusDeposit'] == 'Pending' ){
					echo"<td><span class='label label-warning'><i class='ion-clock'></i> Pending</span></td>";
				}	
				else{
					echo"<td><span class='label label-success'><i class='ion-checkmark'></i> Selesai</span></td>";
				}
			 ?>

			 <td>
				<?php if($dtNew['statusDeposit'] == 'Selesai'){
					echo"<a href='#'>Selesai</a> | ";
				}
				else {
				echo"<a href='?app=deposit&act=editdeposit&id=$dtNew[balanceOrderID]'><i class='ion-compose'></i> Detail</a> | ";
				}
				?>
				<a href="<?php echo $aksi; ?>?app=deposit&act=hapus&id=<?php echo $dtNew['balanceOrderID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya ?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;


  case "editdeposit":
	$edit = "SELECT * FROM balance_order A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					balance C ON A.balanceID=C.balanceID
					WHERE A.balanceOrderID='$_GET[id]'";
	$sql = mysql_query($edit);
    $dtNew=mysql_fetch_array($sql);
	$harga=format_rupiah($dtNew['balanceValue']);
    if ($dtNew['statusDeposit']=='Pending'){
        $pilihan_status = array('Pending', 'Ditolak', 'Dibayar');
    }
    elseif ($dtNew['statusDeposit']=='Dibayar'){
        $pilihan_status = array('Selesai', 'Dikembalikan');    
    }
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $dtNew['statusDeposit']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }
	
    echo "<div class='well'>
          <form method=POST action=$aksi?app=deposit&act=update>
          <input type=hidden name=id value='$dtNew[balanceOrderID]'>
		  <table class='table'>
          <tr><td>ID Transaksi</td>  <td> : $dtNew[orderInvoice]</td></tr>
		  <tr><td>Member</td> <td> : $dtNew[memberName] - $dtNew[phone]</td></tr>
          <tr><td>Deposit</td>        <td> : $harga</td></tr>		  
          <tr><td>Tgl Order</td> <td> : $dtNew[dateCreate]</td></tr>	
          <tr><td>Nama Penyetor</td> <td> : $dtNew[depoName]</td></tr>	";
			if($dtNew['photoD'] !=''){
			  echo"<tr><td>Bukti Transfer</td><td>
			  <img src='../upload/bukti/$dtNew[photoD]' width='250' style='border-radius: 10px; border: 3px solid #ccc;'></td></tr>";
			}
			else{
			 echo"<tr><td>Bukti Transfer</td><td><b>TIDAK ADA BUKTI TRANSFER!</b></td></tr>";
			}		  
		  
          echo"<tr><td>Status Order      </td><td>: <select name='statusDeposit' >$pilihan_order</select> </td></tr>
		  <tr><td>Harga</td> <td> : <input type='text' name='total1' value='$dtNew[balancePrice]'></td></tr>
		  <tr><td colspan=2> <input class='btn btn-primary' type=submit value='Proses'></td></tr>";

			 echo" </table></form></div>";
			 

	  
    break;  
}
?>
