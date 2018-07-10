<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Remove From Wishlist</title>
</head>
<body>
	<?php 
	include_once("Classes/Buyer.php");
	$obj=new Buyer();
	$adid=$_GET['adid'];
	$userid=$_GET['userid'];

	$obj->removeFromWishlist($adid,$userid);

	?>
</body>
</html>