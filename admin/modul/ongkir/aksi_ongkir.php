<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['app'];
$act=$_GET[act];

if ($module=='ongkir' AND $act=='hapus'){
  $queryDelete="DELETE FROM shipping WHERE shippingID='$_GET[id]'";
  mysql_query($queryDelete);
  header('location:../../beranda.php?app='.$module);
}
elseif ($module=='ongkir' AND $act=='add'){
	$courierID = $_POST['courierID'];
	$provinceID = $_POST['provinceID'];
	$cityID = $_POST['cityID'];
	$estimateDay = mysql_real_escape_string($_POST['estimateDay']);
	$weightCostS = $_POST['weightCostStart'];
	$weightCostE = $_POST['weightCostEnd'];
	$shipping = $_POST['shippingCost'];
	$shippingStat = $_POST['shippingStatus'];
	$queryCost = "INSERT INTO shipping (	courierID,
											provinceID,
											cityID,
											estimateDay)
									VALUES(	'$courierID',
											'$provinceID',
											'$cityID',
											'$estimateDay')";
	mysql_query($queryCost);
	$shippingID = mysql_insert_id();
	for ($i = 0; $i < 5; $i++)
	{
		$weightCostStart = mysql_real_escape_string($weightCostS[$i]);
		$weightCostEnd = mysql_real_escape_string($weightCostE[$i]);
		$shippingCost = mysql_real_escape_string($shipping[$i]);
		$shippingStatus = $shippingStat[$i];
		
		if ($weightCostStart != "" && $weightCostEnd != "" && $shippingCost != "")
		{
			$queryWeightCost = "INSERT INTO shipping_weight (	shippingID,
																weightFrom,
																weightTo,
																shippingCost,
																shippingStatus)
															VALUES(	'$shippingID',
																	'$weightCostStart',
																	'$weightCostEnd',
																	'$shippingCost',
																	'$shippingStatus')";
			mysql_query($queryWeightCost);
		}
	}
	header('location:../../beranda.php?app='.$module);
}
elseif ($module=='ongkir' AND $act=='edit'){
	$shippingID = $_POST['shippingID'];
	$courierID = $_POST['courierID'];
	$provinceID = $_POST['provinceID'];
	$cityID = $_POST['cityID'];
	$estimateDay = mysql_real_escape_string($_POST['estimateDay']);
	$weightCostS = $_POST['weightCostStart'];
	$weightCostE = $_POST['weightCostEnd'];
	$shipping = $_POST['shippingCost'];	
	$weightCost = $_POST['weightCostID'];
	$shippingStat = $_POST['shippingStatus'];	
	$queryCost = "UPDATE shipping SET   courierID = '$courierID',
										estimateDay = '$estimateDay'
									WHERE shippingID = '$shippingID'";
	mysql_query($queryCost);
	for ($i = 0; $i < 5; $i++){
		$weightCostStart = mysql_real_escape_string($weightCostS[$i]);
		$weightCostEnd = mysql_real_escape_string($weightCostE[$i]);
		$shippingCost = mysql_real_escape_string($shipping[$i]);
		$weightCostID = mysql_real_escape_string($weightCost[$i]);
		$shippingStatus = $shippingStat[$i];
		if ($weightCostStart != "" && $weightCostEnd != "" && $shippingCost != "" && $weightCostID != "")
		{
			$queryWeightCost = "UPDATE shipping_weight SET	weightFrom = '$weightCostStart',
															weightTo = '$weightCostEnd',
															shippingCost = '$shippingCost',
															shippingStatus = '$shippingStatus'
														WHERE shippingWeightID = '$weightCostID'";
			mysql_query($queryWeightCost);
		}
	}
	header('location:../../beranda.php?app='.$module);
}



elseif ($module=='ongkir' AND $act=='input'){
	$shippingGo = mysql_real_escape_string($_POST['shippingGo']);
	$estimateDay = mysql_real_escape_string($_POST['estimateDay']);	
	$shippingCost = mysql_real_escape_string($_POST['shippingCost']);	
	$shippingType = mysql_real_escape_string($_POST['shippingType']);
	$cityID = $_POST['cityID'];	
	$courierID = $_POST['courierID'];
	$queryInput="INSERT INTO shipping(courierID,cityID,shippingGo,estimateDay,shippingCost,shippingType) 
					VALUES('$courierID','$cityID','$shippingGo','$estimateDay','$shippingCost','$shippingType')";
	mysql_query($queryInput);
	header('location:../../beranda.php?app='.$module);
}

elseif ($module=='ongkir' AND $act=='update'){
	$cityID = $_POST['cityID'];	
	$shippingGo = mysql_real_escape_string($_POST['shippingGo']);
	$estimateDay = mysql_real_escape_string($_POST['estimateDay']);	
	$shippingCost = mysql_real_escape_string($_POST['shippingCost']);	
	$shippingType = mysql_real_escape_string($_POST['shippingType']);
	$courierID = $_POST['courierID'];
	$queryUpdate="UPDATE shipping SET 
						courierID = '$courierID',
						cityID = '$cityID',
						shippingGO = '$shippingGo',
						estimateDay = '$estimateDay',
						shippingCost = '$shippingCost',
						shippingType = '$shippingType'
				WHERE shippingID = '$_POST[id]'";
	mysql_query($queryUpdate);
	header('location:../../beranda.php?app='.$module);

}
?>