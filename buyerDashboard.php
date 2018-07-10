<?php
include("Classes/Buyer.php");
$byr = new Buyer();
$userId = Session::get("userId");
?>
<div class="row"> 
<div class="col-lg-10" style="border-bottom:1px solid rgb(160, 186, 24);border-left:1px solid white;background-color:rgb(225, 225, 225)">
	<marquee behavior="alternate"><h3><strong style="color: #2576b6;"><i>Welcome to Buyer's Dashboard.</i></strong></h3></marquee>
</div>
<div class="col-lg-2" style="border-bottom:1px solid rgb(160, 186, 24);">
	 <button type="button" class="btn btn-default" style="background-color: rgb(240, 248, 250)" data-toggle="modal" data-target="#myModalInfo">
	  <img src="Images/info.png"/>
	 </button>
	<a href="#" style="color:blue">Getting Started</a>
</div>
</div>
<div class="row"> 
<div class="col-lg-6" style="margin-top:20px;padding-left: 150px;">
	<div class="card card-1">
		<div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd">
			Wishlist Status
		</div>
		<div style="padding-left:10px;font-size: 16px;">
		<?php
     $WishlistArr = array();
     $WishlistedAds = $byr->getAllWishlistedAdsByUserId($userId);
     if($WishlistedAds){
      while($result=$WishlistedAds->fetch_assoc()){
        $WishlistArr[] = $result['ad_id'];

      }
    $WishlistedAdNo = count($WishlistArr);
    echo "<h4>You have <strong>$WishlistedAdNo</strong> Advertisements in Wishlist.</h4>";
    }
    else
    {
    	echo "<h4>You have no Advertisements in Wishlist.</h4>";
    }
    ?>
		</div>
	</div>
</div>
<div class="col-lg-6" style="margin-top: 20px;">
	<div class="card card-1">
		<div class="alert alert-success" style="font-size: 18px;background-color: #2576b6;color:#fdfffd">
			Confirmed Ads Status
		</div>
		<div style="padding-left:10px;font-size: 16px;">
			 <?php
     $ConfirmedArr = array();
     $ConfirmedAds = $byr->getAllConfirmedAdsByUserId($userId);
     if($ConfirmedAds){
      while($result=$ConfirmedAds->fetch_assoc()){
        $ConfirmedArr[] = $result['ad_id'];

      }
    $ConfirmedAdNo = count($ConfirmedAds);
    echo "<h4>You have Confirmed <strong>$ConfirmedAdNo</strong> Advertisements.</h4>";
    }
    else
    {
    	echo "<h4>You yet not Confirmed any Advertisement.</h4>";
    }
    ?>
		</div>
	</div>
</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="myModalInfo" role="dialog" style="margin-top: 100px;margin-left: 800px;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#2299ca;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-info-circle" style="font-size:20px;position:static"></i> Getting Started</h4>
        </div>
        <div class="modal-body">
        	<span style="font-size: 16px;color:black">You have registred yourseld as buyer. You can do the following as a buyer :</span>
            <p>
            	1. View featured advertisement details and contact info of seller(A seller is one who has given the advertisements of his/her product). You can contact to the seller and negotiate with him for the product.<br>
            	2. Search any advertisement.<br>
            	3. Wishlist your liked product's advertisement.<br>
            	4. Confirm any product's advertisement from wishlist.(When you confirm a product,an email will be sent with your contact info to the seller of the product).Remember that the seller can contact you to negotiate for his/her product.<br>
            	5. You can find your wishlisted advertisements in the menu <strong>Manage Wishlist</strong>. You can confirm,view,reomove advertisements from wishlist.<br>
            	6. You can find your confirmed advertisements in the menu <strong>Confirmed Ads</strong>.<br>
            	7. Edit your personal info in the menu <strong>Edit Profile</strong>.<br>
            	8. Change your profile password in the menu <strong>Change Password</strong>.<br>
            	

            </p>

        </div>
        <div class="modal-footer" style="padding: 6px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>