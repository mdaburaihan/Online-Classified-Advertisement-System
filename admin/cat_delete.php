<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Category</title>
</head>
<body>
	<?php 
	include_once("Classes/Category.php");
	$delcat=new Category();
	$catid=$_GET['cat_id'];
    $del = $delcat -> deleteCategory($catid);
	?>
</body>
</html>