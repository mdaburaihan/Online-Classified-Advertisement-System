<?php 
$title="Edit Ad | Online Classified Advertisement System";
include("Inc/header.php");
 ?>
<div class="container">
<?php
function __autoload($classname){
  include_once("admin/Classes/$classname.php");
}
include_once("Classes/AdsManage.php");
$adm=new AdsManage();
$ct=new Category();
$sct=new Subcategory();
$cit  = new City();
?>
<!-- <script src="js/fetch_subcategory.js"></script> -->
 <!-- <script src="C:\wamp\www\Online_Classified_Advertisement\js\Jquery.js"></script> -->

<div class="panel panel-primary" style="margin-top: 5px;">
  <div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%);">Edit Advertisement</div>
  <div class="panel-body">
  <form name="editAd" method="post" enctype="multipart/form-data">
    <?php
    $adid = $_GET['ad_id'];
    $SelectedAd = $adm -> getAdById($adid);
    if($SelectedAd){
      $arr=$SelectedAd->fetch_assoc();
    ?>
    <input type="hidden" name="adid" value="<?php echo $arr['ad_id'] ?>">
    <table cellpadding="10" cellspacing="10" align="center" class="edittbl">
    <?php
     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['pok'])){
      $updatePost=$adm->UpdateAd($_POST,$_FILES);
    }
    ?>
    <span style="margin-left:350px;font-size: 18px;">
    <?php
    if(isset($updatePost)){
      echo "$updatePost";
    }
    ?>
  </span>
       <tr>
         <td class="edittdtxt">Ad Title :</td>
         <td><input type="text" name="title" value="<?php echo $arr['title'] ?>"></td>
       </tr>
      <tr><td>&nbsp;</td></tr>
       <tr>
         <td class="edittdtxt">Category :</td>
          <td>
           <select name="catid" class="cat_addetails" onchange="fetchSubcategory(this.value)">
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
          <?php
        }
        
        ?>     
        <?php
        $allcat = $ct->getAllCategory();
        while($arrcat=$allcat->fetch_assoc())
        {
         ?>
         <option value=<?php echo $arrcat['cat_id']; ?>><?php echo $arrcat['cat_name']; ?></option>
         <?php
       }
       ?>
     </select>
   </td>
       </tr>
       <tr><td>&nbsp;</td></tr>
        <tr>
         <td class="edittdtxt">Sub category :</td>
         <td>
            <select name="subcatid" class="subcat_addetails" id="scatid">
           <?php
            $subcategoryid=$arr['subcat_id'];
            $res = $sct -> getSubcategoryById($subcategoryid);
            if($res){
              $ressubcat=$res->fetch_assoc();           
             ?>
             <option
             <?php
             if($ressubcat['subcat_id']==$arr['subcat_id'])
             {
              echo "Selected";
            } 
            ?>
            value="<?php echo $ressubcat['subcat_id']; ?>">
            <?php echo $ressubcat['subcat_name']; ?>        
          </option> 
          <?php
        }
        
        ?> 
            <!-- <?php 
             $sct=new Subcategory();
             $allsubcat=$sct->getAllActiveSubcategory();
             if($allsubcat){
              while($ressubcat=$allsubcat->fetch_assoc()){
                ?>
                <option value="<?php echo $ressubcat['subcat_id']; ?>"><?php echo $ressubcat['subcat_name']; ?></option>
                <?php
              }
             }
             ?> -->
           </select>
         </td>
       </tr>
       <tr><td>&nbsp;</td></tr>
        <tr>
         <td class="edittdtxt">Description :</td>
         <td><textarea name="descrp" rows="8" cols="10"><?php echo $arr['description'] ?></textarea></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
         <td class="edittdtxt">Images :</td>
         <td><input type="file" name="pimg1" onchange="readURL1(this);"></td>
         <td>&nbsp;</td>
         <!-- <td><img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" height="80" width="80"/></td> -->
         <td><img id="adimg1" class="img-circle" src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" alt="Image1" width="150px" height="130px" /></td> 
         <td>&nbsp;&nbsp;&nbsp;</td>
     <td><strong style="color:red;">Note :</strong>
      <pre>This image will be 
featured in the 
Advertisement.</pre></td>    
       </tr>
        <tr><td>&nbsp;</td></tr>
       <tr>
        <td></td>
        <td><input type="file" name="pimg2" onchange="readURL2(this);"></td>
        <td>&nbsp;</td>
         <!-- <td><img src="<?php echo 'Upload' . '/' . $arr['pic2']; ?>" height="80" width="80"/></td> -->
          <td><img id="adimg2" class="img-circle" src="<?php echo 'Upload' . '/' . $arr['pic2']; ?>" alt="Image2" width="150px" height="130px" /></td> 
       </tr>
        <tr><td>&nbsp;</td></tr>
       <tr>
        <td></td>
        <td><input type="file" name="pimg3" onchange="readURL3(this);"></td>
        <td>&nbsp;</td>
        <!--  <td><img src="<?php echo 'Upload' . '/' . $arr['pic3']; ?>" height="80" width="80"/></td> -->
          <td><img id="adimg3" class="img-circle" src="<?php echo 'Upload' . '/' . $arr['pic3']; ?>" alt="Image3" width="150px" height="130px" /></td>
       </tr>
       <tr>
         <td class="edittdtxt">City :</td>
         <td>
           <select name="cityid" class="city_addetails">
          <?php
            $cityid=$arr['city_id'];
            $res = $cit -> getCityById($cityid);
            if($res){
              $rescity=$res->fetch_assoc();           
             ?>
             <option
             <?php
             if($rescity['city_id']==$arr['city_id'])
             {
              echo "Selected";
            } 
            ?>
            value="<?php echo $rescity['city_id']; ?>">
            <?php echo $rescity['city_name']; ?>
            
          </option> 
          <?php
        }
        
        ?>     
        <?php
        $allcit = $cit->getAllCity();
        while($arrcit=$allcit->fetch_assoc())
        {
         ?>
         <option value=<?php echo $arrcit['city_id']; ?>><?php echo $arrcit['city_name']; ?></option>
         <?php
       }
       ?>
           </select>
         </td>
       </tr>
       <tr><td>&nbsp;</td></tr>
        <tr>
         <td class="edittdtxt">Price:</td>
         <td><input type="text" name="price" value="<?php echo $arr['price']?>"></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
        <tr>
         <td><button type="submit" name="pok" class="btn btn-success btn-lg">Submit</button></td>
         <td>&nbsp;</td>
         <td><button type="submit" name="pok2" class="btn btn-danger btn-lg">Reset</button></td>
       </tr>
    </table>
         <?php
   }
     ?>
  </form>
</div>
<div class="panel panel-default">
  <?php 
   if($arr['active_status']==1)
   {
    ?>
      <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'seller_dashboard.php?active_ads';"><< Go Back</button></div>
    <?php
   }
   else
   {
   ?>
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'seller_dashboard.php?deactive_ads';"><< Go Back</button></div>
  <?php
}
?>
</div>
</div>
</div>

<?php include("Inc/footer.php"); ?>