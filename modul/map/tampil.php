<?php

header('Content-Type: application/json');

$link = mysql_connect('localhost','root','');
mysql_select_db('kafe', $link);

$position = explode(',', trim(urldecode($_GET['position'])));

$sql = "SELECT id, nama_kafe, alamat, latitude, longitude,
		(6371 * acos(cos(radians(".$position[0].")) 
		* cos(radians(latitude)) * cos(radians(longitude) 
		- radians(".$position[1].")) + sin(radians(".$position[0].")) 
		* sin(radians(latitude)))) 
		AS jarak 
		FROM kafe 
		HAVING jarak <= ".$_GET['jarak']." 
		ORDER BY jarak";

$data   = mysql_query($sql);
$json   = array();
$output = array();
$i = 0;

if (!empty($data)) {
	$json = '{"data": {';
	$json .= '"kafe":[ ';
	while($x = mysql_fetch_array($data)){
	    $json .= '{';
	    $json .= '"id":"'.$x['id'].'",
	    		 "nama_kafe":"'.htmlspecialchars_decode($x['nama_kafe']).'",
	    		 "alamat":"'.htmlspecialchars_decode($x['alamat']).'",
			     "latitude":"'.$x['latitude'].'",
			     "longitude":"'.$x['longitude'].'",
			     "jarak":"'.$x['jarak'].'"
	             },';
	}
 
	$json = substr($json,0,strlen($json)-1);
	$json .= ']';
	$json .= '}}';
	 
	echo $json;
} 
