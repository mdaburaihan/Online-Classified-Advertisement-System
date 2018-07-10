    <?php
    function __autoload($classname){
  include_once("Classes/$classname.php");
}
   $cat = new Category();
if(isset($_GET['action']) && $_GET['action']=="deactivate"){
  $catid = $_GET['cat_id'];
  $res = $cat -> deactivateCategory($catid);
  if($res){
   //header("location:manage_category.php?category_list");
    ?>
   <script>window.location="manage_category.php?category_list";</script>
   <?php
  }
}

if(isset($_GET['action']) && $_GET['action']=="activate"){
  $catid = $_GET['cat_id'];
  $res = $cat -> activateCategory($catid);
  if($res){
  // header("location:manage_category.php?category_list");
   ?>
   <script>window.location="manage_category.php?category_list";</script>
   <?php
  }
}
?>