<?php
$aksi="modul/kadeposit/aksi_kadeposit.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=kadeposit&act=tambahkadeposit' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Deposit </th>		
				<th>Harga</th>
				<th ></th><tbody>
		  </tr>"; 
	  		  
    $queryCategory = "SELECT * FROM balance ORDER BY balanceID DESC";
	$sqlCategory=mysql_query($queryCategory);
    $no = 1;
    while ($dtCategory=mysql_fetch_array($sqlCategory)){	
	$nilai=format_rupiah($dtCategory['balanceValue']);
	$harga=format_rupiah($dtCategory['balancePrice']);	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $nilai; ?></td>	
			 <td>Rp.<?php echo $harga; ?></td>	
			 <td><a href='?app=kadeposit&act=editkadeposit&id=<?php echo $dtCategory['balanceID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=kadeposit&act=hapus&id=<?php echo $dtCategory['balanceID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya ');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahkadeposit":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=kadeposit&act=input' enctype='multipart/form-data'>
			<label>Deposit </label>
			<input type='text' name='balanceValue' class='input-xlarge' />	
			<label>Harga</label>
			<input type='text' name='balancePrice' class='input-xlarge' />	
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editkadeposit":
    $queryCategory = "SELECT * FROM balance WHERE balanceID='$_GET[id]'";
	$sqlCategory = mysql_query($queryCategory);
    $dtCategory=mysql_fetch_array($sqlCategory);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=kadeposit&act=update>
          <input type=hidden name=id value='$dtCategory[balanceID]'>
			<label>Deposit</label>
			<input type='text' name='balanceValue' value='$dtCategory[balanceValue]' class='input-xlarge' />		
			<label>Harga</label>
			<input type='text' name='balancePrice' value='$dtCategory[balancePrice]' class='input-xlarge' />			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
