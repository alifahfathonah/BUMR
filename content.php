<?php

	if ($_GET['module']=='home')
	{ include "modul/home.php";}
	elseif ($_GET['module']=='password')
	{ include "modul/password.php";}
	elseif ($_GET['module']=='signin')
	{ include "modul/login.php";}
	elseif ($_GET['module']=='signup')
	{ include "modul/signup.php";}
	elseif ($_GET['module']=='map')
	{ include "modul/map/index.php";}		
		
	elseif ($_GET['module']=='promo')
	{ include "modul/promo.php";}	
	elseif ($_GET['module']=='category_detail')
	{ include "modul/category_detail.php";}
	elseif ($_GET['module']=='subcategory_detail')
	{ include "modul/subcategory_detail.php";}	
	elseif  ($_GET['module']=='allcategory')
	{ include "modul/all_category.php";}
	elseif  ($_GET['module']=='product_detail')
	{ include "modul/all_product.php";}	
	elseif  ($_GET['module']=='success')
	{ include "modul/success.php";}	
	elseif ($_GET['module']=='other-pro'){
		include "modul/otherpro.php";
	}	
	elseif ($_GET['module']=='articles'){
		include "modul/articles.php";	
	}	
	elseif ($_GET['module']=='read-art'){
		include "modul/read_article.php";
	}	
	elseif ($_GET['module']=='profile'){
		if ($_SESSION['email'] != ''){
            include "modul/profile.php";
		}
		else{
				include "modul/error.php";
		}
	}	
	elseif ($_GET['module']=='profilemember'){
		if ($_SESSION['email'] != ''){
            include "modul/profile-member.php";
		}
		else{
				include "modul/error.php";
		}
	}	
	elseif ($_GET['module']=='ekspedisi'){
		if ($_SESSION['email'] != ''){
            include "modul/ekspedisi.php";
		}
		else{
				include "modul/error.php";
		}
	}		
	elseif  ($_GET['module']=='saveview'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/saveview.php";
		}
	}	
	elseif  ($_GET['module']=='editaddress'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/editaddress.php";
		}
	}		
	elseif ($_GET['module']=='ekspedisi_view'){
		if ($_SESSION['email'] != ''){
            include "modul/ekspedisi-view.php";
		}
		else{
			include "modul/error.php";
		}
	}		
	elseif  ($_GET['module']=='keranjangbelanja'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/keranjang.php";
		}
	}	
	elseif  ($_GET['module']=='alldana'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/all-dana.php";
		}
	}	
	elseif  ($_GET['module']=='detaildana'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/detail-dana.php";
		}
	}	
	elseif  ($_GET['module']=='chat'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/allchat.php";
		}
	}	
	elseif  ($_GET['module']=='checkout'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/checkout.php";
		}
	}	
	elseif  ($_GET['module']=='profit'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/profit.php";
		}
	}	
	elseif  ($_GET['module']=='addsaldo'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/addsaldo.php";
		}
	}
	elseif ($_GET['module']=='congratulation'){
		echo "<div class='offset-header'></div>
				<div class='container'>
				<div class='main-column-wrapper'>
					<div class='main-column-left2'>
						<div class='blog-style-2'>
							<div class='post-title2'>
								<b>Congratulation!</b>
							</div>
							<p style='height: 300px;'>Account ativated!<br>
							Your account have been activated. For login please click <a href='sign-in.html'>here</a></p>
						</div>
					</div>
				</div>
				</div>
		";
	}	
	elseif  ($_GET['module']=='tarikdana'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/tarikdana.php";
		}
	}	
	elseif  ($_GET['module']=='pencairan'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/pencairan.php";
		}
	}	
	elseif  ($_GET['module']=='allsaldo'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/all_saldo.php";
		}
	}	
	elseif  ($_GET['module']=='paidsaldo'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/paid_saldo.php";
		}
	}		
	elseif  ($_GET['module']=='readchat'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/readchat.php";
		}
	}	
	elseif  ($_GET['module']=='savetransaction'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/savetransaction.php";
		}
	}	
	elseif  ($_GET['module']=='statustransaction'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/statustransaction.php";
		}
	}
	elseif  ($_GET['module']=='add-paid'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/addpaid.php";
		}
	}	
	elseif  ($_GET['module']=='add-complete'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/addcomplete.php";
		}
	}	
	elseif  ($_GET['module']=='newproduct'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/newproduct.php";
		}
	}		
	elseif  ($_GET['module']=='listproduct'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/listproduct.php";
		}
	}
	elseif  ($_GET['module']=='listads'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/listads.php";
		}
	}	
	elseif  ($_GET['module']=='editproduct'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/editproduct.php";
		}
	}	
	elseif  ($_GET['module']=='sendtransaction'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/sendproduct.php";
		}
	}	
	elseif  ($_GET['module']=='openads'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/bukaiklan.php";
		}
	}	
	elseif  ($_GET['module']=='history'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/history.php";
		}
	}			
	elseif  ($_GET['module']=='favorite'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/favorite.php";
		}
	}	
	elseif  ($_GET['module']=='compare'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/compare.php";
		}
	}		
	elseif  ($_GET['module']=='addads'){
		if ($_SESSION['useri'] == ''){
		echo "<script>window.alert('Maaf Silahkan Login terlebih dahulu');
				window.location=('sign-in.html')</script>";
		}
		else{
			include "modul/add-ads.php";
		}
	}	
?>
