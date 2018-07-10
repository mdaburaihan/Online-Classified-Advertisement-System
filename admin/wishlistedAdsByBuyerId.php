<?php
include("../Classes/Buyer.php"); 

$byr = new Buyer();
$buyerid = $_GET['buyerid'];

$arrayWishlistedAdsNo = array();

$resWishlistedAds = $byr -> getAllWishlistedAdsByUserId($buyerid);
if($resWishlistedAds)
{
	echo "
	<table class='table table-striped table-bordered table-hover' cellspacing='0' width='100%''>
	<tr style='background:#bcbcbc'>
	<th>SlNo</th>
	<th>Title</th>
	<th>Category</th>
	<th>Subcategory</th>
	<th>Description</th>
	<th>Imag1</th>
	<th>Image2</th>
	<th>Image3</th>
	</tr>";
	 $sl=1;
	while($row = $resWishlistedAds->fetch_assoc()) {
		 $arrayWishlistedAdsNo[] = $row['wishlist_id'];
		echo "<tr>";
		echo "<td>" .  $sl . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['cat_name'] . "</td>";
		echo "<td>" . $row['subcat_name'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>"."<img src="."../Upload/".$row['pic1']." height='80' width='80'/></td>";
		echo "<td>"."<img src="."../Upload/".$row['pic2']." height='80' width='80'/></td>";
		echo "<td>"."<img src="."../Upload/".$row['pic3']." height='80' width='80'/></td>";
		echo "</tr>";
		$sl++;
	}
	echo "<strong> Total Wishlisted Advertisements: </strong>".count($arrayWishlistedAdsNo);
	echo "</table>";

}
else
{
	echo"<div class='alert alert-success' style='font-size: 18px;padding-left: 600px;'>No Advertisements are wishlisted by this buyer.</div>";
}

?>