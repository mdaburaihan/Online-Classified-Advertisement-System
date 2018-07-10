<?php 
include("Inc/header.php"); 
include("Classes/Buyer.php");
$buyer = new Buyer();
$buyerId = Session::get("userId");
?>
<div id="content">

	<div class="container">
		<div class="block_slide">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 slide-left">
					<div id="slideshow0" class="owl-carousel" style="opacity: 1;">
						<div class="item">
							<a href="#"><img src="Images/slideshow/banner1.jpg" alt="slide1" class="img-responsive" /></a>
						</div>
						<div class="item">
							<a href="#"><img src="Images/slideshow/banner2.jpg" alt="slide2" class="img-responsive" /></a>
						</div>
						<div class="item">
							<a href="#"><img src="Images/slideshow/banner3.jpg" alt="slide3" class="img-responsive" /></a>
						</div>
					</div>
					<script type="text/javascript"><!--
					$('#slideshow0').owlCarousel({
						items: 6,
						autoPlay: 3000,
						singleItem: true,
						navigation: true,
						navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
						pagination: false
					});
				</script>				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 hidden-xs slide-right">
					<div class="module custom-bn-l">
						<div class="banner-sidebar">
							<div class="banners">
								<div><a title="Static Image" href="#"><img src="Images/banner/side_image1.jpg" alt="Static Image"></a></div>
								<div><a title="Static Image" href="#"><img src="Images/banner/side_image2.jfif" alt="Static Image"></a></div>
								<div><a title="Static Image" href="#"><img src="Images/banner/side_image3.jfif" alt="Static Image"></a></div>
							</div>
						</div></div>				</div>
					</div>
				</div>
				<div class="module custom-polyci">
					<div class="row box-polyci">
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="banner-info banner-info1">
								<div class="banner-cont">
									<a href="#">Post Advertisements of Products</a>
									<p>Sell your unused products</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="banner-info banner-info2">
								<div class="inner">
								<div class="banner-cont">
										<a href="#">Manage your advertisements anytime.</a>
										<p>Get your Advertisment status</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="banner-info banner-info3">
								<div class="inner">
									<div class="banner-cont">
										<a href="#">Search needed product advertisements</a>
										<p>Wishlist products and Confirm to buy</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="banner-info banner-info4">
								<div class="inner">
									<div class="banner-cont">
										<a href="#">Find Products in less price</a>
										<p>You can find less than market price</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="module custom_basic icon-style">
					<div class="title-head">
						<h3 class="modtitle"><i class="fa fa-gear"></i> Featured Advertisements</h3>
					</div>

					<div class="so-basic-product" id="so_basic_products_267_6785323901521227017">

						<div class="item-wrap row cf products-list grid">
							
							<?php
						//	function __autoload($classname){
						//		include_once("/storage/ssd2/249/5483249/public_html/Classes/$classname.php");
						//	}
						include_once("Classes/AdsManage.php");
							$adm = new Adsmanage();
							$activeAds =$adm -> fetchAllActiveAds();
							if($activeAds){
								while ($arr=$activeAds->fetch_assoc()){		
									?>
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
													<h4><a href="indexfcfd.html?route=product/product&amp;product_id=64" target="_self"><?php echo $arr['title']; ?></a></h4>

													<p class="price">
														<span class="price-new">	<?php echo "₹".$arr['price']; ?></span>
													</p>
												</div>


												<div class="button-group">	

													<form name="Wishlisted" method="post">
														<input type="hidden" name="adid" value="<?php echo $arr['ad_id']?>">

														<input type="submit" name="addWishlist" value="Add To Wishlist" class="addToCart" data-toggle="tooltip" title="Add to wishlist">

													</form>
												</div>

											</div>

										</div>



									</div>

									<?php
								}
							}
							?>
						</div>
					</div>
				</div>

				<!-- If the user is loggedin as buyer then he/she can only add product to wishlist -->
				<?php
				if(isset($_POST["addWishlist"]))
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


					<div class="module custom_basic icon-style">
						<div class="title-head">
							<h3 class="modtitle"><i class="fa fa-gear"></i> Ads Posted on Last 3 Days</h3>
						</div>
						<div class="so-basic-product" id="so_basic_products_265_19778281431521227017">
							<div class="item-wrap row cf products-list grid">
								<?php
								$LatThreeDaysactiveAds =$adm -> fetchAllActiveAdsOfLastThreeDays();
								if($LatThreeDaysactiveAds){
									while ($ar=$LatThreeDaysactiveAds->fetch_assoc()){		
										?>
										<div class="item-element product-layout ">
											<div class="item-inner product-item-container">

												<div class="left-block">
													<div class="adview">

														<div class="product-image-container ">

															<div class="image">
																<a href="#" target="_self" title= "<?php echo $ar['title']; ?>">
																	<img src="<?php echo 'Upload' . '/' . $ar['pic1']; ?>" height="150" width="150" class="img"/>
																	<div class="middle">
																		<a href='ad_detail_display.php?adid=<?php echo $ar['ad_id']?>'><div class="text">View</div></a>
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
														<h4><a href="indexfcfd.html?route=product/product&amp;product_id=64" target="_self"><?php echo $ar['title']; ?></a></h4>

														<p class="price">
															<span class="price-new">	<?php echo "₹".$ar['price']; ?></span>
														</p>
													</div>

													<div class="button-group">
														<form name="Wishlisted2" method="post">
															<input type="hidden" name="adid" value="<?php echo $ar['ad_id']?>">

															<input type="submit" name="addWishlist2" value="Add To Wishlist" class="addToCart" data-toggle="tooltip" title="Add to wishlist">

														</form>
													</div>

												</div>
											</div>
										</div>

										<?php
									}
								}
								?>
							</div>
						</div>
					</div>
					<!-- If the user is loggedin as buyer then he/she can only add product to wishlist(last 3 posted ad area) -->
					<?php
					if(isset($_POST["addWishlist2"]))
					{
						if(Session::get("role")!="B")
							{
								?>
												<!--<script type="text/javascript">

												alert("Please Login first to add products in wishlist");
												window.location.href = "login.php";


											</script>-->

											<?php
											
											echo '<script type="text/javascript">'
											. '$( document ).ready(function() {'
											. '$("#myModal").modal("show");'
											. '});'
											. '</script>';
										}
										else
										{
											//include("Classes/Buyer.php");
											//$buyer = new Buyer();
											//$buyerId = Session::get("userId");

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

												if($addToWishlist)
												{
													echo '<script type="text/javascript">'
													. '$( document ).ready(function() {'
													. '$("#myModalSuccess").modal("show");'
													. '});'
													. '</script>';
												}
												else
												{
													echo '<script type="text/javascript">'
													. '$( document ).ready(function() {'
													. '$("#myModal").modal("show");'
													. '});'
													. '</script>';
												}
											}
										}
									}

									?>
									<!-- If the user is loggedin as buyer then he/she can only add product to wishlist(last 3 posted ad area) -->

<script>// <![CDATA[
jQuery(document).ready(function($) {
	$('.item-wrap').owlCarousel2({
		pagination: false,
		center: false,
		nav: true,
		dots: false,
		loop: true,
		margin: 0,
		navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
		slideBy: 1,
		autoplay: false,
		autoplayTimeout: 2500,
		autoplayHoverPause: true,
		autoplaySpeed: 800,
		startPosition: 0, 
		responsive:{
			0:{
				items: 1				},
				480:{
					items: 2				},
					768:{
						items: 3				},
						992:{
							items: 4				},
							1200:{
								items: 5				}
							}
						});	  
});
// ]]></script>

</div>

</div>

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




<?php include("Inc/footer.php"); ?>