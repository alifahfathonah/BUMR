<script>
	function checkAll(bx) {
		var cbs = document.getElementsByTagName('input');
		for(var i=0; i < cbs.length; i++) {
			if(cbs[i].type == 'checkbox') {
				cbs[i].checked = bx.checked;
			}
		}
	}
</script>
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
$aksi="modul/action_chat.php";
?>	
  <div id="content" class="main-content bg-lights"><div class="container">
	<div class="m-t-md"></div>
		<div class="col-sm-12 ">
		<div class="row row-sm">
			<?php
			$full_url = full_url();
			if (strpos($full_url, "?succ=ok") == TRUE){
				echo "<div class='messagesuccess' style='width: auto;'><p><b>Your ads successfully saved and in moderation proccessing.<br>
						Your ads will activate and show in site after pass our review in 24 hours. Good Luck!</b></p></div>";
			}
			if (strpos($full_url, "?suc=delete") == TRUE){
				echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>
						<strong><i class='ion-android-done-all'></i> Sukses!</strong> chat anda berhasil dihapus
						</div>";		
			}			
			$num_messages_inbox = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_to = '$_SESSION[useri]' AND status = 0"));
			$num_messages_inbox_all = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_to = '$_SESSION[useri]'"));
			$num_messages_sentitem = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_from = '$_SESSION[useri]'"));
			?>

			
			<div id='myTabContent' class='tab-content'>
				<div class='tab-pane active in' id='in'>
					<div class="container m-t-md">
						<div class="row">
						
							<div class="panel b-a ">
							<div class='panel-heading b-b b-light'>
								<span class='font-bold'><i class='ion-chatbox-working'></i> Pesan</span>
							</div>	

							<form method='POST' action='modul/mod_messages/action_del_inbox.php'>    
							<table class="table table-striped m-b-none">
								<thead class="panel-heading b-b b-light">
									<th>#</th>
									<th>Tanggal</th>
									<th>Dari</th>
									<th>Pesan</th>
									<th>Aksi</th>
								</tr>	</thead><tbody>						
							<?php
							$p      = new Paging;
							$batas  = 10;
							$posisi = $p->cariPosisi($batas);	
				
								
								$sql_ads = mysql_query("SELECT A.chat_id, B.memberID, A.sent, B.username, A.recd, A.message, 
												A.chat_to, A.chat_from,B.email FROM chat A 
												INNER JOIN members B ON B.memberID = A.chat_from
												WHERE A.chat_to = '$_SESSION[useri]' ORDER BY A.sent ");
								$no = $posisi+1;
								$num_ads = mysql_num_rows($sql_ads);
								while ($data_ads =mysql_fetch_array($sql_ads)){
								if ($data_ads['recd'] == 1){
									echo "<tr>
										<td>$no</td>
										<td>$data_ads[sent]</td>
										<td>$data_ads[username]</td>
										<td>$data_ads[message]</td>";
								}
								else{
									echo "<tr>
										<td><b>$no</b></td>
										<td><b>$data_ads[sent]</b></td>
										<td><b>$data_ads[username]</b></td>
										<td><b>$data_ads[message]</b></td>";
								}			
								echo "	<td>
											<a href='read-chat-1-$data_ads[chat_id].html' class='text-sm'><i class='fa fa-eye' aria-hidden='true'></i></a> |
											<a href='$aksi?module=other-pro&act=hapus&id=$data_ads[chat_id]' class='text-sm' onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">
												<i class='ion-trash-b'></i> </a>
										</td>
									</tr>";
								$no++;	
								}
								?>
							</tbody></table>
							</div>
							<?php
							if ($num_ads > 0){
								echo "<input type='submit' name='submit' class='btn btn-black' value='Hapus'>";
							}
							?>	
							</form>
							<?php
							$jmldata = mysql_num_rows(mysql_query("SELECT * FROM as_chat"));
							$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
							$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

							echo "<div class='text-right m-b-sm'>
								<ul class='pagination pagination-md'>
									<li><a href='#'>Halaman : $linkHalaman </a></li>
								</ul></div>";								
							?>		
							
						</div>
					</div>
					</div>
				
					
					
					
			</div>
		</div>
		</div>
	</div>
</div>	
</div>