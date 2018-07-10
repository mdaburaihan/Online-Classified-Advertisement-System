<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete City</title>
</head>
<body>
	<?php 
	include_once("Classes/City.php");
	$delcity=new City();
	$cityid=$_GET['city_id'];
    $del = $delcity -> deleteCity($cityid);
	?>
</body>
</html>