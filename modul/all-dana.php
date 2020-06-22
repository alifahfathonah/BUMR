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
$query=mysql_query("SELECT * FROM withdraw A LEFT JOIN
					orders B ON A.orderID=B.orderID LEFT JOIN
					products C ON C.productID=B.productID LEFT JOIN
					members D ON C.memberID=D.memberID
					WHERE A.customerID!='$_SESSION[useri]'
					ORDER BY A.withdrawID");
$no =1;	
echo "<div id='content' class='main-content bg-lights'>
<div class='container'><div class='m-t-md'></div>
				<div class='row'>
					<div class='col-sm-9 link-info'>
						<div class='panel b-a'>";
						$full_url = full_url();
						if (strpos($full_url, "?succ=ok") == TRUE){
							echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong><i class='ion-checkmark-circled'></i> Silahkan tunggu, permintaan penarikan dana dalam proses</strong>
							</div>";
						}			
						if (strpos($full_url, "?err=ok") == TRUE){
							echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong><i class='ion-alert-circled'></i> Password anda tidak valid</strong>
							</div>";
						}						
						echo"<table class='table table-striped m-b-none'>
							<thead class='panel-heading b-b b-light'>
								<tr>
									<th>#</th>	
									<th>Member</th>
									<th>Tgl Penarikan</th>								
									<th>Jumlah Penarikan</th>
									<th>Sisa</th>
									<th>Status</th>
								</tr></thead><tbody>";
							while($data = mysql_fetch_array($query)){
								$tanggal=tgl_indo($data['dateCreate']);
								$total = format_rupiah($data['totalDraw']);	
								$tag= format_rupiah($data['tagDraw']);									
								$tot+=$data['total'];
								if($data['statusDraw']=='Waiting'){
									$status = "<span class='label label-info'><i class='ion-alert-circled'></i> On Proses</span>";
								}
								elseif($data['statusDraw']=='Selesai'){
									$status = "<span class='label label-success'><i class='ion-android-done'></i> Selesai</span>";
								}								
							echo"<tr>
								<td>$no</td>	
								<td>$data[memberName]</td>
								<td>$tanggal</td>						
								<td>$tag</td>
								<td>$total</td>
								<td>$status</td>
								</tr>
							";
								
							$no++;
							}
echo"
					</table></div></div>
					
					<div class='col-sm-3 link-info'>
					<div class='panel b-a'>";
						$query="SELECT dateFinish
								FROM withdraw
								WHERE withdrawID='$_GET[id]'
								ORDER BY 1 DESC
								LIMIT 0,12";
						$result=mysql_query($query);
						while($row=mysql_fetch_array($result))
						{
							echo "<a href='payroll-salary-edit.php?PRSN_NBR=".$PrsnNbr."&PYMT_DTE=".$row['PYMT_DTE']."'>
							<div class='leftsubmenu'>".$row['dateFinish']."</div></a>";
						}					
					echo"</div>
					</div>
					
					</div></div></div>";	
	


?>