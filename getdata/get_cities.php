<?php
error_reporting(0);
include "../config/koneksi.php";

$province = $_GET['province'];

$queryCity = "SELECT * FROM cities WHERE provinceID = '$province' ORDER BY cityName ASC";
$sqlCity = mysql_query($queryCity);
$numsCity = mysql_num_rows($sqlCity);

if ($numsCity > 0)
{
	echo "<option value='' SELECTED></option>";
}
else
{
	echo "<option value='0'>None</option>";
}
while ($dtCity = mysql_fetch_array($sqlCity))
{
	echo "<option value='$dtCity[cityID]'>&nbsp;$dtCity[cityName]</option>";
}
?>