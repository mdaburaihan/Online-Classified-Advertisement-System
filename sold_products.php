<?php
include_once("Classes/Seller.php");
//include_once("Helpers/Format.php");
$frmt=new Format();
?>

<div class="panel panel-primary" style="margin-top: 5px">
	<div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Sold Product Advertisements</div>
	<div class="panel-body">
		<?php
		$sell = new Seller();
		$userid= Session::get("userId"); 
		$getSoldProducts = $sell->getAllSoldProductsByUserId($userid);
		if($getSoldProducts){
			while ($arr=$getSoldProducts->fetch_assoc()){
				?>
				<div class="col-lg-3 soldproductsads">
					 <div class="thumbnail" style="border:1px solid #29bbeb;">
						<span style="font-size: 16px;"><strong>Title :</strong><?php echo $arr['title']; ?></span>
						<a href="#">
							<img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" width="200px">
							<div class="caption" style="border-top: 1px solid #29bbeb;background-color: #ccd175;">
							<strong>Price :</strong><?php echo "₹".$arr['price']; ?><br>
							<strong>Ad posted on :</strong><?php echo date($arr['date']); ?>
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
				No Advertisements to Display.
			</div>
			<?php
		}
		?>
	</div>
</div>
