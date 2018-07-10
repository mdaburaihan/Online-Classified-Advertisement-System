<?php
include("../Classes/AdsManage.php"); 

$ads = new AdsManage();
$sellerid = $_GET['sellerid'];

$arrayPostedAdsNo = array();

$resPostedAds = $ads -> getPostedAdsBySellerId($sellerid);
if($resPostedAds)
{

	echo "
	<table class='table table-striped table-bordered table-hover' cellspacing='0' width='100%''>
	<tr style='background:#bcbcbc'>
	<th>SlNo</th>
	<th>Date</th>
	<th>Title</th>
	<th>Category</th>
	<th>Subcategory</th>
	<th>Description</th>
	<th>Imag1</th>
	<th>Image2</th>
	<th>Image3</th>
	<th>Price</th>
	<th>Status</th>
	</tr>";
	 
	 $sl=1;
	while($row = $resPostedAds->fetch_assoc()) {
		 $arrayPostedAdsNo[] = $row['ad_id'];
		echo "<tr>";
		echo "<td>" .  $sl . "</td>";
		echo "<td>" . $row['date'] . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['cat_name'] . "</td>";
		echo "<td>" . $row['subcat_name'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>"."<img src="."../Upload/".$row['pic1']." height='80' width='80'/></td>";
		echo "<td>"."<img src="."../Upload/".$row['pic2']." height='80' width='80'/></td>";
		echo "<td>"."<img src="."../Upload/".$row['pic3']." height='80' width='80'/></td>";
		echo "<td>" ."₹". $row['price'] . "</td><td>";
		if($row['active_status']==0)
		{
			?>
			<img src='img/inactive.png' height='30' width='30'/>
			<?php
		}
		elseif($row['active_status']==1)
		{
			?>
		   <img src='img/active.png' height='30' width='30'/>
		   <?php
		}
		elseif($row['active_status']==2)
		{
			?>
		   <img src='img/deleted.jpg' height='30' width='30'/>
		   <?php
		}
		elseif($row['active_status']==3)
		{
			?>
		   <img src='img/soldout.png' height='30' width='30'/>
		   <?php
		}
		elseif($row['active_status']==4)
		{
			?>
		   <img src='img/blocked.png' height='30' width='30'/>
		   <?php
		}
		else
		{

		}
		echo "</td></tr>";
		$sl++;
	}
	echo "<strong> Total Posted Advertisements: </strong>".count($arrayPostedAdsNo);
	echo "</table>";

}
else
{
	echo"<div class='alert alert-success' style='font-size: 18px;padding-left: 600px;'>No Advertisements are posted by this seller.</div>";
}

?>