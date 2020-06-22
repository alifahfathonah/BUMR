<?php

include "config/koneksi.php";
if (isset($_POST['search'])) {
	$search = $_POST['search'];
	
	$query=mysql_query("SELECT * FROM products A LEFT JOIN 
								categories B ON A.categoryID=B.categoryID LEFT JOIN
								sub_categories C ON A.subCategoryID=C.subCategoryID 
								where A.productName like '%$search%' or B.categoryName like '%$search%'");

	if(mysql_num_rows($query)==0){
		echo '<div class="panel panel-default" style="width:235px;">';
		?>
		<span style="margin-left:13px;">No results found</span>
		<?php
		'</div>';
	}
	else{
		echo '<div class="panel panel-default" style="width:235px;">';
		while ($r = mysql_fetch_array($query)) {
		?>
			
			<span>
			<a href="product-<?php echo $r['productID'];?>-<?php echo $r['subCategoryID'];?>-<?php echo $r['productSeo'];?>.html" style="text-decoration:none; color:black; margin-left:13px;"><?php echo $r['productName']; ?></a>
			</span><br>
			
		<?php
		}
		'</div>';
	}
}
 
?>
 
