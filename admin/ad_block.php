<?php
/*function __autoload($classname){
  include_once("../Classes/$classname.php");
}*/
include_once($_SERVER['DOCUMENT_ROOT']."/Classes/$classname.php");
$ads = new AdsManage();

if(isset($_GET['action']) && $_GET['action']=="block")
{
  $adid = $_GET['adid'];


    $res = $ads -> blockAd($adid);
    if($res)
    {
     echo "trueBlock";
   }
   else
   {
      echo "falseBlock";
   }

}

?>


