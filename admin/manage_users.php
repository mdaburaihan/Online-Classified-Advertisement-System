<?php include("inc/header.php"); ?>
<?php 
include("../Classes/User.php"); 
$usr = new User();
include("../Classes/AdsManage.php"); 
$ads = new AdsManage();

?>
<?php 
include("Classes/City.php"); 
?>
<?php
/////blocking user(start)////
if(isset($_GET['action']) && $_GET['action']=="block")
{
  $userid = $_GET['userid'];


  $res = $usr -> blockUser($userid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("User is Blocked Successfully.");
       $("#myModalBlock").modal('show');

     });
   </script>
   <?php
 }
 else
 {
  header("location:404.php");
}

}
/////blocking user(end)////


/////unblock user(start)////
if(isset($_GET['action']) && $_GET['action']=="unblock")
{
  $adid = $_GET['adid'];


  $res = $ads -> deactivateAd($adid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("Advertisement is unblocked successfully.");
       $("#myModalBlock").modal('show');

     });
   </script>
   <?php
 }
 else
 {
  header("location:404.php");
}

}
/////unblock user(end)////

/////seller's posted ads(start)////
if(isset($_GET['activity']) && $_GET['activity']=="postedAds" && $_GET['user']=="Seller")
{
  $sellerid = $_GET['userid'];

  $SellerDetails=$usr->getUserById($sellerid);
  $resSellerDetails=$SellerDetails->fetch_assoc();

  $sellerName=$resSellerDetails['name'];
  $sellerEmail=$resSellerDetails['email'];
  $sellerPhone=$resSellerDetails['phone'];
 ?>
 <script>
  $(document).ready(function(){

   var sellerid = <?php echo $sellerid ?>;
   
   $.ajax({
    type: "GET",
    url: "postedAdsBySellerId.php",
    data: {sellerid:sellerid},
    cache: false,
    success: function(data){
     
     $('#displayAds').html(data);
     $('#displayAdsTitle').html("<?php echo 'Posted Advertisements by seller: '.$sellerName.' ,Email:'.$sellerEmail.' ,Phone No: '.$sellerPhone ?>");
     $("#myModalDisplayAds").modal('show');

   },
   error: function(err) {
    alert(err);
  }
});
 });
</script>
<?php
}
/////seller's posted ads(end)////

/////Buyer's wihslisted ads(start)////
if(isset($_GET['activity']) && $_GET['activity']=="wishlistedAds" && $_GET['user']=="Buyer")
{
 $buyerid = $_GET['userid'];

  $BuyerDetails=$usr->getUserById($buyerid);
  $resBuyerDetails=$BuyerDetails->fetch_assoc();

  $buyerName=$resBuyerDetails['name'];
  $buyerEmail=$resBuyerDetails['email'];
  $buyerPhone=$resBuyerDetails['phone'];
 ?>
 <script>
  $(document).ready(function(){

   var buyerid = <?php echo $buyerid ?>;

   $.ajax({
    type: "GET",
    url: "wishlistedAdsByBuyerId.php",
    data: {buyerid:buyerid},
    cache: false,
    success: function(data){

     $('#displayAds').html(data);
      $('#displayAdsTitle').html("<?php echo 'Wishlisted Advertisements by buyer: '.$buyerName.' ,Email:'.$buyerEmail.' ,Phone No: '.$buyerPhone ?>");
     $("#myModalDisplayAds").modal('show');

   },
   error: function(err) {
    alert(err);
  }
});
 });
</script>
<?php
}
/////Buyer's wihslisted ads(end)////

/////Buyer's wihslisted ads(start)////
if(isset($_GET['activity']) && $_GET['activity']=="ConfirmedAds" && $_GET['user']=="Buyer")
{
 $buyerid = $_GET['userid'];

 $BuyerDetails=$usr->getUserById($buyerid);
  $resBuyerDetails=$BuyerDetails->fetch_assoc();

  $buyerName=$resBuyerDetails['name'];
  $buyerEmail=$resBuyerDetails['email'];
  $buyerPhone=$resBuyerDetails['phone'];
 ?>
 <script>
  $(document).ready(function(){

   var buyerid = <?php echo $buyerid ?>;

   $.ajax({
    type: "GET",
    url: "confirmedAdsByBuyerId.php",
    data: {buyerid:buyerid},
    cache: false,
    success: function(data){

     $('#displayAds').html(data);
      $('#displayAdsTitle').html("<?php echo 'Confirmed Advertisements by buyer: '.$buyerName.' ,Email:'.$buyerEmail.' ,Phone No: '.$buyerPhone ?>");
     $("#myModalDisplayAds").modal('show');

   },
   error: function(err) {
    alert(err);
  }
});
 });
</script>
<?php
}
/////Buyer's wihslisted ads(end)////
?>


<div class="well" style="height: 130px;">
	<h4>Manage Sellers & Buyers</h4>
 <form name="search_ads" method="post" style="margin-left: 200px;">  
   <div class="col-lg-6" style="margin-top: 20px;">
    <div class="col-lg-2" style="font-size: 16px;text-align: right;">
     <label>City :</label>
   </div>
   <div class="col-lg-4">
    <select class="cat_select form-control" name="cityid" id="setcityid">
     <option value="">---Select---</option>
     <?php
     $ct = new City();
     $allCities =$ct -> getAllCity();

     if($allCities){
      while ($cityarr=$allCities->fetch_assoc()){
        ?>
        <option value="<?php echo $cityarr['city_id'] ?>"><?php echo $cityarr['city_name'] ?></option>
        <?php
      }
    }
    ?>
  </select>
</div>
<div class="col-lg-2" style="font-size: 16px;text-align: right;">
 <label>User :</label>
</div>
<div class="col-lg-4">
  <select class="cat_select form-control" name="role" id="setrole">
   <option value="">---Select---</option>
   <option value="S">Seller</option>
   <option value="B">Buyer</option>
 </select>
</div>
</div>
<div class="col-lg-6" style="margin-top: 20px;">
  <div class="col-lg-2">
   <button type="submit" name="search" class="btn btn-primary">Search</button>
 </div>
 <div class="col-lg-6">

 </div>
 <div class="col-lg-4" style="text-align: right">
  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalHelp">
    <img src="img/help.png"/>
  </button>
  <a href="#">Need Help?</a>
</div>
</div>
</form>
</div>
<script type="text/javascript">
  document.getElementById('setcityid').value = "<?php echo $_POST['cityid'];?>";
  document.getElementById('setrole').value = "<?php echo $_POST['role'];?>";
</script>

<div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
 <img src="img/Loading_icon.gif" alt="Loading" />
</div>
<!-- <div id="test" style="display: none;">
  <div class="alert alert-danger" style="font-size:18px;text-align: center;">
    No Advertisements Available.
  </div>
</div> -->
<div id="main-content">
  <div class="container-fluid">
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Registered Sellers & Buyers</div>
      <div class="panel-body">
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search'])){

         $cityid=$_POST['cityid'];
         $role=$_POST['role'];

         if($cityid=="" && $role=="")
         {
          echo "<script>alert('Please Select City or User.');</script>";
          ?>
          <script>
            window.location="manage_users.php";
          </script>
          <?php
        }
        
        $allCityWiseUsers =$usr -> getUsersCityWise($_POST);
        if(empty($allCityWiseUsers))
        {
          echo"<script>alert('No User Found');</script>";
          ?>
          <script>
            window.location="manage_users.php";
          </script>
          <?php
        }

      }
      ?>

      <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Sl.</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email Id</th>
            <th>Contact No</th>
            <th>City</th>
            <th>Pin Code</th>
            <th>Member Since</th>
            <th>User Status</th>
            <th>Activity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Sl.</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email Id</th>
            <th>Contact No</th>
            <th>City</th>
            <th>Pin Code</th>
            <th>Member Since</th>
            <th>User Status</th>
            <th>Activity</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>    
         <?php
         $sl=1;
         if(isset($allCityWiseUsers))
         {
          while ($arr=$allCityWiseUsers->fetch_assoc())
          {
            ?>

            <tr>
             <input type="hidden" name="adid" id="hidden_userid" value="<?php echo $arr['user_id']; ?>">
             <td>
              <?php echo $sl; ?>
            </td>
            <td><?php echo $arr['name'] ?></td>
            <td>
              <?php
              if($arr['role'] == 'S')
              {
               echo"<strong>Seller</strong>";
             }
             else
             {
              echo"<strong>Buyer</strong>";
            }
            ?>
          </td>
          <td><?php echo $arr['email'] ?></td>
          <td><?php echo $arr['phone'] ?></td>
          <td><?php echo $arr['city_name'] ?></td>  
          <td><?php echo $arr['pin'] ?></td>
          <td><?php echo $arr['joindate'] ?></td>
          <td>
            <?php
            if($arr['block'] == 0)
            {
              ?>
              <img src="img/active.png" height="40px" width="40px">
              <?php
            }
            else
            {
             ?>
             <img src="img/inactive.png" height="40px" width="40px">
             <?php
           }
           ?>
         </td>
         <td>
          <?php
          if($arr['role'] == 'S')
          {
           ?>
           <a href="?user=Seller&activity=postedAds&userid=<?php echo $arr['user_id']; ?>" class="btn btn-success btn-xs" role="button">Posted Ads</a>
           <?php
         }
         else
         {
           ?>
           <a href="?user=Buyer&activity=wishlistedAds&userid=<?php echo $arr['user_id']; ?>" class="btn btn-success btn-xs" role="button">Wishlisted Ads</a> <br><br>
            <a href="?user=Buyer&activity=ConfirmedAds&userid=<?php echo $arr['user_id']; ?>" class="btn btn-success btn-xs" role="button">Confirmed Ads</a> 
           <?php
         }
         ?>
       </td>
       <td>
        <?php
        if($arr['block'] == 0)
        {
          ?>
          <a href="?action=block&userid=<?php echo $arr['user_id']; ?>" class="btn btn-danger btn-xs" role="button">Block</a>
          <?php
        }
        else
        {
          echo"None";
        }
        ?>
      </td>
    </tr> 
    <?php 
    $sl++;
  }

}
else
{

  $sl=1;
  $allusersdisplay =$usr -> getAllUser();
  if($allusersdisplay)
  {
    while ($arrr=$allusersdisplay->fetch_assoc())
    {
      ?>

      <tr>
       <input type="hidden" name="adid" id="hidden_userid" value="<?php echo $arrr['user_id']; ?>">
       <td>
        <?php echo $sl; ?>
      </td>
      <td><?php echo $arrr['name'] ?></td>
      <td>
        <?php
        if($arrr['role'] == 'S')
        {
          echo"<strong>Seller</strong>";
        }
        else
        {
          echo"<strong>Buyer</strong>";
        }
        ?>
      </td>
      <td><?php echo $arrr['email'] ?></td>
      <td><?php echo $arrr['phone'] ?></td>
      <td><?php echo $arrr['city_name'] ?></td>  
      <td><?php echo $arrr['pin'] ?></td>
      <td><?php echo $arrr['joindate'] ?></td>
      <td>
        <?php
        if($arrr['block'] == 0)
        {
          ?>
          <img src="img/active.png" height="40px" width="40px">
          <?php
        }
        else
        {
         ?>
         <img src="img/blocked.png" height="40px" width="40px">
         <?php
       }
       ?>
     </td>
     <td>
      <?php
      if($arrr['role'] == 'S')
      {
       ?>
       <a href="?user=Seller&activity=postedAds&userid=<?php echo $arrr['user_id']; ?>" class="btn btn-success btn-xs" role="button">Posted Ads</a>
       <?php
     }
     else
     {
       ?>
       <a href="?user=Buyer&activity=wishlistedAds&userid=<?php echo $arrr['user_id']; ?>" class="btn btn-success btn-xs" role="button">Wishlisted Ads</a> <br><br>
       <a href="?user=Buyer&activity=ConfirmedAds&userid=<?php echo $arrr['user_id']; ?>" class="btn btn-success btn-xs" role="button">Confirmed Ads</a>
       <?php
     }
     ?>
   </td>
   <td>
    <?php
    if($arrr['block'] == 0)
    {
      ?>
      <a href="?action=block&userid=<?php echo $arrr['user_id']; ?>" class="btn btn-danger btn-xs" role="button">Block</a>
      <?php
    }
    else
    {
      echo"None";

    }
    ?>
  </td>
</tr> 
<?php 
$sl++;
}

}

}
?>      
</tbody>
</table>
</div>
</div>
</div>
</div>


<!--Modal For answer of deactivation-->
<div class="modal fade" id="myModalBlock" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class='fa fa-check-circle' style='color: yellow;position:static'></i><strong> Message.</strong>
        </h4>
      </div>
      <div class="modal-body" id="blockstatusdisplay" style="font-size: 16px;">         

      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<!--Modal For answer of deactivation-->



<?php include("inc/footer.php"); ?>


<!-- Modal -->
<div class="modal fade" id="myModalHelp" role="dialog" style="margin-top: 100px;margin-left: 800px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#2299ca;color:white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-question-circle" style="font-size:20px;position:static"></i> Status icon signification</h4>
      </div>
      <div class="modal-body" style="font-size: 16px">
        <p><img src="img/active.png" height="30px" width="30px"/> Signify Active User. </p>
        <p><img src="img/blocked.png" height="30px" width="30px"/> Signify Blocked User. </p>
      </div>
      <div class="modal-footer" style="padding: 6px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Posted,wishlisted,confirmed Ads Display-->
<div class="modal fade" id="myModalDisplayAds" role="dialog">
  <div class="modal-dialog modal-lg" style="width:100%;padding-left:16px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#2299ca;color:white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="displayAdsTitle">
      </div>
      <div class="modal-body" id="displayAds" style="font-size: 14px;overflow-y:scroll;">

      </div>
      <div class="modal-footer" style="padding: 6px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 

<!-- refresh page on modal close-->
<script>
  $('#myModalBlock,#myModalDisplayAds').on('hidden.bs.modal', function () {
   window.location="manage_users.php";
 })
</script>
<!-- refresh page on modal close-->
