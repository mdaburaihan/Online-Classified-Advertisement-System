
<?php
include("admin/Classes/Subcategory.php");
$scat=new Subcategory();
$cateid=$_GET['cateid'];

$subcats =$scat->getAllActiveSubcategoryByCatId($cateid);
if($subcats){
	while ($arr=$subcats->fetch_assoc()){

		$sucatid=$arr['subcat_id'];
		$sname=$arr['subcat_name'];
		echo"<option value=$sucatid>$sname</option>";

	}
}


?>
