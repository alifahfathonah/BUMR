<div class="b-b bg-light">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
</div>
<?php
$queryProfile="SELECT * FROM members A LEFT JOIN
			provinces B ON A.provinceID=B.provinceID LEFT JOIN
			cities C ON A.cityID=C.cityID LEFT JOIN
			shipping D ON A.shippingID=D.shippingID LEFT JOIN
			courier E ON D.courierID=E.courierID
		WHERE A.memberID = '$_SESSION[useri]'
		ORDER BY A.memberID";
$sqlProfile = mysql_query($queryProfile);
$r=mysql_fetch_array($sqlProfile);
$login = date('Y-m-d H:i:s');
	if ($r['gender'] == 'L'){
		$checka = 'checked';
	}
	elseif($r['gender'] == 'P'){
		$checkb = 'checked';
	}
	else{
		$checka = '';
		$checkb = '';
	}
?>	
  <div class="bg-light lter">
	  
	  
	    <div class="container">
	<div class="m-t-md"></div>
		<div class="row">
			<div class="col-sm-3">
				<h4>Settings</h4>
				<ul class="nav nav-pills nav-stacked nav-sm">
			      <li class="active"><a data-toggle="pill" href="#edit-info"><i class="icon-user m-r-sm"></i> Penerima</a></li>
			      <li ><a data-toggle="pill" href="#edit-kurir"><i class="ion-model-s m-r-sm"></i> Ekspedisi</a>
		        </ul>

				
			</div>
			<div class="col-sm-9">
			<div class="tab-content">
			<div id="edit-info" class="tab-pane fade in active">
													<div class="panel panel-default">
														
																        <div class="panel-heading font-bold">Alamat Penerima</div>          
													
														<div class="wrapper">
															<div class="form-group">
															  <label class="col-lg-2 control-label">Avatar</label>
															  <div class="col-lg-10">
																<?php
																if($r['photo'] != ''){
																	echo"<img class='pull-left thumb-xl avatar m-r-md' src='upload/member/$r[photo]' />";
																}
																else{
																	echo"<img class='pull-left thumb-xl avatar m-r-md' src='images/fb.jpg' />";
																}
																?>
															  </div>
															</div>														
															<div class="row">
																<div class="col-sm-4">Nama Lengkap:</div>
																<div class="col-sm-4"><?php echo $r['memberName']; ?></div>
															</div>			
															<div class="row">
																<div class="col-sm-4">Username:</div>
																<div class="col-sm-4"><?php echo $r['username']; ?></div>
															</div>			
															<div class="row">
																<div class="col-sm-4">Email:</div>
																<div class="col-sm-4"><?php echo $r['email']; ?></div>
															</div>															
															<div class="row">
																<div class="col-sm-4">Provinsi:</div>
																<div class="col-sm-4"><?php echo $r['provinceName']; ?></div>
															</div>
															<div class="row">
																<div class="col-sm-4">Kota:</div>
																<div class="col-sm-4"><?php echo $r['cityName']; ?></div>
															</div>		
															<div class="row">
																<div class="col-sm-4">Ekspedisi:</div>
																<div class="col-sm-4"><?php echo $r['courierName']; ?></div>
															</div>																
															<div class="row">
																<div class="col-sm-4">Telp</div>
																<div class="col-sm-4"><?php echo $r['phone']; ?></div>
															</div>														
															<div class="row">
																<div class="col-sm-4">Update :</div>
																<div class="col-sm-4"><?php echo $login; ?></div>
															</div>
														</div>
													</div>
			</div>
				
			<div id="edit-kurir" class="tab-pane fade ">
							<div class="panel panel-default">
	        <div class="panel-heading font-bold">Change password</div>
	        <div class="panel-body">
	          <form class="form-horizontal" action="" method="post">

	            <div class="form-group">
	              <label class="col-lg-2 control-label">Current password</label>
	              <div class="col-lg-10">
	                <input id="current_password" name="password" required="true" type="password" value="" class="form-control">
	              </div>
	            </div>
	            
	            <div class="form-group">
	              <label class="col-lg-2 control-label">New password</label>
	              <div class="col-lg-10">
	                <input type="password" id="user_password" name="new_password" class="form-control">
	              </div>
	            </div>


	            <div class="form-group">
	              <label class="col-lg-2 control-label">Re-type password</label>
	              <div class="col-lg-10">
	                <input type="password" id="user_password_again" name="new_password_confirm" class="form-control">
	              </div>
	            </div>
	            
	            
	  
	            <div class="form-group">
	              <div class="col-lg-offset-2 col-lg-10">
	                <input type="hidden" name="change_password" value="yes" />
          <button id="personal_info_submit_button" class="btn btn-info" type="submit">Save</button>
	              </div>
	            </div>
	          </form>
	        </div>
	      </div>
			</div>


						</div>
				
			</div>
				
				
			</div>
		</div>
</div>