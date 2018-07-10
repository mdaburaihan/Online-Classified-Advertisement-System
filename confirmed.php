<!-- <div style="margin-top: 10px;text-align: center;color:blue;">
	<h3><u>Confirmed Advertisements</u></h3>
</div> -->
<?php
include_once("Classes/Buyer.php");
?>
<div class="panel panel-primary" style="margin-top: 5px;">
	<div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Confirmed Product's Advertisements</div>
	<div class="panel-body">
		<?php
		$buy = new Buyer();
		$userid= Session::get("userId"); 
		$getConfirmedAds = $buy->getAllConfirmedAdsByUserId($userid);
		if($getConfirmedAds){
			while ($arr=$getConfirmedAds->fetch_assoc()){
				?>
				<div class="col-lg-3" style="margin-top: 20px;">
					<div class="thumbnail" style="border:1px solid #29bbeb;">
						<span style="font-size: 16px;"><strong>Title :</strong><?php echo $arr['title']; ?></span>
						<span style="margin-left: 50px;"><strong>Price :</strong><?php echo "₹".$arr['price']; ?></span>
						<!-- <span class="label label-success" style="margin-left: 20px;">Confirmed</span> -->
						<a href="#">
							<img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" width="200px">
							<div class="caption" style="padding-left: 100px;border-top: 1px solid #29bbeb;background-color: #ccd175;">
								<button type="button" class="btn btn-primary" onclick="location.href = 'ad_detail_display.php?adid=<?php echo $arr['ad_id']; ?>';">View</button>
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
			<div class="alert alert-success" style="margin-top: 40px;font-size: 24px;padding-left: 450px;">
				No advertisements were confirmed.
			</div>
			<?php
		}
		?>
	</div>
</div>
