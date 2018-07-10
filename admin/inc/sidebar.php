 <!-- start of left bar-->
 <?php
function __autoload($classname){
  include_once("Classes/$classname.php");
}
?>
<?php 
include_once("../Classes/User.php");
include_once("../Classes/AdsManage.php");
 ?>
<div class="container-fluid">
<div class="row">

<div class="col-lg-2" style="padding-left: 0px;">
<div class="slidebar">
 <div class="logo">
  <a href="admin_panel.php"></a>
</div>   
<ul>
  <li><a href="admin_panel.php?" data-toggle="tooltip" data-placement="right" title="Dashboard">Dashboard</a></li>

<!--   <li><a href="search_ads.php" data-toggle="tooltip" data-placement="right" title="See All Submitted Ads">Search Ads</a></li> -->
  <li class="nav-item">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3" data-parent="#exampleAccordion" class="nothover" data-toggle="tooltip" data-placement="right" title="Search Advertisemnts">

      <span class="nav-link-text">Search Advertisements <i class="fa fa-angle-down"></i></span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents3">
      <li>
        <a href="search_cat_subcat_wise.php" data-toggle="tooltip" data-placement="right" title="Search Ads Category & Subcategory Wise">1.Category-Subcategory Wise</a>
      </li>
      <li>
        <a href="search_city_wise.php" data-toggle="tooltip" data-placement="right" title="Search Ads City Wise">2.City Wise</a>
      </li>
      <li>
        <a href="search_status_wise.php" data-toggle="tooltip" data-placement="right" title="Search active,deactive,deleted,blocked,sold out product Ads">2.Status Wise</a>
      </li>
    </ul>
  </li>

  <li><a href="manage_scheme.php" data-toggle="tooltip" data-placement="right" title="Manage Scheme">Manage Scheme</a></li>
  <!-- <li><a href="manage_category.php">Manage category & Subcategory</a></li> -->

  <li class="nav-item">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion" class="nothover" data-toggle="tooltip" data-placement="right" title="Manage Category & Subcategory">

      <span class="nav-link-text">Category & Subcategory <i class="fa fa-angle-down"></i></span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents2">
      <li>
        <a href="manage_category.php" data-toggle="tooltip" data-placement="right" title="Manage Category">1.Manage Category</a>
      </li>
      <li>
        <a href="manage_subcategory.php" data-toggle="tooltip" data-placement="right" title="Manage Subcategory">2.Manage Subcategory</a>
      </li>
    </ul>
  </li>

  <li><a href="manage_city.php" data-toggle="tooltip" data-placement="right" title="Manage City">Manage City</a></li>
  <li><a href="manage_users.php" data-toggle="tooltip" data-placement="right" title="Manage Seller & Buyer">Manage User</a></li>
  <!-- <li><a href="admin_panel.php?manage_subcategory" data-toggle="tooltip" data-placement="right" title="Reporting">Report</a></li>  --> 
   <?php 
     if(Session::get("adminrole")=="SA")
     {
  ?>
  <li><a href="manage_admin.php" data-toggle="tooltip" data-placement="right" title="Administrative members of the system">Admin Members</a></li>

 <li class="nav-item">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents4" data-parent="#exampleAccordion" class="nothover" data-toggle="tooltip" data-placement="right" title="Manage Category & Subcategory">

      <span class="nav-link-text">Reporting <i class="fa fa-angle-down"></i></span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents4">
      <li>
        <a href="ads_by_fromdate_todate.php" data-toggle="tooltip" data-placement="right" title="Advertisement Register">1.Ads Register</a>
      </li>
      <li>
        <a href="ads_by_fromdate_todate_city.php" data-toggle="tooltip" data-placement="right" title="Advertisement Register by City">2.Ads Register By City</a>
      </li>
      <li>
        <a href="ads_by_fromdate_todate_status.php" data-toggle="tooltip" data-placement="right" title="Advertisement Register by Status">3.Ads Register By Status</a>
      </li>
       <li>
        <a href="ads_by_fromdate_todate_cat_subcat.php" data-toggle="tooltip" data-placement="right" title="Advertisement Register by Category & Subcategory">4.Ads Register By Cat-Subcat</a>
      </li>
    </ul>
  </li>
 <?php
}
?>
 <li><a href="edit_about_us.php" data-toggle="tooltip" data-placement="right" title="Manage About Us Section">Edit About Us</a></li>
  <li><a href="manage_FAQs.php" data-toggle="tooltip" data-placement="right" title="Manage FAQs Section">Edit FAQs</a></li>

  <li class="nav-item">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion" class="nothover" data-toggle="tooltip" data-placement="right" title="Manage Profile">

      <span class="nav-link-text">Settings <i class="fa fa-angle-down"></i></span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents">
      <li>
        <a href="edit_profile.php" data-toggle="tooltip" data-placement="right" title="Edit Profile">1.Edit Profile</a>
      </li>
      <li>
        <a href="change_password.php" data-toggle="tooltip" data-placement="right" title="Change Password">2.Change Password</a>
      </li>
    </ul>
  </li>
</ul>
</li>
</div>
</div>

<div class="col-lg-10">
<div class="row">
  <div class="col-lg-4">
<div class="card card-1">
 <div class="alert alert-success" style="font-size: 18px;background-color: #0671d2;color:#fdfffd">
  <img src="img/status.png" height="40px" width="40px">Scheme Status
</div>
<div style="padding-left:10px;font-size: 14px;">
  <?php
   //////////////////////Active Scheme Start/////////////////////////////////////
  $Schm = New Scheme();
  $active_scheme=$Schm->getAllActiveScheme();
  $ASchemeArr = array();
  if($active_scheme)
  {
    while($ActiveResult=$active_scheme->fetch_assoc())
    {
      $ASchemeArr[] = $ActiveResult['scheme_id'];
    }
  }
  $ActiveScheme = count($ASchemeArr);
     //////////////////////Active Scheme End/////////////////////////////////////
  ?>
  <h4><img src="img/active.png" height="20px" width="20px"> Active Scheme : <span class="label label-default" style="background-color: #40519f"><?php echo $ActiveScheme; ?></span></h4>

  <?php
     //////////////////////Deactive Scheme Start/////////////////////////////////////
  $DeSchm = New Scheme();
  $deactive_scheme=$DeSchm->getAllDeactiveScheme();
  $DeSchemeArr = array();
  if($deactive_scheme)
  {
    while($DeactiveResult=$deactive_scheme->fetch_assoc())
    {
      $DeSchemeArr[] = $DeactiveResult['scheme_id'];
    }
  }
  $DeactiveScheme = count($DeSchemeArr);
   //////////////////////Deactive Scheme End/////////////////////////////////////
  ?>
  <h4><img src="img/inactive.png" height="20px" width="20px"> Inactive Scheme : <span class="label label-default" style="background-color: #40519f"><?php echo $DeactiveScheme; ?></span></h4>
</div> 
</div>
</div>

<div class="col-lg-4">
<div class="card card-1">
 <div class="alert alert-success" style="font-size: 18px;background-color: #0671d2;color:#fdfffd">
  <img src="img/status.png" height="40px" width="40px">Category Status
</div>
<div style="padding-left:10px;font-size: 14px;">
  <?php
     //////////////////////Active category Start/////////////////////////////////////
   $cat = new category();
   $active_cats = $cat->getAllActiveCategory();
   $ActiveCatArr = array();
   if($active_cats)
   {
    while($ActiveCatResult=$active_cats->fetch_assoc())
    {
      $ActiveCatArr[] = $ActiveCatResult['cat_id'];
    }
  }
  $ActiveCategories = count($ActiveCatArr);
     //////////////////////Active category End/////////////////////////////////////
  ?>
  <h4><img src="img/active.png" height="20px" width="20px"> Active Category : <span class="label label-default" style="background-color: #40519f"><?php echo $ActiveCategories; ?></span></h4>
  <?php
     //////////////////////Deactive category Start/////////////////////////////////////
   $deactive_cats = $cat->getAllDeactiveCategory();
   $DeactiveCatArr = array();
   if($deactive_cats)
   {
    while($DeactiveCatResult=$deactive_cats->fetch_assoc())
    {
      $DeactiveCatArr[] = $DeactiveCatResult['cat_id'];
    }
  }
  $DeactiveCategories = count($DeactiveCatArr);
   //////////////////////Deactive category End/////////////////////////////////////
  ?>
  <h4><img src="img/inactive.png" height="20px" width="20px"> Inactive Category : <span class="label label-default" style="background-color: #40519f"><?php echo $DeactiveCategories; ?></span></h4>
</div> 
</div>
</div>

<div class="col-lg-4">
<div class="card card-1">
 <div class="alert alert-success" style="font-size: 18px;background-color: #0671d2;color:#fdfffd">
  <img src="img/status.png" height="40px" width="40px">Subcategory Status
</div>
<div style="padding-left:10px;font-size: 14px;">
  <?php
    //////////////////////Active Subcategory Start/////////////////////////////////////
   $subcat = new Subcategory();
   $active_subcats = $subcat->getAllActiveSubcategory();
   $ActiveSubcatArr = array();
   if($active_subcats)
   {
    while($ActiveSubcatResult=$active_subcats->fetch_assoc())
    {
      $ActiveSubcatArr[] = $ActiveSubcatResult['subcat_id'];
    }
  }
  $ActiveSubcategories = count($ActiveSubcatArr);
     //////////////////////Active Subcategory End/////////////////////////////////////
  ?>
  <h4><img src="img/active.png" height="20px" width="20px"> Active Subcategory : <span class="label label-default" style="background-color: #40519f"><?php echo $ActiveSubcategories; ?></span></h4>
  <?php
     //////////////////////Deactive Subcategory Start/////////////////////////////////////
   $deactive_subcats = $subcat->getAllDeactiveSubcategory();
   $DeactiveSubcatArr = array();
   if($deactive_subcats)
   {
    while($DeactiveSubcatResult=$deactive_subcats->fetch_assoc())
    {
      $DeactiveSubcatArr[] = $DeactiveSubcatResult['subcat_id'];
    }
  }
  $DeactiveSubcategories = count($DeactiveSubcatArr);
     //////////////////////Deactive Subcategory End/////////////////////////////////////
  ?>
  <h4><img src="img/inactive.png" height="20px" width="20px"> Inactive Subcategory : <span class="label label-default" style="background-color: #40519f"><?php echo $DeactiveSubcategories; ?></span></h4>
</div> 
</div>
</div>
</div>

<div class="row">
<div class="col-lg-4">
<div class="card card-1">
 <div class="alert alert-success" style="font-size: 18px;background-color: #0671d2;color:#fdfffd">
  <img src="img/city.png" height="40px" width="40px"> City Status
</div>
<div style="padding-left:10px;font-size: 14px;">
  <?php
  //////////////////////Active City Start/////////////////////////////////////
   $cit = new City();
   $active_cities = $cit->getAllActiveCity();
   $ActiveCityArr = array();
   if($active_cities)
   {
    while($ActiveCityResult=$active_cities->fetch_assoc())
    {
      $ActiveCityArr[] = $ActiveCityResult['city_id'];
    }
  }
  $ActiveCities = count($ActiveCityArr);
  //////////////////////Active City End/////////////////////////////////////
  ?>
  <h4><img src="img/active.png" height="20px" width="20px"> Active City : <span class="label label-default" style="background-color: #40519f"><?php echo $ActiveCities; ?></span></h4>
  <?php
    //////////////////////Deactive City End/////////////////////////////////////
   $cit = new City();
   $deactive_cities = $cit->getAllDeactiveCity();
   $DeactiveCityArr = array();
   if($deactive_cities)
   {
    while($DeactiveCityResult=$deactive_cities->fetch_assoc())
    {
      $DeactiveCityArr[] = $DeactiveCityResult['city_id'];
    }
  }
  $DeactiveCities = count($DeactiveCityArr);
    //////////////////////Deactive City End/////////////////////////////////////
  ?>
  <h4><img src="img/inactive.png" height="20px" width="20px"> Inactive City : <span class="label label-default" style="background-color: #40519f"><?php echo $DeactiveCities; ?></span></h4>
</div> 
</div>
</div>

<div class="col-lg-4">
<div class="card card-1">
 <div class="alert alert-success" style="font-size: 18px;background-color: #0671d2;color:#fdfffd">
  <img src="img/ads.png" height="40px" width="40px"> Advertisemnt Status
</div>
<div style="padding-left:10px;font-size: 14px;">
   <?php
  //////////////////////Active Ads Start/////////////////////////////////////
   $ads = new AdsManage();
   $activeAds = $ads->getAllActiveAdsNo();
   $ActiveAdsArr = array();
   if($activeAds)
   {
    while($ActiveAdsResult=$activeAds->fetch_assoc())
    {
      $ActiveAdsArr[] = $ActiveAdsResult['ad_id'];
    }
  }
  $ActiveAdsNo = count($ActiveAdsArr);
//////////////////////Active Ads End/////////////////////////////////////
  ?>
  <h4><img src="img/active.png" height="20px" width="20px"> Current Active Ads : <span class="label label-default" style="background-color: #40519f"><?php echo $ActiveAdsNo; ?></span></h4>
   <?php
  //////////////////////Deactive Ads Start/////////////////////////////////////
   $deactiveAds = $ads->getAllDeactiveAdsNo();
   $DeactiveAdsArr = array();
   if($deactiveAds)
   {
    while($DectiveAdsResult=$deactiveAds->fetch_assoc())
    {
      $DeactiveAdsArr[] = $DectiveAdsResult['ad_id'];
    }
  }
  $DeactiveAdsNo = count($DeactiveAdsArr);
//////////////////////Deactive Ads End/////////////////////////////////////
  ?>
  <h4><img src="img/inactive.png" height="20px" width="20px"> Current Inactive Ads : <span class="label label-default" style="background-color: #40519f"><?php echo $DeactiveAdsNo; ?></span></h4>
  <?php
   //////////////////////Sold Products Ads Start/////////////////////////////////////
   $soldproductAds = $ads->getAllSoldProductsAdsNo();
   $soldproductAdsArr = array();
   if($soldproductAds)
   {
    while($soldproductAdsResult=$soldproductAds->fetch_assoc())
    {
      $soldproductAdsArr[] = $soldproductAdsResult['ad_id'];
    }
  }
  $soldproductAdsNo = count($soldproductAdsArr);
//////////////////////Sold Products Ads End/////////////////////////////////////
?>
  <h4><img src="img/soldout.png" height="20px" width="20px"> Sold Product's Ads : <span class="label label-default" style="background-color: #40519f"><?php echo $soldproductAdsNo; ?></span></h4>

 <?php
   //////////////////////Blocked Ads Start/////////////////////////////////////
   $blockedAds = $ads->getblockedAdsNo();
   $blockedAdsArr = array();
   if($blockedAds)
   {
    while($blockedAdsResult=$blockedAds->fetch_assoc())
    {
      $blockedAdsArr[] = $blockedAdsResult['ad_id'];
    }
  }
  $blockedAdsNo = count($blockedAdsArr);
//////////////////////Blocked Ads End/////////////////////////////////////
?>

  <h4><img src="img/blocked.png" height="20px" width="20px"> Blocked Ads by Admin : <span class="label label-default" style="background-color: #40519f"><?php echo $blockedAdsNo; ?></span></h4>
</div> 
</div>
</div>

<div class="col-lg-4">
<div class="card card-1">
 <div class="alert alert-success" style="font-size: 18px;background-color: #0671d2;color:#fdfffd">
  <img src="img/multiuser.png" height="40px" width="40px"> User Status
</div>
<div style="padding-left:10px;font-size: 14px;">
  <?php
  //////////////////////Seller start/////////////////////////////////////
   $usr = new User();
   $seller = $usr->getAllSeller();
   $SellerArr = array();
   if($seller)
   {
    while($SellerResult=$seller->fetch_assoc())
    {
      $SellerArr[] = $SellerResult['user_id'];
    }
  }
  $SellerNo = count($SellerArr);
//////////////////////Seller End/////////////////////////////////////
//////////////////////Buyer Start/////////////////////////////////////
  $buyer = $usr->getAllBuyer();
   $BuyerArr = array();
   if($buyer)
   {
    while($BuyerResult=$buyer->fetch_assoc())
    {
      $BuyerArr[] = $BuyerResult['user_id'];
    }
  }
  $BuyerNo = count($BuyerArr);
  //////////////////////Buyer End/////////////////////////////////////
 //////////////////////Total User Start/////////////////////////////////////
  $user = $usr->getAllUser();
   $UserArr = array();
   if($user)
   {
    while($UserResult=$user->fetch_assoc())
    {
      $UserArr[] = $UserResult['user_id'];
    }
  }
  $userNo = count($UserArr);
  //////////////////////Total User End/////////////////////////////////////
  ?>
  <h4><img src="img/active.png" height="20px" width="20px"> Total User Profiles : <span class="label label-default" style="background-color: #40519f"><?php echo $userNo; ?></span></h4>
  <h4><img src="img/active.png" height="20px" width="20px"> Seller : <span class="label label-default" style="background-color: #40519f"><?php echo $SellerNo; ?></span> </h4> 
 <h4><img src="img/active.png" height="20px" width="20px">   Buyer : <span class="label label-default" style="background-color: #40519f"><?php echo $BuyerNo; ?></span></h4>
</div> 
</div>
</div>
</div>
</div>


