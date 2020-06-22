<?php
error_reporting(0);
include "../config/koneksi.php";

$courier = $_GET['courier'];

$queryCourier = "SELECT * FROM shipping A LEFT JOIN
				provinces C ON A.provinceID=C.provinceID LEFT JOIN
				cities D ON A.cityID=D.cityID LEFT JOIN
				shipping_weight E ON E.shippingID=A.shippingID
				WHERE A.courierID = '$courier' ORDER BY A.shippingID ASC";
$sqlCourier = mysql_query($queryCourier);
$numsCourier = mysql_num_rows($sqlCourier);

if ($numsCourier > 0)
{
	echo "<option value='' SELECTED></option>";
}
else
{
	echo "<option value='0'>None</option>";
}
while ($dtCourier = mysql_fetch_array($sqlCourier))


{
	echo "<option value='$dtCourier[shippingID]'><i class='ion-checkmark-circled'></i> $dtCourier[provinceName] - $dtCourier[cityName] - $dtCourier[estimateDay]</option>";
}
?>