<?php 
$title="Ad Preview | Online Classified Advertisement System";
include("Inc/header.php");
include("Classes/Buyer.php");

$buyer = new Buyer();
$buyerId = Session::get("userId");

$adid=$_GET['adid'];
/*function __autoload($classname){
	include_once("Classes/$classname.php");
}*/
include_once("Classes/AdsManage.php");
$adm = new Adsmanage();
$adById =$adm -> getAdById($adid);
if($adById){
	$arr=$adById->fetch_assoc()
	?>

	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Advertisements</a></li>
			<li><a href="#"><?php echo $arr['cat_name'];?></a></li>
			<li><a href="#"><?php echo $arr['subcat_name'];?></a></li>
			<li><a href="#"><?php echo $arr['title'];?></a></li>
		</ul>

		

		<div class="row" style="margin:0px 50px 50px 50px;background-color: #e7ebff;padding-left:80px;padding-right:80px;padding-top: 20px;border: 1px solid #e7ebff;">
				<h2 style="text-align: center;color:#6a657c;"><?php echo $arr['title'];?></h2>

			<div class="mySlides">
				<div class="numbertext">1 / 3</div>
				<img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" style="width:1000px;height:350px;    border: 1px solid #337ab7;">
			</div>

			<div class="mySlides">
				<div class="numbertext">2 / 3</div>
				<img src="<?php echo 'Upload' . '/' . $arr['pic2']; ?>" style="width:1000px;height:350px;    border: 1px solid #337ab7;">
			</div>

			<div class="mySlides">
				<div class="numbertext">3 / 3</div>
				<img src="<?php echo 'Upload' . '/' . $arr['pic3']; ?>" style="width:1000px;height:350px;    border: 1px solid #337ab7;">
			</div>
			

			<div class="caption-container" style="background-color: #337ab7;">
				<p id="caption"></p>
			</div>

			<div class="row" style="margin-left: 50px;">
				
				<div class="column">
					<img class="demo cursor" src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" style="width:500px;height:200px;    border: 1px solid #337ab7;" onclick="currentSlide(1)" alt="Product Image 1">
				</div>
				<div class="column">
					<img class="demo cursor" src="<?php echo 'Upload' . '/' . $arr['pic2']; ?>" style="width:500px;height:200px;    border: 1px solid #337ab7;" onclick="currentSlide(2)" alt="Product Image 2">
				</div>
				<div class="column">
					<img class="demo cursor" src="<?php echo 'Upload' . '/' . $arr['pic3']; ?>" style="width:500px;height:200px;    border: 1px solid #337ab7;" onclick="currentSlide(3)" alt="Product Image 3">
				</div> 

			</div>
          <strong style="margin-left: 45px;">Note :</strong>Click on the image for better view.
		</div>
		<div class="row" style="margin-top: 20px;margin-left: 0px;margin-right: 0px;padding-left: 50px;padding-right: 50px;">

			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home" style="background-color: #a0ba18;color:white;font-size: 20px;">Product's Details</a></li>
				<li><a data-toggle="tab" href="#menu1" style="background-color: #a0ba18;color:white;font-size: 20px;">Seller's Info</a></li>
			</ul>

			<div class="tab-content" style="border:1px solid #e7ebff;background-color:#e7ebff;">
				<div id="home" class="tab-pane fade in active">
					<div class="panel panel-primary">
						<div class="panel-heading" style="text-align: center;font-size: 18px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Product's Details</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3" style="font-size: 18px;">
									<label>Price :</label>
								</div>
								<div class="col-lg-9" style="font-family: Tahoma, Geneva, sans-serif;font-size: 18px;color: #282423;background-color: white;">
									<?php echo "₹ ".$arr['price'];?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3" style="font-size: 18px;">
									<label>Description :</label>
								</div>
								<div class="col-lg-9 comment" style="font-family: Tahoma, Geneva, sans-serif;font-size: 16px;color: #282423;background-color: white;"><?php echo $arr['description'];?>

								</div>
							</div>
							<div class="row">
								<div class="col-lg-3" style="font-size: 18px;">
									<label>Available in :</label>
								</div>
								<div class="col-lg-9" style="font-family: Tahoma, Geneva, sans-serif;font-size: 18px;color: #282423;background-color: white;">
									<?php echo $arr['city_name'];?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3" style="font-size: 18px;">
									<label>Ad Posted on :</label>
								</div>
								<div class="col-lg-9" style="font-family: Tahoma, Geneva, sans-serif;font-size: 18px;color: #282423;background-color: white;">
									<?php echo $arr['date'];?>
								</div>
							</div>


						</div>

					</div>


				</div>
				<div id="menu1" class="tab-pane fade">
					<div class="row">
						<div class="col-lg-3">

						</div>

						<div class="col-lg-6">
							<div class="panel panel-primary">
								<div class="panel-heading" style="text-align: center;font-size: 18px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Seller's Info</div>
								<div class="panel-body">

									<div class="row">
										<div class="col-lg-4" style="font-size: 18px;">
											<label>Name :</label>
										</div>
										<div class="col-lg-8" style="font-family: Tahoma, Geneva, sans-serif;font-size: 18px;color: #282423;background-color: white;">
											<?php echo $arr['name'];?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4" style="font-size: 18px;">
											<label>Contact No :</label>
										</div>
										<div class="col-lg-8" style="font-family: Tahoma, Geneva, sans-serif;font-size: 18px;color: #282423;background-color: white;">
											<?php echo $arr['phone'];?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4" style="font-size: 18px;">
											<label>Email Id :</label>
										</div>
										<div class="col-lg-8" style="font-family: Tahoma, Geneva, sans-serif;font-size: 18px;color: #282423;background-color: white;">
											<?php echo $arr['email'];?>
										</div>
									</div>

								</div>

							</div>
						</div>

						<div class="col-lg-3">

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 40px;margin-bottom: 40px;padding-left: 50px;padding-right: 50px;">
		   
			<div class="col-lg-4">
				<button type="button" class="btn btn-success btn-md" onclick="location.href = 'seller_dashboard.php';"><< Go Back</button>
			</div>
			<div class="col-lg-4">

			</div>
			<div class="col-lg-4" style="text-align: right;">
				<div class="col-lg-6">
					<form name="cinfirmAd" method="post">
						<input type="hidden" name="ad_id" value="<?php echo $arr['ad_id']?>">
					<!--	<button type="submit"  name="confirm" class="btn btn-success btn-lg" style="cursor: not-allowed;">Confirm</button>-->
					</form>
				</div>
				<div class="col-lg-6">

					<form name="addWish" method="post">
						<input type="hidden" name="adid" value="<?php echo $arr['ad_id']?>">
						<button type="submit" name="addwishlist" class="btn btn-success btn-md" style="cursor: not-allowed;">Add to Wishlist</button>
					</form>
				</div>
			</div>
		</div>

		<?php
	}
	?>
</div>

	<!-- If the user is loggedin as buyer then he/she can only add product to wishlist -->
	<?php
	if(isset($_POST["addwishlist"]))
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
		<!-- If the user is loggedin as buyer then he/she can only add product to wishlist -->

		<!-- Confirm Ads -->
		<?php
		if(isset($_POST["confirm"]))
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
					$checkDuplicateConfirm = $buyer -> checkDuplicateConfirm($_POST,$buyerId);

					if($checkDuplicateConfirm)
					{

						echo '<script type="text/javascript">'
						. '$( document ).ready(function() {'
						. '$("#myModalAlreadyConfirmed").modal("show");'
						. '});'
						. '</script>';

					}
					else
					{
						$adid=$_POST['ad_id'];
						$addToConfirm =$buyer -> markedAsConfirmed($adid,$buyerId);

						if($addToConfirm)
						{
							echo '<script type="text/javascript">'
							. '$( document ).ready(function() {'
							. '$("#myModalConfirmSuccess").modal("show");'
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
			<!-- Confirm Ads -->




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
								You must login first as buyer to add product to wishlist or confirm product.
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

			<!--Modal For Already Confirmed-->
			<div class="modal fade" id="myModalAlreadyConfirmed" role="dialog" style="margin-top: 200px;">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header" style="background-color: #5088d7;color: white;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">
								<i class="fa fa-exclamation-circle" style="color: yellow"> </i><strong> Not Allowed</strong>
							</h4>
						</div>
						<div class="modal-body">
							<strong>
								This product is already confirmed by you.
							</strong>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" onclick="location.href = 'buyer_dashboard.php?confirmed';">Go To Confirm</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!--Modal For Already Confirmed-->

			<!--Modal For Confirm successful-->
			<div class="modal fade" id="myModalConfirmSuccess" role="dialog" style="margin-top: 200px;">
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
								Product is Confirmed successfully.
							</strong>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" onclick="location.href = 'buyer_dashboard.php?confirmed';">Go To Confirm</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		<!--Modal For Confirm successful-->

		<?php include("Inc/footer.php"); ?>