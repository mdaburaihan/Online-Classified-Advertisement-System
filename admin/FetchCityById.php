<?php
include_once("Classes/City.php");

$ct=new City();


if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['type']) && $_GET['type']=="city")
{
$cityid = $_GET['cityid'];

  $res = $ct -> getCityById($cityid);
  if($res)
  {
    $data=$res->fetch_assoc();
    echo $data['city_name']; 

  }

}

?>