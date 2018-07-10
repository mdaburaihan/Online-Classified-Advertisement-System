<?php 
include("../Classes/AdsManage.php"); 
$ads = new AdsManage();

 $allAdsdisplay =$ads -> getAllAds();

$arraycity = array();
 if($allAdsdisplay)
 {
 	while($arr=$allAdsdisplay->fetch_array())
 	{
 		$arraycity[]=$arr;
 	}
   echo json_encode($arraycity);
 }
 ?>