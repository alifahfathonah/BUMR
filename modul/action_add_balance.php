<?php
error_reporting(0);
session_start();
include "../config/koneksi.php";
include "../config/fungsi_rupiah.php";
include "../config/fungsi_url.php";

if ($_SESSION['email'] != ''){
	$sql_sort = mysql_query("SELECT A.orderInvoice FROM balance_order A ORDER BY A.orderInvoice DESC LIMIT 1");
	$num_sort = mysql_num_rows($sql_sort);	
	$data_sort = mysql_fetch_array($sql_sort);
	$start = substr($data_sort['orderInvoice'],0-5);
	$next = $start + 1;
	$ref = strlen($next);
	
	if (!$data_sort['orderInvoice']){
		$no = "00001";
	}
	elseif($ref == 1){
		$no = "0000";
	} 
	elseif($ref == 2){
		$no = "000";
	}
	elseif($ref == 3){
		$no = "00";
	}
	elseif($ref == 4){
		$no = "0";
	}
	elseif($ref == 5){
		$no = "";
	}	
	if ($num_sort == 0){
		$no_deposit = "ORD".$no;
	}
	else{
		$no_deposit = "ORD".$no.$next;
	}
	$created= date('Y-m-d H:i:s');
	$d = md5(date('Ymdhis'));
	
	
	$save=mysql_query("INSERT INTO balance_order(orderInvoice,memberID,balanceID,dateCreate,bank,total1)
				VALUES('$no_deposit','$_SESSION[useri]','$_POST[deposit]','$created','$_POST[bank]','$price')");	
				
	if ($save){
		$email_report = $_SESSION["email"];
		$subject = "Pembelian Deposit Saldo - E-Belanja.com";
		$headers = "From: no-reply@ebelanja.com \r\n";
		$headers .= "Reply-To: ". strip_tags($email_report) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
		
		$msg  = "<html><body>";
		$msg .= "<p>-- Terima kasih atas deposit Anda --</p>\r\n";
		$msg .= "<h4>Detail</h4><p>	TRX ID : $no_deposit</p>";
		$msg .= "<p>Silahkan lakukan pembayaran tagihan deposit Anda melalui akun kami di: BCA 1341520211 an E-Belanja<br><br>Deposit Anda akan dibatalkan jika tidak melakukan pembayaran selama 2 hari.</p>\r\n";
		$msg .= "<p><hr><a href='http://www.ebelanja.com'>http://www.ebelaja.com</a> - Best Solution For Your Business</p>\r\n";
		$msg .= "</body></html>";
		
		$send = mail($email_report, $subject, $msg, $headers);
	}
	header("Location:../all-balance.html?succ=ok&rc=".$no_deposit."&d=".$d);	
}
else{
	header("Location: ../login.html?err=log");
}

?>