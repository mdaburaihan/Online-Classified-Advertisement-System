<?php 
$title="Subcategory wise Ads | Online Classified Advertisement System";
include("Inc/header.php"); 
include("Classes/AdsManage.php"); 
include("Classes/Others.php"); 
include("Classes/Buyer.php"); 
$ads = new AdsManage();
$othr = new Others();
$buyer = new Buyer();
$buyerId = Session::get("userId");
$subcatid= $_GET['subcatid'];
?>

<div class="container">
	<?php
	$getCategoryName=$othr->getCategoryNameBySubcatId($subcatid);
	if($getCategoryName)
	{
		$subcatselect=$getCategoryName->fetch_assoc();
		?>

		<ul class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Advertisements</a></li>
			<li><a href="#"><?php echo $subcatselect['cat_name'];?></a></li>
			<li><a href="#"><?php echo $subcatselect['subcat_name'];?></a></li>
		</ul>

		<div style="background-color: #9392ba;font-size: 18px;color:white;width:1000px;padding:10px 10px;">
			<i class="fa fa-gear"></i>
			Advertisements under Category

			<a class="btn btn-primary" data-toggle="collapse" href="#MoreSubcategoryCollapse" role="button" aria-expanded="false" aria-controls="MoreSubcategoryCollapse" style="background-color: #9392ba;font-size: 18px;padding:0px;">

			 <?php echo $subcatselect['cat_name']; ?> <i class="fa fa-caret-down"></i>
			 </a>
			  &  Subcategory <?php echo $subcatselect['subcat_name']; ?>
		</div>
        
		<?php
          $catid= $subcatselect['cat_id'];
	}
	?>
	<!-- Displaying more subcategory under the selected category -->
	<div class="collapse in" id="MoreSubcategoryCollapse">
		<div style="padding-left: 20px;background-color: #f5f5f5;border: 1px solid #ebe5e5;font-size: 16px;color:#1b4f91"><i class="fa fa-bars"></i> More Subcategories under Category <?php echo $subcatselect['cat_name']; ?></div>
		<div class="well" style="padding:10px 4px 20px 2px;min-height:150px;">
			<div class="col-lg-12">
			 <div class="row">
			<?php
			$getSubcatNamesByCat=$othr->getSubcategoriesByCatId($catid);

			if($getSubcatNamesByCat)
			{
				while($catselect=$getSubcatNamesByCat->fetch_assoc())
				{
					?>

					<div class="col-lg-3" style="margin-top: 5px;">
 				    	<a href="?subcatid=<?php echo $catselect['subcat_id']; ?>" role="button" class="btn btn-sm form-control" style="background-color: #a0ba18;font-size: 16px"><?php echo $catselect['subcat_name']; ?></a>
					</div>
				<?php
				}
			}
			?>
		    </div>
		  </div>
		</div>
	</div>
	<!-- Displaying more subcategory under the selected category -->

	<div class="so-basic-product">
		<div class="item-wrap row cf products-list grid" style="background-color: #e7ebff">
			<?php

			$getAdsSubcatWise = $ads->getAdsSubcategoryWise($subcatid);
			if($getAdsSubcatWise){
				while ($arr=$getAdsSubcatWise->fetch_assoc()){
					?>
					<div class="col-lg-3">

						<div class="item-element product-layout ">

							<div class="item-inner product-item-container">


								<div class="left-block">
									<div class="adview">

										<div class="product-image-container ">
											<!-- displaying featured advertisements -->

											<div class="image">
												<a href="#" target="_self" title= "<?php echo $arr['title']; ?>">
													<img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" height="150" width="150" class="img"/>
													<div class="middle">
														<a href='ad_detail_display.php?adid=<?php echo $arr['ad_id']?>'><div class="text">View</div></a>
													</div>
												</a>
											</div>

											<div class="box-label">
												<!--Sale Label-->
											</div>
										</div>
									</div>
								</div>

								<div class="right-block">
									<div class="caption">
										<h4><a href="#" target="_self"><?php echo $arr['title']; ?></a></h4>

										<p class="price">
											<span class="price-new">	<?php echo "₹".$arr['price']; ?></span>
										</p>
									</div>


									<div class="button-group">	

										<form name="Wishlisted" method="post">
											<input type="hidden" name="adid" value="<?php echo $arr['ad_id']?>">

											<input type="submit" name="addToWishlist" value="Add To Wishlist" class="addToCart" data-toggle="tooltip" title="Add to wishlist">

										</form>
									</div>

								</div>

							</div>



						</div>

					</div>
					<?php
				}
			}

			?>


				<!-- </div>
				</div> -->
			</div>

			<!-- If the user is loggedin as buyer then he/she can only add product to wishlist -->
			<?php
			if(isset($_POST["addToWishlist"]))
			{
				if(Session::get("role")!="B")
					{


						echo '<script type="text/javascript">'
						. '$( document ).ready(function() {'
						. '$("#myModal").modal("show");'
						. '});'
						. '</script>';
					}
					else
					{
						$checkDuplicate = $buyer -> checkDuplicateInWishlist($_POST,$buyerId);

						if($checkDuplicate)
						{

							echo '<script type="text/javascript">'
							. '$( document ).ready(function() {'
							. '$("#myModalFailed").modal("show");'
							. '});'
							. '</script>';

						}
						else
						{

							$addToWishlist =$buyer -> addProductToWishlist($_POST,$buyerId);

								// if($addToWishlist)
								// {
							echo '<script type="text/javascript">'
							. '$( document ).ready(function() {'
							. '$("#myModalSuccess").modal("show");'
							. '});'
							. '</script>';
								//}

						}
					}
				}

				?>
			</div>
		</div>



		<?php include("Inc/footer.php"); ?>


		<!--Modal For not login and trying to insert in wishlist-->
		<div class="modal fade" id="myModal" role="dialog" style="margin-top: 200px;">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #5088d7;color: white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
							<i class="fa fa-exclamation-circle" style="color: yellow"> </i><strong> Sorry</strong>
						</h4>
					</div>
					<div class="modal-body">
						<strong>
							You must login first as buyer to add product to wishlist.
						</strong>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="location.href = 'login.php';">Login</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!--Modal For not login and trying to insert in wishlist-->

		<!--Modal For Insert into wishlist successful-->
		<div class="modal fade" id="myModalSuccess" role="dialog" style="margin-top: 200px;">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #5088d7;color: white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
							<i class="fa fa-check-circle" style="color: yellow"></i><strong> Success</strong>
						</h4>
					</div>
					<div class="modal-body">
						<strong>
							Product is successfully added to wishlist.
						</strong>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="location.href = 'buyer_dashboard.php?wishlist';">Go To Wishlist</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!--Modal For Insert into wishlist successful-->

		<!--Modal For duplicate wishlist-->
		<div class="modal fade" id="myModalFailed" role="dialog" style="margin-top: 200px;">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #5088d7;color: white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
							<i class="fa fa-ban" style="color: yellow"></i><strong> Not Allowed</strong>
						</h4>
					</div>
					<div class="modal-body">
						<strong>
							This product is already added to your wishlist.
						</strong>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="location.href = 'buyer_dashboard.php?wishlist';">Go To Wishlist</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
<!--Modal For duplicate wishlist-->