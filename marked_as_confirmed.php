<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Marked As Confirmed Ad</title>
</head>
<body>
	<?php 
	include_once("Classes/Buyer.php");
	$obj=new Buyer();
	$adid=$_GET['adid'];
	$userid=$_GET['userid'];

	if($obj->markedAsConfirmed($adid,$userid))
	{
		//header("location:buyer_dashboard.php?wishlist");
		?>
		<script>window.location="buyer_dashboard.php?wishlist";</script>
		<?php
	}

	?>
</body>
</html>