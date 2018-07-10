<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Subcategory</title>
</head>
<body>
	<?php 
	include_once("Classes/Subcategory.php");
	$delsubcat=new Subcategory();
	$subcatid=$_GET['subcat_id'];
    $del = $delsubcat -> deleteSubcategory($subcatid);
	?>
</body>
</html>