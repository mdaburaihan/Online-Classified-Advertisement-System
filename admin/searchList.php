<?php
//$filepath = realpath(dirname(__FILE__));
//include_once ($filepath.'Classes/Others.php');
include_once("Classes/Others.php");
$othr=new Others();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$searchAds=$_POST['searchAds'];
	$selectedItem=$_POST['selectedItem'];
    
	if($selectedItem == "Category")
	{
	    $searchAds=$othr->autoCompleteSearchListCategory($searchAds);
	 }

	 if($selectedItem == "Subcategory")
	 {
	    $searchAds=$othr->autoCompleteSearchListSubcategory($searchAds);
	 }

	 if($selectedItem == "City")
	 {
	    $searchAds=$othr->autoCompleteSearchListCity($searchAds);
	 }

	 if($selectedItem == "Anything")
	 {
	    $searchAds=$othr->autoCompleteSearchListAnything($searchAds);
	 }
}

?>