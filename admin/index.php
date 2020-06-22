<?php 
  error_reporting(0);
  ob_start();	
  session_start();
  include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en" class="login_page">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>


    <title>Login Administrator</title>

    <link rel="icon" type="image/ico" href="#"/>
    <link rel="stylesheet" href="css/satu.css"/>
    <link href="css/dua.css" rel="stylesheet" type="text/css"/>
    <link href="css/tiga.css" rel="stylesheet" type="text/css"/>
	<link href="css/ionicons.min.css" media="all" rel="stylesheet" type="text/css">

 
    
</head>

<body>

<div class="loginBox content">
    <div style="margin-bottom:10px;text-align: center; height: 62px">
        <div class="bLogo" style="text-align: center">

        </div>
    </div>

    <div class="workplace">

        <div class="loginForm">
            <div class="head clearfix">
                <h1>Administrator</h1>
            </div>
  		<?php if($_GET['app'] == 1){ ?>
		<div class="control-group">
			<img src="images/login-warning.gif" />
			Proses login tidak berhasil. <br />
			Klik <a href="index.php"><b>disini</b></a> untuk melakukan login ulang</p>
		</div>
		<?php } ?>
		<?php if($_GET['app'] != 1){ ?>	
            <form action="login.php" method="post" class="form-horizontal" onSubmit="return validasi(this)">

                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><i class="ion-person"></i></span>
                        <input type="text" name='username' id="inputEmail" placeholder="Username"
                               style="width:215px;"/>
                    </div>
                </div>

                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><i class="ion-locked"></i></span>
                        <input type="password" name='password' id="inputPassword" placeholder="Password"
                               style="width:215px;"/>
                    </div>
                </div>
				
				
                <div class="row-fluid">
                    <div class="span8">
                        <div class="control-group" style="margin-top: 10px;">
                            <label class="checkbox">
                                <div class='checker'>

                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="span4" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-block">Login</button>
                    </div>
                </div>
            </form>
			<?php } ?>
        </div>
    </div>
</div>
</body>
</html>
