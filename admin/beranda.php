<?php
error_reporting(0);
session_start();
include "../config/koneksi.php";



if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
	echo "<script language='javascript'>alert('Login terlebih dahulu untuk melakukan konten manajemen');
					window.location = '../index.php'</script>";
}
else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>:: Administrator ::</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css" />
    <link href="css/ionicons.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/theme.css" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script language='javascript' src='js/FusionCharts.js'></script>	
    <script type="text/javascript" src="js/highcharts.js"></script>	
	<script type="text/javascript" src="js/jquery.fusioncharts.js"></script>
	<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-default.css" media="screen" />
	<script type="text/javascript" src="js/mootools-1.2.4-core.js"></script>
	<script type="text/javascript" src="js/mootools-1.2.4.4-more.js"></script>
	<script type="text/javascript" src="js/calendar-eightysix-v1.1.js"></script>
	<link type="text/css" href="js/themes/base/ui.all.css" rel="stylesheet" />   
	<script type="text/javascript" src="js/ui/ui.core.js"></script>
	<script type="text/javascript" src="js/ui/ui.datepicker.js"></script>
	<script type="text/javascript" src="js/ui/i18n/ui.datepicker-id.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>	
	<script type="text/javascript" src="css/ckeditor/ckeditor.js"></script>	
		<script type="text/javascript"> 
		  $(document).ready(function(){
			$("#tanggal").datepicker({
						dateFormat  : "dd MM yy",        
			  changeMonth : true,
			  changeYear  : true					
			});
		  });
		</script>			
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Welcome  <?php echo $_SESSION[nama_lengkap]; ?> 							
                            <i class="ion-android-arrow-dropdown"></i>
                        </a>

                        <ul class="dropdown-menu">
							<?php
                            echo"
                           							
                            <li class='divider visible-phone'></li>
							<li><a tabindex='-1' href='logout.php'>Logout</a></li>";
							?>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href='?module=home'><span class="first">Administrator</span></a>
        </div>
    </div>
    


    
    <div class="sidebar-nav">

		<?php
		echo"
		<a href='?app=home' class='nav-header'><i class='ion-home'></i> Home</a>
		<a href='#data-menu2' class='nav-header' data-toggle='collapse'><i class='ion-android-menu'></i> Master Produk <i class='ion-arrow-down-b'></i></a>				
        <ul id='data-menu2' class='nav nav-list collapse'>		
            <li><a href='?app=kategori'>Kategori</a></li>	
            <li><a href='?app=sub'>Sub Kategori</a></li>	
			<li><a href='?app=produk'>Produk</a></li>
        </ul>
		<a href='#data-menu' class='nav-header' data-toggle='collapse'><i class='ion-model-s'></i> Master Pengiriman <i class='ion-arrow-down-b'></i></a>				
        <ul id='data-menu' class='nav nav-list collapse'>		
            <li><a href='?app=provinsi'>Provinsi</a></li>	
            <li><a href='?app=kota'>Kota</a></li>
			<li><a href='?app=ekspedisi'>Kurir</a></li>
			<li><a href='?app=lokasi'>Lokasi Pengambilan</a></li>
			<li><a href='?app=ongkir'>Ongkos Kirim</a></li>
        </ul>
		<a href='#data-sold' class='nav-header' data-toggle='collapse'><i class='ion-model-s'></i> Chart Penjualan <i class='ion-arrow-down-b'></i></a>				
        <ul id='data-sold' class='nav nav-list collapse'>		
            <li><a href='modul/Chartjs/Chart.php' target='blank'>Penjualan Chart</a></li>	
            <li><a href='modul/Chartjs/samples/Chart2.php'>Tahun Chart</a></li>
        </ul>				
		<a href='#data-depo' class='nav-header' data-toggle='collapse'><i class='ion-cash'></i> Master Deposit <i class='ion-arrow-down-b'></i></a>				
        <ul id='data-depo' class='nav nav-list collapse'>		
            <li><a href='?app=kadeposit'>Kategori Deposit</a></li>	
            <li><a href='?app=deposit'>Deposit</a></li>
        </ul>		
	
		<a href='#data-artikel' class='nav-header' data-toggle='collapse'><i class='ion-clipboard'></i> Artikel <i class='ion-arrow-down-b'></i></a>				
        <ul id='data-artikel' class='nav nav-list collapse'>		
            <li><a href='?app=kaartikel'>Kategori Artikel</a></li>	
            <li><a href='?app=artikel'>Artikel</a></li>
        </ul>			
		<a href='#penghasilan' class='nav-header' data-toggle='collapse'><i class='ion-upload'></i> Penghasilan <i class='ion-arrow-down-b'></i></a>				
        <ul id='penghasilan' class='nav nav-list collapse'>		
            <li><a href='?app=bukadompet'>Buka Dompet</a></li>	
        </ul>			
		<a href='?app=header' class='nav-header'><i class='ion-toggle-filled'></i> Header</a>
		<a href='?app=member' class='nav-header'><i class='ion-android-person'></i> Member</a>";
		
		$jum=mysql_num_rows(mysql_query("SELECT * FROM orders WHERE statusOrder='Pending'"));
		
		echo"<a href='#data-menu3' class='nav-header' data-toggle='collapse'><i class='ion-android-cart'></i> Transaksi [$jum] <i class='ion-arrow-down-b'></i></a>				
        <ul id='data-menu3' class='nav nav-list collapse'>		
            <li><a href='?app=new'>Pesanan Baru</a></li>	
			<li><a href='?app=finish'>Pesanan Selesai</a></li>
        </ul>		
			
		";
		
		?>

		
    </div>
    

    
    <div class="content">
        

        
        <ul class="breadcrumb">
				<li><a href='?app=home'>Home</a> <span class="divider">/</span></li>
				<li class="active"><?php include "breadcrumb.php";?></li>
				
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">                  
                <?php include"tengah.php";?> 
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>

<?php
}
?>
