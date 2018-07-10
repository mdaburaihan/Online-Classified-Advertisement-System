<?php include("inc/header.php"); ?>
 <div class="well">
  <h4>Manage Subcategory</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_subcategory.php?add_Subcategory';">Add New Subcategory</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_subcategory.php?subcategory_list';">All Subcategory List</button>
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
  <?php 
  if(isset($_GET['subcategory_list']))
  {
    ?>
    <div>
      <?php
      include("subcategory_list.php");
    }
    ?>
  </div>

  <?php include 'Classes/Subcategory.php';?>
  <?php include 'Classes/Category.php';?>
  <?php
  $scat=new Subcategory();
  $ct=new Category();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatesubcat'])){
   $subcatName=$_POST['subcatname'];
   $catid=$_POST['catid'];
   $subcatid=$_POST['subcatid'];
   $adminid = Session::get("userId");

   $updateSubcat=$scat->subcatUpdate($subcatName,$catid, $subcatid,$adminId);
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
    if(isset($updateSubcat)){
     echo "$updateSubcat";
   }
   ?>
 </section>
 <form name="editsubcategory" method="post" class="afrm">
  <?php
  $subcatid = $_GET['subcat_id'];
  $SelectedSubcat = $scat -> getSubcategoryById($subcatid);
  if($SelectedSubcat){
    $arr=$SelectedSubcat->fetch_assoc();
    ?>
    <table cellpadding="10" cellspacing="10" align="center">
      <input type="hidden" name="subcatid" value="<?php echo $arr['subcat_id'] ?>">
      <tr>
       <td class="atxt">Edit Subcategory :</td>
       <td><input type="text" name="subcatname" value="<?php echo $arr['subcat_name'] ?>"></td>
     </tr>
     <tr><td>&nbsp;</td></tr>
      <tr>
         <td class="atxt">Category :</td>
          <td>
         <!--   <select name="catid" onchange="fetchSubcategory(this.value)"> -->
           <select class="cat_select" name="catid" style="width:315px; border-style: 2px solid blue;">
            <?php
            $categoryid=$arr['cat_id'];
            $res = $ct -> getCategoryById($categoryid);
            if($res){
              $rescat=$res->fetch_assoc();           
             ?>
             <option
             <?php
             if($rescat['cat_id']==$arr['cat_id'])
             {
              echo "Selected";
            } 
            ?>
            value="<?php echo $rescat['cat_id']; ?>">
            <?php echo $rescat['cat_name']; ?>
            
          </option> 
         <!--  <?php
        }
        
        ?>     
        <?php
        $allcat = $ct->getAllActiveCategory();
        while($arrcat=$allcat->fetch_assoc())
        {
         ?>
         <option value=<?php echo $arrcat['cat_id']; ?>><?php echo $arrcat['cat_name']; ?></option>
         <?php
       }
       ?> -->
        <?php
                $cat = new Category();
                $allCats =$cat -> getAllActiveCategory();
                $sl=1;
                if($allCats){
                  while ($arr=$allCats->fetch_assoc()){
                    ?>
                    <option value="<?php echo $arr['cat_id'] ?>"><?php echo $arr['cat_name'] ?></option>
                    <?php
                  }
                }
          ?>
     </select>
   </td>
       </tr>
   </table>
   <?php
 }
 ?>
 <input type="submit" name="updatesubcat" value="Update">
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