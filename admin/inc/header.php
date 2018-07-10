<?php
include("../lib/Session.php");
Session::checkAdminSession();
$adminId=Session::get("userId");
$adminName=Session::get("name");

if(Session::get("role")=="S")
{
  //header("location:../seller_dashboard.php");
  ?>
  <script>window.location="../seller_dashboard.php";</script>
  <?php
}
if(Session::get("role")=="B")
{
  //header("location:../buyer_dashboard.php");
   ?>
  <script>window.location="../buyer_dashboard.php";</script>
  <?php
}
?>
<!doctype html>
<html>
<head>
<title>Admin Dashboard</title>
<script src="../js/Jquery.js"></script> 
<link rel="stylesheet" href='css/admin_dashboard_style.css'>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!--favicon start-->
  <link href="../Images/classified_favicon.ico" rel="icon" />
  <!--favicon end-->


  <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css"> 
  <script src="Bootstrap/js/bootstrap.min.js"></script>
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
    background: #bcbcbc;
    color: #1a1922;
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


  <script src="js/sticky_navbar.js"></script>
  <script src="js/password_toggle_changePassword.js"></script>
  <script src="js/onClick_change_editProfile.js"></script>
  <script src="js/password_toggle_addUser.js"></script>
  <script src="js/go_to_top.js"></script>
  <script src="js/tool_tip.js"></script>
  <script src="js/searchList_js.js"></script>
  <script src="js/add_scheme_validation.js"></script>

  <link rel="stylesheet" href='css/add_category_style.css'>
  <link rel="stylesheet" href='css/add_subcategory_style.css'>
  <link rel="stylesheet" href='css/add_scheme_style.css'>
  <link rel="stylesheet" href='css/change_password_style.css'>
  <link rel="stylesheet" href='css/edit_profile_style.css'>
  <link rel="stylesheet" href='css/add_user_style.css'>
  <link href="css/box_style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/go_to_top_style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/footer_style.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href='css/add_category_style.css'>
  <link href="css/search_ads_style.css" rel="stylesheet" type="text/css" media="all" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- select2 in add subcategory start-->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.cat_select').select2();
});
</script>
<!-- select2 in add subcategory end-->


 <style>
i { position:absolute;
  right: 20px;
  top:14px;
    -webkit-transition:all 300ms ease-in 0s;
    -moz-transition: all 300ms ease-in 0s;
    -o-transition: all 300ms ease-in 0s;
  transition: all 300ms ease-in 0s;}

.ui-state-active i {
    color: #ACD4CE;
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    transform: rotate(180deg);
}
</style>
<link href="css/admin_dashboard_box.css" rel="stylesheet" type="text/css" media="all" />


  <style>div#main-content { display: none; }</style>
  <Script>
    $(document).ready(function(){
   $("#overlay").fadeOut(1000);
   $('#main-content').fadeIn(5000);
   $('#tblSearchCityWise').DataTable();
   $('#example').DataTable();
   });
  </script>

<!-- Date Picker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <!--  <link rel="stylesheet" href="/resources/demos/style.css"> -->
<!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Date Picker -->


<!--Script to enlarge images -->
<script>
$(function() {
      $('.zoomeffect').on('click', function() {
      $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
      $('#enlargeImageModal').modal('show');
    });
});
</script>
<style>
.zoomeffect{
  cursor: zoom-in;
}
</style>
<!--Script to enlarge images -->

<!--loader style start-->
<!-- <link href="../css/loader_style.css" rel="stylesheet" type="text/css" media="all" />
  <script src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
  <script src="../catalog/view/javascript/soconfig/js/libs.js"></script>
  <script src="../catalog/view/javascript/soconfig/js/so.system.js"></script> -->
  <!--loader style end-->

</head>

<body>  

<!---pre loader -->
    <!--  <div class="so-pre-loader">
      <div class="so-loader-center">
      <div class="loader"></div>
       <h2 style="margin-top: 20px;">Loading...</h2>
      </div>
     </div>  -->
    <!--pre loader-->


  <!-- start of head bar-->
  <div style="text-align: left;font-size: 18px;background: linear-gradient(to left, #33ccff 0%, #0066cc 100%);color:white;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;padding:5px 0px 0px 10px;">
  Online Classified Advertisement System
</div>

  <div class="header" style="background: linear-gradient(to left, #33ccff 0%, #0066cc 100%);">
  <span style="color:white;font-size: 24px;">
    <img src="../Images/logo.png" height="50" width="150" class="img-rounded">
  Online Admin Panel
  </span>
</div>

<div style="text-align: right;font-size: 18px;background: linear-gradient(to left, #33ccff 0%, #0066cc 100%);color:white;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">
  <span class="label label-default"><img src="img/user.png" height="20px" width="20px"> <?php echo $adminName; ?></span>
</div>
<div id="navbar">
<!--   <div class="navbar-header">
      <a class="navbar-brand" href="#" style="background-color: #200a72;">Online Classified Advertisement &nbsp;&nbsp;</a>
  </div> -->
    <a href="admin_panel.php" data-toggle="tooltip" title="Go to Admin Dashboard!" data-placement="bottom"><span class="glyphicon glyphicon-home"></span><span style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif"> Home</span></a>

    <a href="../index.php" data-toggle="tooltip" title="Go to Online Classified Advertisement System!" data-placement="bottom"><span class="glyphicon glyphicon-send"></span><span style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif"> Visit Website</span></a> 

  <a href="edit_profile.php" data-toggle="tooltip" title="Edit your personal info!" data-placement="bottom"><span class="glyphicon glyphicon-edit"></span><span style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif"> Edit Profile</span></a>

  <a href="change_password.php" data-toggle="tooltip" title="Change your profile password!" data-placement="bottom"><span class="glyphicon glyphicon-refresh"></span><span style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif"> Change Password</span></a>
  
<!---Only super admin can add new admin,,,,SA=Super Admin -->
  <?php 
     if(Session::get("adminrole")=="SA")
     {
  ?>
  <a href="add_user.php" data-toggle="tooltip" title="Add new admin!" data-placement="bottom"><span class="glyphicon glyphicon-plus"></span></span><span class="glyphicon glyphicon-user"></span><span style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif"> Add User</span></a>
  <?php
   }
  ?>
<!---Only super admin can add new admin -->

  <div class="container-fluid">
  <ul class="nav navbar-nav navbar-right">
      <li><a href="?action=logout" data-toggle="tooltip" title="Logout from admin panel!" data-placement="bottom"><span class="glyphicon glyphicon-log-out"></span><span style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif"> Logout</span></a></li>
  </ul>
</div>

  <?php
  if(isset($_GET['action']) && $_GET['action']=="logout"){
   Session::adminDestroy();
 }

 ?>
</div>
  <!-- end of head bar-->
