<link rel="stylesheet" type="text/css" media="all" href="js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type="text/javascript" src="js/chat.js"></script>
<script type="text/javascript" src="css/chat.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>



	<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
	</div>
	<div class="container m-t-md">
	<div class="row"><div class="col-sm-12 link-in">
		<div class="panel b-a">
			<div class="panel-heading b-b b-light">
					<span class="font-bold"><i class="ion-chatbox-working m-r-xs"></i> Pesan</span>
			</div>		
			<div class="panel-body link-info">
		<?php
		$nm = md5(date('Ymdhis'));
		$full_url = full_url();
		if (strpos($full_url, "?succ=ok") == TRUE){
			echo "<div class='messagesuccess' style='width: auto;'><p><b>Your ads successfully saved and in moderation proccessing.<br>
					Your ads will activate and show in site after pass our review in 24 hours. Good Luck!</b></p></div>";
		}
		mysql_query("UPDATE chat SET recd = 1 WHERE chat_id = '$_GET[id]'");
		$num_messages_inbox = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_to = '$_SESSION[useri]' AND status = 0"));
		$num_messages_inbox_all = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_to = '$_SESSION[useri]'"));
		$num_messages_sentitem = mysql_num_rows(mysql_query("SELECT * FROM chat WHERE chat_from = '$_SESSION[useri]'"));
		?>

			<?php
	
				$data_messages = mysql_fetch_array(mysql_query("SELECT B.username, A.sent, B.memberID, A.message, B.photo,A.chat_id
																		FROM chat A INNER JOIN 
																			members B ON B.memberID = A.chat_from
																		WHERE A.chat_id = '$_GET[id]'"));
				if ($data_messages['photo'] != ''){
					$photo = "<img src='upload/member/$data_messages[photo]' width='60' height='70' style='border-radius: 8px; border: 2px solid #CCCCCC;'>";
				}
				else{
					$photo = "<img src='static/img/fb.jpg' width='60' height='70' style='border-radius: 8px; border: 2px solid #CCCCCC;'>";
				}
			?>    <br>
			    <table border="0" width="100%" class="tr" cellspacing="0">
			    	<tr>
			    		<td width='70' rowspan="4"><?php echo $photo; ?></td>
			    		<td width='60'>Tanggal</td>
			    		<td width='10'>:</td>
			    		<td><b><?php echo $data_messages['sent']; ?></b></td>
			    	</tr>
			    	<tr>
			    		<td>Dari</td>
			    		<td>:</td>
			    		<td><b><a href='profile-<?php echo $data_messages['memberID']; ?>-1-1-1-<?php echo $data_messages['username']; ?>.html' class='black'><?php echo $data_messages['username']; ?></a></b></td>
			    	</tr>
			    	<tr>
			    		<td>Pesan</td>
			    		<td>:</td>
			    		<td><b><?php echo $data_messages['message']; ?></b></td>
			    	</tr>
				</table><br>
					<a href='javascript:history.go(-1)'><button type='button' class='btn btn-black'><i class="ion-arrow-left-a"></i> Kembali</button></a>	
				</div>

	</div>
	
	</div></div>
</div>