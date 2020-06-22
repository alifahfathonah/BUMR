<?php
$aksi="modul/supplier/aksi_supplier.php";
switch($_GET[act]){

  default:
  
    echo "<div class='btn-toolbar'>	
			 <a href='?app=supplier&act=tambahsupplier' data-toggle='modal' class='btn btn-primary'><i class='icon-plus'></i> Baru</a>			
          </div><div class='well'>
			<table class='table'>
                <thead><tr>
				<th>#</th>	
				<th>Nama Supplier </th>	
				<th>Alamat</th>
				<th>Kontak</th>
				<th>Telp</th>
				<th ></th><tbody>
		  </tr>"; 
	  		  
    $querySupplier = "SELECT * FROM suppliers ORDER BY supplierID DESC";
	$sqlSupplier=mysql_query($querySupplier);
    $no = 1;
    while ($dtSupplier=mysql_fetch_array($sqlSupplier)){	
	?>
       <tr><td class='data' width='30px'><?php echo $no; ?></td>
             <td><?php echo $dtSupplier['supplierName']; ?></td>
			 <td><?php echo $dtSupplier['address']; ?></td>		
			 <td><?php echo $dtSupplier['contactPerson']; ?></td>
			 <td><?php echo $dtSupplier['phone']; ?></td>
			 <td><a href='?app=supplier&act=editsupplier&id=<?php echo $dtSupplier['supplierID']; ?>'><i class='ion-compose'></i> Edit</a> |
				<a href="<?php echo $aksi; ?>?app=supplier&act=hapus&id=<?php echo $dtSupplier['supplierID']; ?>"  onClick="return confirm('Apakah Anda benar-benar mau menghapusnya <?php echo $r['supplierName']; ?>?');">
				<i class='ion-trash-b'></i> Hapus</a>
             </td></tr>
	<?php
		$no++;
    }
    echo "</tbody></table></div>";
	
    break;
  
  case "tambahsupplier":
    echo "<div class='well'>
          <form method=POST action='$aksi?app=supplier&act=input'>
			<label>Nama Supplier</label>
			<input type='text' name='supplierName' class='input-xlarge' />	
			<label>Alamat</label>
			<input type='text' name='address' class='input-xlarge' />
			<label>Telp</label>
			<input type='text' name='phone' class='input-xlarge' />	
			<label>Kontak Person</label>
			<input type='text' name='contactPerson' class='input-xlarge' />	
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
     break;

  case "editsupplier":
    $querySupplier = "SELECT * FROM suppliers WHERE supplierID='$_GET[id]'";
	$sqlSupplier = mysql_query($querySupplier);
    $dtSupplier=mysql_fetch_array($sqlSupplier);

    echo "<div class='well'>
          <form method=POST action=$aksi?app=supplier&act=update>
          <input type=hidden name=id value='$dtSupplier[supplierID]'>
			<label>Nama Supplier</label>
			<input type='text' name='supplierName' value='$dtSupplier[supplierName]' class='input-xlarge' />		
			<label>Alamat</label>
			<input type='text' name='address' value='$dtSupplier[address]' class='input-xlarge' />		
			<label>Telp</label>
			<input type='text' name='phone' value='$dtSupplier[phone]' class='input-xlarge' />	
			<label>Kontak Person</label>
			<input type='text' name='contactPerson' value='$dtSupplier[contactPerson]' class='input-xlarge' />			
			<div class='btn-toolbar'>
				<button class='btn btn-primary'><i class='icon-save'></i> Simpan</button>
				<input class='btn btn-primary' type='button' value='Kembali' onclick='javascript:history.go(-1)'>Kembali				
			  <div class='btn-group'></div>
			</div>
          </form></div>";
    break;  
}
?>
