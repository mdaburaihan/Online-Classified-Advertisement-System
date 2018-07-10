<?php
function __autoload($classname){
  include_once("Classes/$classname.php");
}
$ads = new AdsManage();


if(isset($_GET['action']) && $_GET['action']=="deactivate")
{
  $adid = $_GET['adid'];
  $ans = $_GET['ans'];

  if($ans == "1")
  {
    $res = $ads -> deactivateForSold($adid);
    if($res)
    {
     echo "trueSold";
   }
   else
   {
      echo "falseSold";
   }
}
else
{
  $res = $ads -> deactivateAd($adid);
  if($res){
   echo "truePoorAttention";
 }
 else
   {
      echo "falsePoorAttention";
   }
}
}


if(isset($_GET['action']) && $_GET['action']=="activate"){
  $adid = $_GET['ad_id'];
  $res = $ads -> activateAd($adid);
  if($res){
    header("location:seller_dashboard.php?deactive_ads");
 }
}
?>


