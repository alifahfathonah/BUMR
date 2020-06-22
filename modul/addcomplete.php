        <style type="text/css">.main { 
                width: 900px; 
                margin: 0 auto; 
                height: 700px;
                border: 1px solid #ccc;
                padding: 20px;
            }

            .header{
                height: 100px;    
            }
            .content{    
                height: 700px;
                border-top: 1px solid #ccc;
                padding-top: 15px;
            }
            .footer{
                height: 100px;  
                bottom: 0px;
            }
            .heading{
                color: #FF5B5B;
                margin: 10px 0;
                padding: 10px 0;
                font-family: trebuchet ms;
            }

            #dv1, #dv0{
                width: 408px;
                border: 1px #ccc solid;
                padding: 15px;
                margin: auto;

            }
           

        </style>
        <style>
            /****** Rating Starts *****/
            @import url(static/css/font-awesome.min.css);

            fieldset, label { margin: 0; padding: 0; }
            body{ margin: 20px; }
            h1 { font-size: 1.5em; margin: 10px; }

            .rating { 
                border: none;
                float: left;
            }

            .rating > input { display: none; } 
            .rating > label:before { 
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before { 
                content: "\f089";
                position: absolute;
            }

            .rating > label { 
                color: #ddd; 
                float: right; 
            }

            .rating > input:checked ~ label, 
            .rating:not(:checked) > label:hover,  
            .rating:not(:checked) > label:hover ~ label { color: #FFD700;  }

            .rating > input:checked + label:hover, 
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, 
            .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     

        </style>
        <script src="../js/ca-pub-2074772727795809.js" type="text/javascript" async=""></script>
		<script src="../js/analytics.js" async=""></script>		
<div class="b-b bg-light lter">
		<div class="container m-b-sm p-t-sm ">
			<div class="row row-sm">
			<div class="col-xs-12 m-t-sm text-muted text-sm">
				<?php include "breadcumb.php"; ?>
			</div>	 
			</div>
		</div>
</div>
<?php
session_start();
$aksi="modul/action_complete.php";
switch($_GET[act]){
  default:
  echo"<div class='container m-t-md'>
		<div class='row'>";  
		$edit = mysql_query("SELECT * FROM orders A LEFT JOIN
										members B ON A.memberID=B.memberID LEFT JOIN
										shipping C ON B.shippingID=C.shippingID LEFT JOIN
										courier D ON C.courierID=D.courierID LEFT JOIN
										products E ON A.productID=E.productID
										WHERE A.orderID='$_GET[id]'");		
		$r    = mysql_fetch_array($edit);
		if ($r['statusOrder']=='Dikirim'){
			$pilihan_status = array('Diterima','Komplain Barang');
		}		
		$pilihan_order = '';
		foreach ($pilihan_status as $status) {
		   $pilihan_order .= "<option value=$status";
		   if ($status == $r['statusOrder']) {
				$pilihan_order .= " selected";
		   }
		   $pilihan_order .= ">$status</option>\r\n";
		}	
		echo "
          <form method=POST action='$aksi?module=complete&act=update' id='postform' name='postform'>
          <input type=hidden name=id value=$r[orderID]>
			<div class='col-sm-12 link-info'>
				<div class='panel b-a'> 
				  <table class='table table-striped m-b-none'>
				  <tr><td>ID Transaksi</td>        <td> $r[invoice]</td></tr>
				  <!--<tr><td>No. Resi</td>        <td> $r[resi]</td></tr>-->				  
				  <tr><td>Member</td>        <td> $r[memberName]</td></tr>
				  <tr><td>Produk</td> <td>  $r[productName]</td></tr>		  
				  <!--<tr><td>Ekspedisi</td> <td> $r[courierName] | Lama Pengiriman : $r[estimateDay] </td></tr>-->";	
		?>
		<?php
			  echo"<tr><td>Status     </td><td><span class='label label-info'>$r[statusOrder]</span></td></tr>";
			  echo"<tr><td>Ubah Status     </td><td><select  class='form-control no border text-grey' name=statusOrder>$pilihan_order</select> </td></tr>";
              //echo"<tr><td>Keadaan Barang     </td><td><select  class='form-control no border text-grey' name=keadaanBarang>$keadaan_barang</select> </td></tr>";
			  echo"<tr><td>Ulas Barang</td><td><textarea name='catatan' style='width: 450px; height: 150px;' class='ckeditor'></textarea></td></tr>";
		?>
				<tr><td>Rating</td><td>
                    <script>
                        $(document).ready(function () {
                            $("#demo2 .stars").click(function () {
                                alert($(this).val());
                                $(this).attr("checked");
                            });
                        });
                    </script>
                    <fieldset id='demo2' class="rating">
                        <input class="stars" type="radio" id="star5" name="rating" value="5" />
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4half" name="rating" value="4.5" />
                        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4" />
                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3half" name="rating" value="3.5" />
                        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3" />
                        <label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input class="stars" type="radio" id="star2half" name="rating" value="2.5" />
                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2" />
                        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1half" name="rating" value="1.5" />
                        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1" />
                        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input class="stars" type="radio" id="starhalf" name="rating" value="0.5" />
                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                    </fieldset>
                    <!-- Demo 2 end -->
  
				</td></tr>
			 <?php 
			  echo"<tr><td colspan=2>
				<button type='submit' id='submit-btn' class='btn btn-black'><i class='ion-ios-checkmark-outline'></i> Proses</button>		  
			  </td></tr>
			  </table></div></div></form>";		
		?>		
<?php		  
	echo"</div></div>";	  
    break;  

}
?>		