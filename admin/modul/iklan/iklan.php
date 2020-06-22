<?php
$aksi="modul/iklan/aksi_iklan.php";
switch($_GET[act]){

  default:
  
    echo "<div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Image</th>				
				<th>Iklan </th>	
				<th>Member</th>
				<th>ID Tagihan</th>
				<th>Tgl Order</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
	  		  
    $query = "SELECT * FROM ads_order A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					ads C ON A.adsID=C.adsID
					ORDER BY A.adsOrderID ";
	$sql=mysql_query($query);
    $no = 1;
    while ($dtNew=mysql_fetch_array($sql)){	
	//$harga=format_rupiah($dtNew['balanceValue']);
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><img src="../upload/ads/<?php echo $dtNew['image1']; ?>" width='100px' height='70px'></td>	
			 <td><?php echo $dtNew['adsName']; ?></td>
			 <td><?php echo $dtNew['memberName']; ?></td>		
			 <td><?php echo $dtNew['adsInvoice']; ?></td>	
			 <td><?php echo $dtNew['adsDate']; ?></td>
			 <?php
				if($dtNew['statusAds'] == 'Selesai' ){
					echo "<td><span class='label label-success'><i class='ion-android-done-all'></i> Sukses</span></td>";
				}
				elseif($dtNew['statusAds'] == 'Waiting' ){
					echo"<td><span class='label label-danger'><i class='ion-clock'></i> Waiting</span></td>";
				}	

			 ?>

			 <td>
				<?php if($dtNew['statusAds'] == 'Selesai'){
					echo"<a href='#'>Selesai</a> | ";
				}
				else {
				echo"<a href='?app=iklan&act=editiklan&id=$dtNew[adsOrderID]'><i class='ion-compose'></i> Detail</a> | ";
				}
				?>
				<a href="<?php echo $aksi; ?>?app=iklan&act=hapus&id=<?php echo $dtNew['adsOrderID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya ?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;


  case "editiklan":
	$edit = "SELECT * FROM ads_order A LEFT JOIN
					members B ON A.memberID=B.memberID LEFT JOIN
					ads C ON A.adsID=C.adsID
					WHERE A.adsOrderID='$_GET[id]'";

	$sql = mysql_query($edit);
    $dtNew=mysql_fetch_array($sql);
	$harga=format_rupiah($dtNew['adsTotal']);
	if ($dtNew['statusAds']=='Waiting'){
        $pilihan_status = array('Selesai', 'Ditolak');    
    }
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $dtNew['statusAds']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }
	
    echo "<div class='well'>
          <form method=POST action=$aksi?app=iklan&act=update>
          <input type=hidden name=id value='$dtNew[adsOrderID]'>
		  <table class='table'>
          <tr><td>ID Transaksi</td>  <td> : $dtNew[adsInvoice]</td></tr>
		  <tr><td>Member</td> <td> : $dtNew[memberName] - $dtNew[phone]</td></tr>
          <tr><td>Deposit saat ini</td>        <td> : $harga</td></tr>		  
          <tr><td>Tgl Order</td> <td> : $dtNew[adsDate]</td></tr>	  
          <tr><td>Status Order      </td><td>: <select name='statusAds' >$pilihan_order</select> </td></tr>
		  <tr><td>Harga</td> <td> : <input type='text' name='adsValue' value='$dtNew[adsPrice]'></td></tr>		
		  <tr><td colspan=2> <input class='btn btn-primary' type=submit value='Proses'></td></tr>";

			 echo" </table></form></div>";
			 

	  
    break;  
}
?>
