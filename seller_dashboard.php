<?php
$title="Seller's Dashboard | Online Classified Advertisement System";
 include("Inc/header.php"); 
 ?>
<?php
 Session::checkUserSession();
 //Session::checkUserLogin();

 ?>
<?php 
include("Classes/Seller.php"); 
$slr = new Seller();
$userId = Session::get("userId");

if(Session::get("role")=="B")
{
	//header("location:buyer_dashboard.php");
	?>
	<script>window.location="buyer_dashboard.php";</script>
	<?php
}
if(Session::get("adminrole")=="SA" || Session::get("adminrole")=="A")
{
	//header("location:admin/admin_panel.php");
	?>
	<script>window.location="admin/admin_panel.php";</script>
	<?php
}
?>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});
</script>

<!-- <div class="container-fluid">  -->   
<!-- 		<div class="col-lg-2 sidenav" id="mySideNavbar">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="seller_dashboard.php?sellerDashboard">Dashboard</a></li>
				<?php
				$ifAnySchemeSelected = $slr-> ifAnySchemeSelected($userId);
				?>
				<?php
				if(isset($ifAnySchemeSelected)){

					if($ifAnySchemeSelected == false){
						?>
						<li class="disabled"><a href="#" data-toggle="tooltip" title="Please select a scheme to enable post advertisement!" data-placement="right">Post Advertisement</a></li>
						<li class="active"><a href="seller_dashboard.php?select_scheme">Choose Scheme</a></li>
						<?php
					}else{
						?>
						<li class="active"><a href="seller_dashboard.php?post_ad">Post Advertisement</a></li>
						<li class="disabled"><a href="#" data-toggle="tooltip" title="You scheme is currently activated. You can't select another scheme." data-placement="right">Choose Scheme</a></li>
						<?php

					}
				}
				?>
		<!-- <li class="active"><a href="seller_dashboard.php?active_ads">Manage Active Ads</a></li>
				<li class="active"><a href="seller_dashboard.php?deactive_ads">Manage Deactive Ads</a></li>
				<li class="active"><a href="seller_dashboard.php?ad_status">Ad Status</a></li>
			</ul>
		</div> -->


		<div class="col-lg-2" style="background-color: rgb(225, 225, 225);height: auto">

			<ul class="breadcrumb">
				<li><a href="#"><i class="fa fa-home"></i></a></li>
				<li><a href="#">Account</a></li>
				<li><a href="seller_dashboard.php">Seller Dashboard</a></li>
			</ul>

			<div class="list-group-hover sidebar-widget-1">
				<ul class="list-unstyled">
					<li><a href="seller_dashboard.php" class="list-group-item  bg-active" data-toggle="tooltip" data-placement="right" title="Go to dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>

					<?php
					$ifAnySchemeSelected = $slr-> ifAnySchemeSelected($userId);
					?>
					<?php
					if(isset($ifAnySchemeSelected)){

						if($ifAnySchemeSelected == false){
							?>
							<li><a href="#" class="list-group-item" data-toggle="tooltip" title="Please select a scheme to enable post advertisement." data-placement="right" style="background-color: #848935;color:white;cursor: not-allowed;"><i class="fa fa-minus-circle"></i>Post Advertisement</a></li>

							<li><a href="seller_dashboard.php?select_scheme" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Select a scheme to submit your ads."><i class="fa fa-gear"></i>Choose Scheme</a> </li>

							<?php
						}else{
							?>
							<li><a href="seller_dashboard.php?post_ad" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Post ads to sell product"><i class="fa fa-gear"></i>Post Advertisement</a> </li>

							<li><a href="#" data-toggle="tooltip" class="list-group-item" title="You scheme is currently activated. You can't select another scheme." data-placement="right" style="background-color: #848935;color:white;cursor: not-allowed;"><i class="fa fa-minus-circle"></i>Choose Scheme</a></a></li>
							<?php

						}
					}
					?>


			<!-- 	<li><a href="#" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Search your desired advertisements."><i class="fa fa-search"></i>Post Advertisement</a> </li>

				<li><a href="buyer_dashboard.php?wishlist" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Confirm,view & remove advertisements from wishlist"><i class="fa fa-heart"></i>Choose Scheme</a> </li> -->

				<li><a href="seller_dashboard.php?active_ads" class="list-group-item" data-toggle="tooltip" data-placement="right" title="View,edit,deactivate,delete your active ads"><i class="fa fa-cog"></i>Manage Active Ads</a> </li>

				<li><a href="seller_dashboard.php?deactive_ads" class="list-group-item" data-toggle="tooltip" data-placement="right" title="View,edit,activate,delete your deactive ads"><i class="fa fa-cog"></i>Manage Deactive Ads</a> </li>

				<li><a href="seller_dashboard.php?sold_products" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Check the sold products"><i class="fa fa-cog"></i>Sold Products</a> </li>

				<li><a href="seller_dashboard.php?ad_status" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Check your posted advertisement status"><i class="fa fa-cog"></i>Advertisement Status</a> </li>

				<li><a href="seller_dashboard.php?editprofile" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Update your personal details"><i class="fa fa-edit"></i> Edit Profile</a> </li>

				<li><a href="seller_dashboard.php?changepassword" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Update your profile password"><i class="fa fa-refresh"></i> Change Password</a> </li>

			<!--	<li><a href="#" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Logout from your account"><i class="fa fa-power-off"></i> Logout</a></li>-->
				<li><a href="#" class="list-group-item"></a></li>

			</ul>	
		</div>	
	</div>


	<div class="col-lg-10 text-left">

		<?php 
		if(isset($_GET['sellerDashboard']))
		{
			include("sellerDashboard.php");
		}
		elseif(isset($_GET['post_ad']))
		{
			include("ad_detail.php");
		} 
		elseif(isset($_GET['select_scheme']))
		{
			include("select_scheme.php");
		}
		elseif(isset($_GET['ad_status']))
		{
			include("ad_status.php");
		}
		elseif(isset($_GET['active_ads']))
		{
			?>
			<div style="overflow-y:hidden;overflow-x: scroll;">
				<?php
				include("manage_active_ads.php");
				?>
			</div>
			<?php
		}
		elseif(isset($_GET['deactive_ads']))
		{
			?>
			<div style="overflow-y:hidden;overflow-x: scroll;">
				<?php
				include("manage_deactive_ads.php");
				?>
			</div>
			<?php
		}
		elseif(isset($_GET['editprofile']))
		{
			include("edit_user_profile.php");
		}
		elseif(isset($_GET['changepassword']))
		{
			include("change_user_password.php");
		}
		elseif(isset($_GET['sold_products']))
		{
			include("sold_products.php");
		}
		else      
		{
			include("sellerDashboard.php"); 
		}
		?>

	</div>
	<!-- </div> -->
<!-- <footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer> -->


<?php include("Inc/footer.php"); ?>


