<?php
$aksi="modul/bukadompet/aksi_bukadompet.php";
switch($_GET[act]){

  default:
  
    echo "<div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Member </th>	
				<th>Jml Penarikan</th>
				<th>Sisa</th>
				<th>Tgl Masuk</th>
				<th>Status</th>
				<th></th><tbody>
		  </tr>"; 
	  		  
    $query = "SELECT * FROM withdraw A LEFT JOIN
						orders B ON A.orderID=B.orderID LEFT JOIN
						products C ON C.productID=B.productID LEFT JOIN
						members D ON C.memberID=D.memberID  
						ORDER BY A.withdrawID";
	$sql=mysql_query($query);
    $no = 1;
    while ($dtNew=mysql_fetch_array($sql)){	
	$tarik=format_rupiah($dtNew['tagDraw']);
	$penghasilan=format_rupiah($dtNew['incomeDraw']);
	$sisa=format_rupiah($dtNew['totalDraw']);
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtNew['memberName']; ?></td>
			 <td>Rp.<?php echo $tarik ?></td>		
			 <td>Rp.<?php echo $sisa; ?></td>	
			 <td><?php echo $dtNew['dateCreate']; ?></td>
			 <?php
				if($dtNew['statusDraw'] == 'Pending' ){
					echo "<td><span class='label label-info'><i class='ion-refresh'></i> Pending</span></td>";
				}	
				if($dtNew['statusDraw'] == 'Waiting' ){
					echo "<td><span class='label label-info'><i class='ion-refresh'></i> Waiting</span></td>";
				}					
				elseif($dtNew['statusDraw'] == 'Diterima' ){
					echo "<td><span class='label label-danger'><i class='ion-loop'></i> Diterima</span></td>";
				}					
				else{
					echo"<td><span class='label label-success'><i class='ion-checkmark'></i> Selesai</span></td>";
				}
			 ?>

			 <td>
				<?php if($dtNew['statusDraw'] == 'Selesai'){
					echo"<a href='#'>Selesai</a> | ";
				}
				else {
				echo"<a href='?app=bukadompet&act=editdompet&id=$dtNew[withdrawID]'><i class='ion-compose'></i> Detail</a> | ";
				}
				?>
				<a href="<?php echo $aksi; ?>?app=bukadompet&act=hapus&id=<?php echo $dtNew['withdrawID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya ?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;


  case "editdompet":
	$edit = "SELECT * FROM withdraw A LEFT JOIN
						orders B ON A.orderID=B.orderID LEFT JOIN
						products C ON C.productID=B.productID LEFT JOIN
						members D ON C.memberID=D.memberID  
					WHERE A.withdrawID='$_GET[id]' ORDER BY A.withdrawID";
	$sql = mysql_query($edit);
    $dtNew=mysql_fetch_array($sql);
	$penarikan=format_rupiah($dtNew['tagDraw']);
	$sisa=format_rupiah($dtNew['totalDraw']);
	$awal=format_rupiah($dtNew['incomeDraw']);	
	$tanggal=tgl_indo($dtNew['dateCreate']); 
	
    if ($dtNew['statusDraw']=='Waiting'){
        $pilihan_status = array('Diterima', 'Ditolak');
    }
    elseif ($dtNew['statusDraw']=='Diterima'){
        $pilihan_status = array('Selesai', 'Ditolak');
    }	
    elseif ($dtNew['statusDraw']=='Selesai'){
        $pilihan_status = array('Selesai', 'Dikembalikan');    
    }
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $dtNew['statusDraw']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }
	
    echo "<div class='well'>
          <form method=POST action=$aksi?app=bukadompet&act=update>
          <input type=hidden name=id value='$dtNew[withdrawID]'>
		  <table class='table'>
          <tr><td>Tgl Penarikan</td>  <td> : $tanggal</td></tr>
		  <tr><td>Member</td> <td> : $dtNew[memberName] - $dtNew[phone]</td></tr>
          <tr><td>Penarikan</td>        <td> : $penarikan</td></tr>		  
          <tr><td>Sisa</td> <td> : $sisa</td></tr>	";
          echo"<tr><td>Status   </td><td>: <select name='statusDraw' >$pilihan_order</select> </td></tr>
		 
		  <tr><td colspan=2> <input class='btn btn-primary' type=submit value='Proses'></td></tr>";

			 echo" </table></form></div>";
			 

	  
    break;  
}
?>
