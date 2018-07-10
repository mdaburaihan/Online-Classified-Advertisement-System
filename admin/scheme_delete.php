<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Scheme</title>
</head>
<body>
	<?php 
	include_once("Classes/Scheme.php");
	$delScheme=new Scheme();
	$schemeid=$_GET['scheme_id'];
    $del = $delScheme -> deleteScheme($schemeid);
	?>
</body>
</html>