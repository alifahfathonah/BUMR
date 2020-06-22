
<script type="text/javascript">
	function getInt(objectID)
	{
		if(document.getElementById(objectID).value=="")
		{
			return 0;
		}else{
			return parseInt(document.getElementById(objectID).value);
		}
	}
	function calcPay(){
		document.getElementById('totalDraw').value=getInt('incomeDraw')-getInt('tagDraw');
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
$dana = mysql_fetch_array(mysql_query("SELECT * FROM withdraw A LEFT JOIN
						orders B ON A.orderID=B.orderID LEFT JOIN
						products C ON C.productID=B.productID LEFT JOIN
						members D ON C.memberID=D.memberID
						WHERE A.withdrawID='$_GET[id]' AND A.customerID != '$_SESSION[useri]'  
						ORDER BY A.withdrawID"));

echo"<div id='content' class='main-content bg-lights'><div class='container'>
		<div class='m-t-md'></div>
			<div class='row'>
			<form method=POST action='modul/action_withdraw.php' enctype='multipart/form-data' onSubmit='return checkform();'>		
				<input type='hidden' name='id' value='$dana[withdrawID]' />		
					<div class='col-sm-8 link-info'>
						<div class='panel panel-default'>
							<div class='panel-heading font-bold'>Penarikan Dana</div>";
							echo"<div class='panel-body'>
									<div class='form-group'>
									<div class='panel-heading font-bold'>No. Rekening : $dana[memberName] - $dana[rekening]</div>
									</div>
									<div class='form-group'>
										<label class='col-lg-3 control-label'>Tgl Pencairan</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' name='dateFinish' value='$dana[dateFinish]'>
											<span class='help-block'></span>
										</div>
									</div>									
									<div class='form-group'>
										<label class='col-lg-3 control-label'>BukaDompet</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' id='incomeDraw' onkeyup='calcPay();' name='incomeDraw' value='$dana[incomeDraw]' DISABLED>
											<span class='help-block'></span>
										</div>
									</div>	
									<div class='form-group'>
										<label class='col-lg-3 control-label'>Dana Dicairkan</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' onkeyup='calcPay();' id='tagDraw' name='tagDraw' value='$dana[tagDraw]'>
											<span class='help-block'></span>
										</div>
									</div>		
									<div class='form-group'>
										<label class='col-lg-3 control-label'>Sisa</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='text' id='totalDraw' name='totalDraw' value='$dana[totalDraw]' DISABLED>
											<span class='help-block'></span>
										</div>
									</div>	
									<div class='form-group'>
										<label class='col-lg-3 control-label'>Password Anda</label>
										<div class='col-lg-10'>
											<input class='form-control text-sm' type='password' name='pass_ulangi'>
											<span class='help-block'></span>
										</div>
									</div>										
									<div class='form-group'>
										<div class='col-sm-4 col-sm-offset m-t-md'>
											<input type='hidden' name='upload' value='yes'/>
											<button type='submit' id='submit-btn' class='btn btn-black'> Proses</button>
											<a href='javascript:history.go(-1)'><button type='button' class='btn btn-black'> Kembali</button></a>											
										</div>
									</div>									
								</div>
							</div>
						</div>
					</div>
			</form>
			</div>
		</div>
	</div>";	

									
?>