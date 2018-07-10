    <?php
    function __autoload($classname){
  include_once("Classes/$classname.php");
}
   $ct = new City();
if(isset($_GET['action']) && $_GET['action']=="deactivate"){
  $cityid = $_GET['city_id'];
  $res = $ct -> deactivateCity($cityid);
  if($res){
   //header("location:manage_city.php?city_list");
   ?>
   <script>window.location="manage_city.php?city_list";</script>
   <?php
  }
}

if(isset($_GET['action']) && $_GET['action']=="activate"){
  $cityid = $_GET['city_id'];
  $res = $ct -> activateCity($cityid);
  if($res){
   //header("location:manage_city.php?city_list");
    ?>
   <script>window.location="manage_city.php?city_list";</script>
   <?php
  }
}
?>