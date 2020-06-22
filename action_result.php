		<div class="row" style="margin-left: 50px;">
		<br>
		Search Results:
		<ul style="list-style-type:circle;">
		<?php
			include('config/koneksi.php');
			$search=$_POST['search'];
	
			$query=mysql_query("SELECT B.categoryName, A.productName, A.productID, A.description,A.categoryID,A.photo1,A.productSeo,A.qty,A.discount,
								C.subCategoryID, C.subCategoryName,C.subCategorySeo
								FROM products A LEFT JOIN 
								categories B ON A.categoryID=B.categoryID LEFT JOIN
								sub_categories C ON A.subCategoryID=C.subCategoryID 
								where A.productName like '%$search%' or B.categoryName like '%$search%'");
			if (mysql_num_rows($query)==0){
				echo '<li>No results found!</li>';
			}
			else{
			while($row=mysql_fetch_array($query)){
				?>	
				<li>
					<a href="product-<?php echo $row['productID'];?>-<?php echo $row['subCategoryID'];?>-<?php echo $row['productSeo'];?>.html" style="color:black; margin-left:13px;"><?php echo $row['productName']; ?> </a>
				</li>
				<?php
			}
			}
		?>
		</ul>
		<br>
		<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
		</div>