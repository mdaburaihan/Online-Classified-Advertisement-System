<?php include("inc/header.php"); ?>
<body>

 <div class="well">
  <h4>Manage Category</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_category.php?add_Category';">Add New Category</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_category.php?category_list';">All Category List</button>
</div>
<div>
  <?php 
  if(isset($_GET['add_Category']))
  {
    ?>
    <div>
      <?php
      include("add_Category.php");
    }
    ?>
  </div>
  <?php 
  if(isset($_GET['category_list']))
  {
    ?>
    <div>
      <?php
      include("category_list.php");
    }
    ?>
  </div>

  <?php include 'Classes/Category.php';?>
  <?php
  $cat=new Category();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatecat'])){
   $catName=$_POST['catname'];
   $catid=$_POST['catid'];
   $adminid = Session::get("userId");

   $updateCat=$cat->catUpdate($catName,$catid,$adminid);
 }
 ?>
 <div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Edit Category</div>
  <div class="panel-body">
  <div class="col-lg-8">
  <section style="margin-left:400px;font-size: 18px;">
    <?php
    if(isset($updateCat)){
     echo "$updateCat";
   }
   ?>
 </section>
 <form name="editcategory" method="post" class="afrm">
  <?php
  $catid = $_GET['cat_id'];
  $SelectedCat = $cat -> getCategoryById($catid);
  if($SelectedCat){
    $arr=$SelectedCat->fetch_assoc();
    ?>
    <table cellpadding="10" cellspacing="10" align="center">
      <input type="hidden" name="catid" value="<?php echo $arr['cat_id'] ?>">
      <tr>
       <td class="atxt">Edit Category :</td>
       <td><input type="text" name="catname" value="<?php echo $arr['cat_name'] ?>"></td>
     </tr>
   </table>
   <?php
 }
 ?>
 <input type="submit" name="updatecat" value="Update">
</form>
</div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>

<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php
include("inc/footer.php");
?>