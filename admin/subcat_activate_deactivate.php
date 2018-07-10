    <?php
    function __autoload($classname){
  include_once("Classes/$classname.php");
}
   $scat = new Subcategory();
if(isset($_GET['action']) && $_GET['action']=="deactivate"){
  $subcatid = $_GET['subcat_id'];
  $res = $scat -> deactivateSubcategory($subcatid);
  if($res){
   //header("location:manage_subcategory.php?subcategory_list");
    ?>
  <script>window.location="manage_subcategory.php?subcategory_list";</script>
  <?php
  }
}

if(isset($_GET['action']) && $_GET['action']=="activate"){
  $subcatid = $_GET['subcat_id'];
  $res = $scat -> activateSubcategory($subcatid);
  if($res){
  // header("location:manage_subcategory.php?subcategory_list");
  ?>
  <script>window.location="manage_subcategory.php?subcategory_list";</script>
  <?php
  }
}
?>