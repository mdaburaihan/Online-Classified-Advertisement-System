<!-- <div style="margin-top: 10px;text-align: center;color:blue;">
	<h3><u>Wishlisted Advertisements</u></h3>
</div> -->
<?php
include_once("Classes/Buyer.php");
?>
<div class="panel panel-primary" style="margin-top: 5px;">
	<div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Wishlisted Product's Advertisements</div>
	<div class="panel-body">
		<?php
		$buy = new Buyer();
		$userid= Session::get("userId"); 
		$getWishlistedAds = $buy->getAllWishlistedAdsByUserId($userid);
		if($getWishlistedAds){
			while ($arr=$getWishlistedAds->fetch_assoc()){
				?>
				<div class="col-lg-3" style="margin-top: 10px;">
					<div class="thumbnail" style="border:1px solid #29bbeb;">
						<span style="font-size: 16px;"><?php echo $arr['title']; ?></span><span style="margin-left: 120px;">Price :<?php echo "₹".$arr['price']; ?></span>
						<a href="#">
							<img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" width="200px">
							<div class="caption" style="padding: 8px;border-top: 1px solid #29bbeb;background-color: #ccd175;">
								<button type="button" class="btn btn-success btn-sm" onclick="location.href = 'marked_as_confirmed.php?adid=<?php echo $arr['ad_id']; ?>&userid=<?php echo $userid; ?>';">Confirm</button>
								<button type="button" class="btn btn-primary" onclick="location.href = 'ad_detail_display.php?adid=<?php echo $arr['ad_id']; ?>';">View</button>
								<button type="button" class="btn btn-danger btn-sm" onclick="location.href = 'remove_from_wishlist.php?adid=<?php echo $arr['ad_id']; ?>&userid=<?php echo $userid; ?>';">Remove</button>
							</div>
						</a>
					</div>
				</div>
				<?php
			}
		}
		else
		{
			?>
			<div class="alert alert-success" style="margin-top: 40px;font-size: 24px;padding-left: 400px;">
				No advertisements found in the wishlist.
			</div>
			<?php
		}
		?>
	</div>
</div>
