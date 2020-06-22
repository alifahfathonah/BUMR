	<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
	</div>	
<div class="container">
	<div class="m-t-md"></div>
	<div class="row row-sm">
			
		<div class="col-md-12">
			<div class="row row-sm">
			
			<?php
			$dataPerPage = 9;
			
			if(isset($_GET['page'])){
				$noPage = $_GET['page'];
			}
			else 
				$noPage = 1;

			$offset = ($noPage - 1) * $dataPerPage;
			$i = 1;
			if ($_GET['id'] != 0){
				$sql_article = mysql_query("SELECT * FROM articles A LEFT JOIN 
														  art_categories B ON A.artCategoryID=B.artCategoryID
													WHERE B.artCategoryID = '$_GET[id]' 
													ORDER BY A.articleID DESC LIMIT $offset,$dataPerPage");
			}
			else{
				$sql_article = mysql_query("SELECT * FROM articles A LEFT JOIN 
															art_categories B ON A.artCategoryID=B.artCategoryID 
												 ORDER BY A.artCategoryID DESC LIMIT $offset,$dataPerPage");
			}
			while ($data_news = mysql_fetch_array($sql_article)){
				$posted = tgl_indo($data_news['createDate']);
				$date = date('Y-m-d H:i:s');
				$description = substr($data_news['articleDesc'], 0, 90);					
				
				echo "<div class='col-sm-4'><div class='panel b-a'>";
						if ($data_news['articleImage'] != ''){
							echo "<div>
									<a href='read-art-$data_news[articleID]-$data_news[articleSeo].html' class='black'>
									<img src='upload/artikel/$data_news[articleImage]' width='640px' height='150px' class='img-full'>
									</a>
								</div>";
						}
						echo "
							<div class='panel-body'>
								<div class=' m-b-xs m-r-sm m-t-xs font-bold'>
									$data_news[artCategoryName]
									<a class='text-sm pull-right' href='#'> Posting: $posted </a>
								</div>						 
								<h5 class='link-info text-grey font-bold'><a href='read-art-$data_news[articleID]-$data_news[articleSeo].html' class='text-grey'>$data_news[articleTitle]</a></h2>
								
								<div>$description .. <a class='link-info text-danger-dker' href='read-art-$data_news[articleID]-$data_news[articleSeo].html'>Detail</a></div>
								
						</div>
					</div></div>";
				$i++;
			}
			?>	

		
			</div>
			
					<div class="text-right m-b-sm">
						<ul class="pagination pagination-md">
						<?php
						if ($_GET['id'] != 0){
							$jumData	= mysql_num_rows(mysql_query("SELECT * FROM articles WHERE articleID = '$_GET[id]'"));
						}
						else{
							$jumData	= mysql_num_rows(mysql_query("SELECT * FROM articles"));
						}
						$jumPage = ceil($jumData/$dataPerPage);
						$title = str_replace(" ", "+", $_GET['articleTitle']);
		
						if ($noPage > 1)
							$numpage = $noPage-1;
							if ($numpage != ''){
								echo  "<li class='active'><a href='articles-$_GET[id]-$numpage-$title.html' class='text-grey'>
										Prev</a></li>";
							}
							else{
								echo  "<li class='active'><a href='#' class='text-grey'> Prev</a></li>";
							}
							for($page = 1; $page <= $jumPage; $page++){
								if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){
									if (($showPage == 1) && ($page != 2))  
										echo "...";
									if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  
										echo "...";
									if ($page == $noPage) 
										echo " <li><span class='page active'>".$page."</span></li>";
									else 
										echo "<li> <a href='articles-$_GET[id]-$page-$title.html' class='text-grey'>".$page."</a> </li>";
									$showPage = $page;
								}
							}
		
						if ($noPage < $jumPage)
							$numPlus = $noPage+1;
							if ($numPlus != ''){ 
								echo "<li><a href='articles-$_GET[id]-$numPlus-$title.html' class='text-grey'>Next </a></li>";
							}
							else{
								echo "<li><a href='#' class='text-grey'>Next </a></li>";
							}
						?>

						</ul>
					</div>						
		</div>  
			
		
		
			
	</div>			
</div>

	