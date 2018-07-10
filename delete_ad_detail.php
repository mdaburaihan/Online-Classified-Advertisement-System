
<?php 
include_once("Classes/AdsManage.php");
$delad=new AdsManage();


if(isset($_GET['page']) && $_GET['page']=="deactivatepage"){
	$adid = $_GET['ad_id'];
	$del=$delad->updateAdStatusOnDelete($adid);
	if($del){
		//header("location:seller_dashboard.php?deactive_ads");
		?>
		<script>window.location="seller_dashboard.php?deactive_ads";</script>
		<?php
	}
}


if(isset($_GET['page']) && $_GET['page']=="activatepage"){
	$adid = $_GET['ad_id'];
	$del=$delad->updateAdStatusOnDelete($adid);
	if($del){
		//header("location:seller_dashboard.php?active_ads");
		?>
		<script>window.location="seller_dashboard.php?active_ads";</script>
		<?php
	}
}

	// $SelectedAd = $delad -> getAdById($adid);
	// if($SelectedAd){
	// 	$arr=$SelectedAd->fetch_assoc();

	// 	$pimage=$arr['pic1'];
	// 	$pimage2=$arr['pic2'];
	// 	$pimage3=$arr['pic3'];	
	// 	unlink("Upload/".$pimage);
	// 	unlink("Upload/".$pimage2);
	// 	unlink("Upload/".$pimage3);
	// }
	// 	$del = $delad -> deleteAdDetail($adid);
?>
