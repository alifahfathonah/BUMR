<script>
$(document).ready(function(){
	$("#provinceID").change(function(){
				var province = $("#provinceID").val();
				$.ajax({
					url: "getdata/get_cities.php",
					data: "province="+province,
					cache: false,
					success: function(msg){
						$("#cityID").html(msg);
					}
				});
	});	
});
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
	$queryProfile="SELECT * FROM members A LEFT JOIN
					provinces B ON A.provinceID=B.provinceID LEFT JOIN
					cities C ON A.cityID=C.cityID LEFT JOIN
					shipping D ON A.shippingID=D.shippingID LEFT JOIN
					courier E ON D.courierID=E.courierID
					WHERE A.memberID = '$_SESSION[useri]'
					ORDER BY A.memberID";
	$sqlProfile = mysql_query($queryProfile);
	$r=mysql_fetch_array($sqlProfile);

echo"<div id='content' class='main-content bg-lights'>
	<div class='container'>
			<div class='m-t-md'></div>
			<div class='row'>	
			<div class='col-sm-8 link-info'>
				<div class='panel panel-default'>
					<div class='panel-heading font-bold'>Edit Alamat Penerima</div>
					<div class='panel-body'>			
					<form action='modul/action_edit_address.php' method='post'>
						<div class='form-group'>
							<label class='col-lg-2 control-label'>Nama Penerima</label>
								<div class='col-lg-10'>
									<input class='form-control text-sm' type='text' value='$r[memberName]' name='memberName' required='true'>
									<span class='help-block'></span>
								</div>
						</div>	
						<div class='form-group'>
							<label class='col-lg-2 control-label'>Telp</label>
								<div class='col-lg-10'>
									<input class='form-control text-sm' type='text' value='$r[phone]' name='phone' required='true'>
									<span class='help-block'></span>
								</div>
						</div>	
						<div class='form-group'>
							<label class='col-lg-2 control-label'>Provinsi</label>
								<div class='col-lg-10'>
								<select class='form-control text-sm' name='provinceID' id='provinceID'>
									<option value=0 selected> Pilih Provinsi </option>";
										$query = "SELECT * FROM provinces ORDER BY provinceID";
										$sql  =mysql_query($query);
										while($w=mysql_fetch_array($sql)){
										if($r['provinceID'] == $w['provinceID']){
											echo "<option value=$w[provinceID] SELECTED>$w[provinceName]</option>";
										}
										else{
											echo "<option value=$w[provinceID]>$w[provinceName]</option>";
										}
										}  
												
							echo "</select>	
								<span class='help-block'></span>
						</div>
						</div>
						<div class='form-group'>
							<label class='col-lg-2 control-label'>Kota</label>
							<div class='col-lg-10'>
									<select class='form-control text-sm' id='cityID' name='cityID' required>
										<option value=''>Pilih Kota</option>
									</select><span class='help-block'></span>
							</div>
						</div>
						<div class='form-group'>
								<label class='col-sm-2 control-label'>Alamat</label>
								<div class='col-sm-10'>
									<textarea name='address' style='width: 450px; height: 150px;' class='ckeditor'>$r[address]</textarea>
								</div>
						</div>	
						<div class='form-group'>
							<div class='col-sm-4 col-sm-offset-2 m-t-md'>
								<input type='hidden' name='upload' value='yes'/>
									<button type='submit' id='submit-btn' class='btn btn-black'> Simpan</button>										
									<input class='btn btn-black' type='button' value='Kembali' onclick='javascript:history.go(-1)'>	
							</div>
						</div>							
					</form>
					</div></div>
				</div>
			</div>
			
			</div>
	</div>
</div>";
			
?>			
			
			
			
			
			
			
			

<!--<div class="body">
	<div class="container_page">
		<div class="container">
			<div id="breadcrumbs-wrapper">
				<ul class="breadcrumbs">
					<li class="breadcrumb ">
						<a href="index.php" class="breadcrumb-label">Home</a>
					</li>
					<li class="breadcrumb is-active">
						<span class="breadcrumb-label">Detail</span>
					</li>
				</ul>
			</div>
			<h1 class="page-heading hl-heading-line">Edit Penerima</h1>
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
			?>				
			<main class="page">
			<div class="page-content page-content--centered">
				<div class="row">
					<div class="col-sm-8">
						<form data-contact-form class="form form-contact" action="modul/action_edit_address.php" method="post">
							<div class="form-row form-row--half">
								<div class="form-field">
									<label class="form-label" for="contact_fullname">Nama Lengkap</label>
									<input class="form-input" type="text" name="memberName" value="<?php echo $r['memberName']; ?>"></div>
								<div class="form-field">
									<label class="form-label" for="contact_phone">Telp</label>
									<input class="form-input" type="text" name="phone" value="<?php echo $r['phone']; ?>"></div>
								<div class="form-field">
									<label class="form-label" for="contact_email">Provinsi
									</label>
									<select class="form-select" name='provinceID' id='provinceID'>
															<option value=0 selected>- Pilih Kategori -</option>
															<?php
															$query = "SELECT * FROM provinces ORDER BY provinceID";
															$sql  =mysql_query($query);
															while($w=mysql_fetch_array($sql)){
															echo "<option value=$w[provinceID]>$w[provinceName]</option>";
															}               
															?>
									</select>
								</div>
								<div class="form-field">
									<label class="form-label" for="contact_companyname">Kota</label>
									<select class='form-select' id='cityID' name='cityID' required>
										<option value=''>Pilih Kota</option>
									</select>
								</div>
								<div class="form-field hl-textarea">
									<label class="form-label" for="contact_question">Alamat Lengkap 
									</label>
									<textarea name="address" class='ckeditor' rows="5" cols="50" class="form-input"><?php echo $r['address']; ?></textarea>
								</div>
								<br/>
							</div>
							<div class="form-actions">
								<input class="btn btn-primary" type="submit" value="Update">
								<a href="save-view.html" class="btn btn-primary">Kembali</a>
							</div>
						</form>
					</div>
					<div class="col-sm-4 store-location">
						<div class="storeLocation">
							<h3>Store Location</h3>
							<div class="store-address">
								Acme Widgets 123 Widget Street Acmeville, AC 12345 United States of America
							</div>
							<div class="store-email">
								Email: <a href="mailto:support@halothemes.com">support@halothemes.com</a>
							</div>
							<div class="store-phone">Toll-free: (1800)-000-6890</div>
							<label>Opening Hours:</label>
							<div class="item1">Monday to Saturday: 9am - 10pm</div>
							<div class="item2">Sundays: 10am - 6pm</div>
						</div>
					</div>		
				</div>
			</div>
			</main>
		</div>
	</div>
	<div id="modal" class="modal" data-reveal data-prevent-quick-search-close>
		<a href="#" class="modal-close" aria-label="Close" role="button"><span aria-hidden="true">&#215;</span></a>
		<div class="modal-content"></div>
		<div class="loadingOverlay"></div>
	</div>
</div>-->