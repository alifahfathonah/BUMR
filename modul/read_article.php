<div class="container">
	<div class="m-t-md"></div>
	<div class="row row-sm">
			
		<div class="col-md-9 ">
			<div class="row row-sm">
			<?php
			$data = mysql_fetch_array(mysql_query("SELECT * FROM articles A 
													LEFT JOIN art_categories B ON A.artCategoryID=B.artCategoryID LEFT JOIN
															users C ON A.createUser=C.userID
										WHERE articleID = '$_GET[id]'"));
			if ($data['articleImage'] != ''){
				$image = "<img src='upload/artikel/$data[articleImage]' class='img-full'>";
			}
			else{
				$image = "";
			}
			$post_d = explode(" ", $data['createDate']);
			$post_explode = explode("-", $post_d[0]);
			$tanggal=tgl_indo($data['createDate']);
			?>						
			<div class="blog-post ">                   
		        <div class="panel b-a">
		          <div class="wrapper-md">
   
		          <h1 class="m-t-none font-thin"><?php echo $data['title']; ?></h1>
		            	            
		            <div class="text-muted m-t-xs">
		              <i class="ion-android-time text-muted"></i><span class="m-r-sm"> Posting: <?php echo $tanggal; ?></span>
		              <i class="ion-person text-muted"></i> <?php echo $data['fullName'];?>
					</div>

					<div class="m-t-sm row row-sm m-b-sm">			              
		              		           			              
					<div class="col-xs-3 ">
			           <a target="_blank" class="btn btn-block btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://www.codester.com/blog/start-unlocking-achievement-badges-today/"><i class="fa fa-facebook fa-fw"></i> Share on Facebook</a>
			          </div>
			          <div class="col-xs-3">
						<a target="_blank" class="btn btn-block  btn-twitter" href="https://twitter.com/home?status=Start Unlocking Achievement Badges Today - https://www.codester.com/blog/start-unlocking-achievement-badges-today/ via @codesterhq"><i class="fa  fa-twitter fa-fw"></i> Share on Twitter</a>
			          </div>
			          <div class="col-xs-3">
						<a target="_blank" class="btn btn-block   btn-googleplus" href="https://plus.google.com/share?url=https://www.codester.com/blog/start-unlocking-achievement-badges-today/"><i class="fa fa-google-plus fa-fw"></i>Share on  Google+</a>
			          </div>
			          <div class="col-xs-3">
						<a target="_blank" class="btn btn-block  btn-rss" href="mailto:?&subject=Start Unlocking Achievement Badges Today&body=Hi,%0A%0ACheck%20out%20%20this%20article%20on%20Codester:%20%20%0A%0Ahttps://www.codester.com/blog/start-unlocking-achievement-badges-today/"><i class="fa fa-envelope-o fa-fw"></i> Share by Email</a>
			          </div>
					</div>

					<div class="m-t-md">
			          <?php echo $image; ?>
			        </div>	
				
		            <div class="m-t-md" style='text-align: justify;'>
					<p><?php echo $data['articleDesc']; ?></p>

   
		            </div>
		          </div>
		        </div>
	        </div>

			</div>
		</div>  
			
		
		<div class="col-sm-3  hidden-sm">
			<div class="panel bg-gre ">

		<div class="panel-body text-center">
			<p class="text-md text-white">Dapatkan tutorial dan artikel menarik yang akan dikirim ke inbox email anda</p>
			<form action="#" method="POST">
				<input type="hidden" name="u">
				<input type="hidden" name="id">
				<input type="email" placeholder="Masukan email anda ..." class="form-control m-b-sm" autocapitalize="off" autocorrect="off" size="25" value="">
				<input type="submit" class="btn btn-info font-bold btn-block" name="submit" value="Bergabung">
			</form>
			
		</div>
        </div>    



		</div> 
			
	</div>			
</div>


s