<?php
$title="Buyer's Dashboard | Online Classified Advertisement System";
include("Inc/header.php"); 
?>
<?php 
Session::checkUserSession(); 
//Session::checkUserLogin();
// if (time()-Session::get('login_time')>120){
//     Session::userDestroy();
// }else{
//    Session::set("login_time",time());
// }

if(Session::get("role")=="S")
{
	//header("location:seller_dashboard.php");
	?>
	<script>window.location="seller_dashboard.php";</script>
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

<div class="col-lg-2" style="background-color: rgb(225, 225, 225);height: auto;">

	<ul class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-home"></i></a></li>
		<li><a href="index.php">Account</a></li>
		<li><a href="buyer_dashboard.php">Buyer Dashboard</a></li>
	</ul>

	<div class="list-group-hover sidebar-widget-1">
		<ul class="list-unstyled">
			<li><a href="buyer_dashboard.php" class="list-group-item  bg-active" data-toggle="tooltip" data-placement="right" title="Go to dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
				<!--<li><a href="my-profile.html" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Search your desired advertisements."><i class="fa fa-search"></i>Search Ads</a> </li>-->

				<li><a href="buyer_dashboard.php?wishlist" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Confirm,view & remove advertisements from wishlist"><i class="fa fa-heart"></i>Manage Wishlist</a> </li>

				<li><a href="buyer_dashboard.php?confirmed" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Check your confirmed advertisements"><i class="fa fa-lock"></i>Confirmed Ads</a> </li>

				<li><a href="buyer_dashboard.php?editprofile" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Update your personal details"><i class="fa fa-edit"></i> Edit Profile</a> </li>

				<li><a href="buyer_dashboard.php?changepassword" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Update your profile password"><i class="fa fa-refresh"></i> Change Password</a> </li>

			<!--<li><a href="#" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Logout from your account"><i class="fa fa-power-off"></i> Logout</a></li>-->
				<li><a href="#" class="list-group-item"></a></li>

			</ul>	
		</div>	
	</div>
	<div class="col-lg-10">

		<?php
		if(isset($_GET['wishlist']))
		{
			include("wishlist.php");
		}
		elseif(isset($_GET['confirmed']))
		{
			include("confirmed.php");
		}
		elseif(isset($_GET['editprofile']))
		{
			include("edit_user_profile.php");
		}
		elseif(isset($_GET['changepassword']))
		{
			include("change_user_password.php");
		}
		else
		{
			include("buyerDashboard.php");
		}
		?>
	</div>

<?php include("Inc/footer.php"); ?>