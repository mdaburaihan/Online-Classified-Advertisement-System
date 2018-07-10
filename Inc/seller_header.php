<?php
include("lib/Session.php");
Session::init();

///automatic logout time set after certain period of time
// if (time()-Session::get('login_time')>180){
//     Session::Destroy();
// }else{
//    Session::set("login_time",time());
// }
///automatic alogout time set after certain period of time
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Classfied Advertisement System</title>
	<meta charset="UTF-8" />
	<base  />
	<meta name="format-detection" content="telephone=no" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<link rel="stylesheet" href="catalog/view/javascript/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="catalog/view/javascript/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="catalog/view/javascript/soconfig/css/lib.css">
	<link rel="stylesheet" href="catalog/view/theme/so-fina/css/ie9-and-up.css">
	<link rel="stylesheet" href="catalog/view/javascript/so_basic_products/css/style.css">
	<link rel="stylesheet" href="catalog/view/javascript/so_newletter_custom_popup/css/style.css">
	<link rel="stylesheet" href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="catalog/view/javascript/so_sociallogin/css/so_sociallogin.css">
	<link rel="stylesheet" href="catalog/view/javascript/so_product_label/css/so_product_label.css">
	<link rel="stylesheet" href="catalog/view/javascript/soconfig/css/owl.carousel.css">
	<link rel="stylesheet" href="catalog/view/theme/so-fina/css/layout1/pink.css">
	<link rel="stylesheet" href="catalog/view/theme/so-fina/css/header/header1.css">
	<link rel="stylesheet" href="catalog/view/theme/so-fina/css/footer/footer1.css">
	<link rel="stylesheet" href="catalog/view/theme/so-fina/css/responsive.css">
	<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script> 
	<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
	<script src="catalog/view/javascript/soconfig/js/libs.js"></script>
	<script src="catalog/view/javascript/soconfig/js/so.system.js"></script>
	<script src="catalog/view/theme/so-fina/js/so.custom.js"></script>
	<script src="catalog/view/theme/so-fina/js/common.js"></script>
	<script src="catalog/view/javascript/soconfig/js/jquery.unveil.js"></script>
	<script src="catalog/view/javascript/soconfig/js/owl.carousel.js"></script>
	<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>


	<!-- <script src="js/onClick_change_editUserProfile.js"></script> -->

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'> 	
	<style type="text/css">body{font-family:Roboto, sans-serif}	</style>
	<style type="text/css">
	body {
		background-color:#F0F8FA;
	}
</style>
<link href="image/catalog/favicon.png" rel="icon" />
<!--login-->
<link href="css/login_style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--login-->

<!--Home About Us Contact-->
<link href="css/webdetails_homeAboutUs_style.css" rel="stylesheet" type="text/css" media="all" />
<!--Home About Us Contact-->

<!--register-->
<link href="css/user_register_style.css" rel="stylesheet" type="text/css" media="all" />
<!--register-->



<!--buyer_dashboard-->
<link href="css/featured_images_style.css" rel="stylesheet" type="text/css" media="all" />
<!--buyer_dashboard-->

<!--- //////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<link rel="stylesheet" href="css/seller_dashboard_style.css">
<link rel="stylesheet" href="css/ad_detail_style.css">
<link rel="stylesheet" href="css/edit_ad_style.css">
<!--  <link rel="stylesheet" href='css/select_scheme_style.css'>  -->
<!-- <script src="js/fetch_subcategory.js"></script> -->
<script src="js/preview_ad_images.js"></script>
<script src="js/ad_detail_validation.js"></script>
<script src="C:\wamp\www\Online_Classified_Advertisement\js\Jquery.js"></script>
<script src="js/subcategoriesByCategory.js"></script>
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- Data table start -->
<!--CDN-->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!--CDN-->
<!--customize datatable -->
<style>
.dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5em;
    font-size:16px;
    font-weight: normal;
}

.table thead > tr > th {
    background: #337ab7;
    color: white;
}
select{
	font-size:16px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #333 !important;
    border: 1px solid #979797;
    background-color: white;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #dcdcdc));
    background: -webkit-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: -moz-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: -ms-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: -o-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: linear-gradient(to bottom, #fff 0%, #4d75c6 100%);
}

</style>
<!--customize datatable-->
<!-- Data table end -->

<style>div#main-content { display: none; }</style>

<style>
.navbar-inverse .navbar-nav>li>a {
	color: white;
}
.navbar-inverse .navbar-nav>li>a:hover {
	background-color: #6ba329;
}
.navbar-inverse .navbar-brand {
	color: #eff1ff;
	background-color: #6ba329;
}
.navbar-inverse .navbar-brand:hover {
	background-color: #6ba329;
}
</style>

<!-- select2 start-->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.cat_addetails').select2();
});

$(document).ready(function() {
    $('.subcat_addetails').select2();
});

$(document).ready(function() {
    $('.city_addetails').select2();
});
</script>
<script>
$(document).ready(function() {
    $('.city_register').select2();
});
</script>
<!-- select2 end-->

<!--- //////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<Script>
	$(document).ready(function(){
		$("#overlay").fadeOut(3000);
		$('#main-content').fadeIn(8000);
	});
</script>

<!-- radio button style in choose scheme -->
<style>
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}
</style>
<!-- radio button style in choose scheme -->

<!-- validation in register and update seller profile -->
<script src="js/register_validation.js"></script>
<!-- validation in register and update seller profile -->

<!-- ad detail display js -->
<script src="js/ad_detail_display_script.js"></script>
<!-- ad detail display js -->

<!--ad detail display style-->
<link href="css/ad_detail_display_style.css" rel="stylesheet" type="text/css" media="all" />
<!--ad detail display style-->

<!-- Description shorten in addetail display -->
<script src="js/textshorten.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$(".comment").shorten({
			"showChars" : 400,
			"moreText"	: "See More",
			"lessText"	: "See Less",
		});

	});


</script>
<!-- Description shorten in addetail display -->

<!--loader style start-->
<link href="css/loader_style.css" rel="stylesheet" type="text/css" media="all" />
<!--loader style end-->

</head>

<body class="common-home ltr res layout-1" style="background-color: #F0F8FA;">
	<div id="wrapper" class="wrapper-full banners-effect-7">   
		<!---pre loader -->
		<div class="so-pre-loader">
			<div class="so-loader-center">
			<div class="loader"></div>
		   <h2 style="margin-top: 20px;">Loading...</h2>
		</div>
	   </div>	
		<!--pre loader-->

			<header id="header" class=" variant typeheader-1">
				<!-- HEADER TOP -->
				<div class="header-top compact-hidden">
					<div class="container">
						<div class="row">
							<div class="header-top-left form-inline col-sm-5 hidden-xs compact-hidden">
								<span style="margin-right: 100px;font-size: 16px;">
									Online Classified Advertisement System
								</span>

							</div>
							<div class="header-top-right col-sm-7 collapsed-block col-xs-12 compact-hidden text-right">

								<div class="btn-group tabBlocks" style="font-size: 16px;">
									<?php 
									if(Session::get("role")=="S")
										{
											?>
											<ul class="top-link list-inline">
												<li class="account" id="my_account"><a href="#" title="My Account" class="btn btn-link dropdown-toggle" data-toggle="dropdown"> <span  style="font-size: 16px;"><i class="fa fa-user"></i><?php echo Session::get("name"); ?></span> <span class="fa fa-angle-down"></span></a>

													<ul class="dropdown-menu">
														<li><a href="seller_dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
														<li><a href="?action=logout"><i class="fa fa-power-off"></i> Logout</a></li>
													</ul>
												</li>
											</ul>
											<?php
										}
										else
										{
											?>
											<ul class="top-link list-inline">
												<li class="account" id="my_account"><a href="#" title="My Account" class="btn btn-link dropdown-toggle" data-toggle="dropdown"> <span  style="font-size: 16px;"><i class="fa fa-arrow-circle-right"></i> My Account</span> <span class="fa fa-angle-down"></span></a>

													<ul class="dropdown-menu">
														<li><a href="register.php"><i class="fa fa-user"></i> Register</a></li>
														<li><a href="login.php"><i class="fa fa-pencil-square-o"></i> Login</a></li>
													</ul>
												</li>
											</ul>
											<?php
										}
										if(isset($_GET['action']) && $_GET['action']=="logout"){
											Session::userDestroy();
										}
										?>

										<ul class="list-inline">
											<li class="hidden-xs" >				
												<i class="textColor fa fa-envelope"></i>  Email: Contact@domain.com				
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

			<!-- HEADER CENTER -->
			<div class="header-center compact-hidden">
				<div class="container">
					<div class="row">

							<div class="webdetails">
								<ul>
									<li><a href="index.php" style="background-color: #a0ba18;">Home</a></li>
									<li><a href="#news">Advertisements</a></li>
									<li><a href="#news">About Us</a></li>
									<li><a href="#news">Contact Us</a></li>	
									<li><a href="#news">FAQs</a></li>	
								</ul>
							</div>

							<div class="box-center-r">
								<!-- BOX CONTENT SEARCH -->

								<div class="searchbox pull-right">
									<div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div>
									<div id="search" class="input-group">
										<input type="text" name="search" value="" placeholder="Search" class="form-control input-lg" />
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</div>
							</div>

						</div>
					</div>
				</header>
				