<?php
function __autoload($classname){
  include_once("Classes/$classname.php");
}
?>
<?php
$subcat=new Subcategory();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addsubcat'])){
       $subcatName=$_POST['subcat'];
       $catId=$_POST['catid'];
       $adminid = Session::get("userId");

       $insertSubcat=$subcat->subcatInsert($subcatName,$catId,$adminid);
}
?>
<div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Add New Subcategory</div>
  <div class="panel-body">
  <div class="col-lg-8">
<section style="margin-left:400px;font-size: 18px;">
     <?php
    if(isset($insertSubcat)){
      echo "$insertSubcat";
    }
    ?>
</section>
  <form name="addsubcategory" method="post" class="afrm">
    <table cellpadding="10" cellspacing="10" align="center">
       <tr>
         <td class="atxt">New Subcategory :</td>
         <td><input type="text" name="subcat" placeholder="Enter subcategory name here..."></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
        <!-- <tr>
        <td class="atxt">Select Category :</td>
         <td>
            <select name="catid">
                <option value="">---Select---</option>
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
       </tr>-->
       <tr> 
          <td class="atxt">Select Category :</td>
          <td>
          <select class="cat_select" name="catid" style="width:315px; border-style: 2px solid blue;">
             <option value="">---Select---</option>
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
     <input type="submit" name="addsubcat" value="ADD">
   </form> 
   </div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>
