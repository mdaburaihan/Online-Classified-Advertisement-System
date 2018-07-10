<?php
$slr = new Seller();
$userId = Session::get("userId");
?>
<div class="row"> 
<div class="col-lg-10" style="border-bottom:1px solid rgb(160, 186, 24);border-left:1px solid white;background-color:rgb(225, 225, 225)">
  <marquee behavior="alternate"><h3><strong style="color: #2576b6;"><i>Welcome to Seller's Dashboard.</i></strong></h3></marquee>
</div>
<div class="col-lg-2" style="border-bottom:1px solid rgb(160, 186, 24);">
 <button type="button" class="btn btn-default" style="background-color: rgb(240, 248, 250)" data-toggle="modal" data-target="#myModalInfo">
  <img src="Images/info.png"/>
</button>
<a href="#" style="color:blue">Getting Started</a>
</div>
</div>
<div class="row" style="margin-top: 15px"> 
  <div class="col-lg-4">

   <div class="card card-1">
    <div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd"> 
      Selected Scheme Info
    </div>
    <div style="padding-left:10px;font-size:0px;">
      <?php
      $chkIfSchemeSelected = $slr-> isSchemeSelected($userId);
      if(isset($chkIfSchemeSelected)){
        echo "<h4>".$chkIfSchemeSelected."</h4>";
      }
      ?>
    </div> 
  </div>
</div>  

<div class="col-lg-4">
  <div class="card card-1">
    <div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd"> 
      Selected Scheme Validity
    </div>
    <div style="padding-left:10px;font-size:0px;">
     <?php
     $remainingDays = $slr->getSelectedSchemeByUserId($userId);
     if(isset($remainingDays)){
      if(empty($remainingDays)){
        ?>
        <!-- <div class="alert alert-danger" style="font-size: 18px;padding-bottom:50px;"> -->
         <?php echo "<h4>Your Scheme is expired.</h4>";?>
         <!-- </div> -->
         <?php
       }
       else
       {
        $arr = $remainingDays -> fetch_assoc();
        $deactivationDate = $arr['deactivation_date'];

        //$datetime1 = date_create("now");
        //$datetime2 = date_create($deactivationDate);

        //$diff=date_diff($datetime1,$datetime2);
        //$diff = $diff->format("%R%a days");
        //$diff = substr("$diff",1);
        //$diff=$diff+1;
        $date1 = new DateTime('today');
        $date2 = new DateTime($deactivationDate);
        $interval = $date1->diff($date2);
        $diff= $interval->format('%R%a days');
        $diff = substr("$diff",1);
        ?>
        <!--   <div class="alert alert-danger" style="font-size: 18px;padding-bottom:50px;"> -->
         <?php
         if( $diff == 0){
          echo "<h4>Your scheme will be expired today.</h4>";
        }
        ?>
        <?php
        if( $diff < 0){
          echo "<h4>Your scheme is expired.</h4>";
        }
        ?>
        <?php
        if( $diff > 0){
          echo "<h4>Your scheme will be expired after <strong>$diff</strong> .</h4>";
        }
      }
    }

    ?>
  </div> 
</div>
</div>

<div class="col-lg-4">
 <div class="card card-1">
  <div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd"> 
   Max Ads Submission
 </div>
 <div style="padding-left:10px;font-size:0px;">
   <?php
   $AdNo = $slr->getAdNoUnderCurrentScheme($userId);
   if($AdNo){
     $result=$AdNo->fetch_assoc();

        //echo "You can submit ". $result['Ads']. " Advertisements under current scheme!";

     echo "<h4>You can submit <strong>".$result['Ads']."</strong> </button>Advertisements under current scheme.</h4>";
   }
   else
   {
    echo "<h4>Please select a scheme to submit Advertisements.</h4>";
  }
  ?>
</div> 
</div>
</div>

<div class="col-lg-4">
 <div class="card card-1">
  <div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd"> 
   Current Submitted Ads
 </div>
 <div style="padding-left:10px;font-size:0px;">
   <?php
   if($AdNo)
   {
    $arr = array();
    $postedAds = $slr->getPostedAdNo($userId);
    if($postedAds){
      while($result=$postedAds->fetch_assoc()){
        $arr[] = $result['ad_id'];
                   //echo "You have submitted <button type='button' class='btn btn-warning'><span class='badge'>". $result['ad_id']."</span></button> Advertisements under current scheme!";
      }
    }
    $postedAdNo = count($arr);
    echo "<h4>You have submitted <strong>$postedAdNo</strong> Advertisements under current scheme.Whcih includes ads of previous schemes also.</h4>";
  }
  else
  {
    echo"<h4>You can't submit Advertisements right now.</h4>";
  }
  ?>
</div>
</div>
</div>
</div>


<!-- <div class="row" style="margin-top: 20px;">

  <div class="col-lg-3">
   <div class="card card-1">
    <div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd"> 
     Ads of Previous Schemes
   </div>
   <div style="padding-left:10px;font-size:0px;">
     <?php
     $PrevAdarr = array();
     $PrevpostedAds = $slr->getAdsOfPreviousSelectedSchemes($userId);
     if($PrevpostedAds){
      while($result=$PrevpostedAds->fetch_assoc()){
        $PrevAdarr[] = $result['ad_id'];

      }
    }
    $PreviousPostedAdNo = count($PrevAdarr);
    echo "<h4>You have submitted total <strong>$PreviousPostedAdNo</strong> Advertisements under previous schemes.</h4>";
    ?>
  </div>
</div>
</div>




</div> -->
<!-- Modal -->
<div class="modal fade" id="myModalInfo" role="dialog" style="margin-top: 10px;margin-left: 800px;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#2299ca;color:white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-info-circle" style="font-size:20px;position:static"></i> Getting Started</h4>
      </div>
      <div class="modal-body">
        <span style="font-size: 16px;color:black">You have registred yourseld as seller. You can do the following as a seller :</span>
        <p>
          1. Select a scheme for posting advertisements.You select scheme in the manu <strong>Choose Scheme</strong><br>
          2. Post advertisements of your product. You can post advertisements in the menu <strong>Post Advertisements</strong><br>
          3. Activate,deactivate and delete your advertisements.(When you want to deactivate your active advertisement,you will be asked a question that 'why are you deactivating your advertisement?. You have to choose one of the asnwers.<br>
          4. If you choose deactivating for poor attention then the ad will be deactivated normally and you can find it in <strong>Manage Deactive Ads</strong> menu or if you choose 'I have got buyer for this product' then the ad will be marked as sold product's advertisement. You can see your sold product's ads in <strong>Sold Products</strong> menu.<br>
          5. You can see status of all your advertisements in <strong>Advertisement Status</strong> menu.<br>
          6. You can find your active advertisements in <strong>Manage Active Ads</strong> menu. Here you can activate,delete,edit your deactive ads.<br>
          7. You can find your deactive advertisements in <strong>Manage Deactive Ads</strong> menu. Here you can deactivate,delete,edit your active ads.<br>
          8. Edit your personal info in the menu <strong>Edit Profile</strong>.<br>
          9. Change your profile password in the menu <strong>Change Password</strong>.<br>

          <strong>Note :</strong><br>
          > When your scheme will end, all your active ads will be deactivated automatically.<br>
          > You can't post any advertisement or activate any advertisement when you have no selected scheme. You must select a scheme to post and activate advertisements.<br>
          > You can't further post advertisement if you reach the limit of Max Ads in current selected scheme. You have to wait until the end of current scheme.<br>
          > When you select a new scheme, the posted advertisements in the previous scheme will also be included in the currently selected scheme and will be counted as the posted advertisements in current scheme.<br>
          > If a buyer confirm your advertisement, an email will be sent to you with the contact info of buyer. You can contact the buyer for negotiation.<br>
        </p>

      </div>
      <div class="modal-footer" style="padding: 6px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>