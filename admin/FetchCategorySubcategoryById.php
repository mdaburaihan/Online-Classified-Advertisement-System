<?php
include_once("Classes/Category.php");
include_once("Classes/Subcategory.php");
$cat=new Category();
$scat=new Subcategory();

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['type']) && $_GET['type']=="category")
{
$catid = $_GET['catid'];

  $res = $cat -> getCategoryById($catid);
  if($res)
  {
    $data=$res->fetch_assoc();
    echo $data['cat_name']; 

  }

}

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['type']) && $_GET['type']=="subcategory")
{
$subcatid = $_GET['subcatid'];

  $res = $scat -> getSubcategoryById($subcatid);
  if($res)
  {
    $data=$res->fetch_assoc();
    echo $data['subcat_name']; 

  }

}
?>