<?php include 'Classes/Category.php';?>
<?php
$cat=new Category();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addcat'])){
       $catName=$_POST['catname'];
       $adminid = Session::get("userId");
       $insertCat=$cat->catInsert($catName,$adminid);
}
?>
<div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Add New Category</div>
  <div class="panel-body">
  <div class="col-lg-8">
<section style="margin-left:400px;font-size: 18px;">
	   <?php
		if(isset($insertCat)){
			echo "$insertCat";
		}
		?>
</section>
<form name="addcategory" method="post" class="afrm">
    <table cellpadding="10" cellspacing="10" align="center">
       <tr>
         <td class="atxt">New Category :</td>
         <td><input type="text" name="catname" placeholder="Enter category name here..."></td>
       </tr>
     </table>
     <input type="submit" name="addcat" value="ADD">
   </form>
 </div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>
