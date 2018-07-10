<?php
$title="Post Advertisement";
function __autoload($classname){
  include_once("admin/Classes/$classname.php");
}
include_once("Classes/AdsManage.php");
$adm=new AdsManage();
?>
<div class="panel panel-primary" style="margin-top: 5px;">
  <div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%);">Post Advertisement</div>
  <div class="panel-body">
    <form name="postad" method="post" enctype="multipart/form-data">
      <?php
      if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['pok'])){
//////before posting ad check if max ad no under current scheme is over

      //////Max ad no under current scheme (start)
       $AdNo = $slr->getAdNoUnderCurrentScheme($userId);
       if($AdNo){
         $result=$AdNo->fetch_assoc();
         $maxAdNo = $result['Ads'];
       }
      //////Max ad no under current scheme (end)

     //////Posted ad no under current scheme(start)
       $arr = array();
       $postedAds = $slr->getPostedAdNo($userId);
       if($postedAds){
        while($result=$postedAds->fetch_assoc()){
          $arr[] = $result['ad_id'];
        }
      }
      $postedAdNo = count($arr);
    //////Posted ad no under current scheme(end)

    ////checking if seller posted max no of Ads
      if(($maxAdNo - $postedAdNo)==0 || ($maxAdNo - $postedAdNo)<0 )
      {
       ?>
       <!-- <script>alert("You have submitted max no of advertisements under current Scheme.To submit new advertisement you must delete ads from the current scheme or wait until the scheme is expired.Thank you.");</script> -->
       <script>
         $(document).ready(function(){
         $('#addetailmsgdisplay').html("<strong>Note:</strong>You have submitted max no of advertisements under current Scheme.To submit new advertisement you must delete ads from the current scheme or wait until the scheme is expired.Thank you.");
         $("#addetailModal").modal();
       });
     </script>
       <?php
     }
     else
     {
      $adpost=$adm->postAd($_POST,$_FILES);
      //echo $maxAdNo;
      //echo $postedAdNo;
    }
  }
  ?>
  <span style="margin-left:480px;">
    <?php
    if(isset($adpost)){
      ?>
      <script>
         $(document).ready(function(){
         $('#addetailmsgdisplay').html("<?php echo $adpost; ?>");
         $("#addetailModal").modal();
       });
     </script>
     <?php
   }
   ?>
 </span>
 <table cellpadding="10" cellspacing="10" align="center" class="tbl">
   <tr>
     <td class="tdtxt">Ad title :</td>
     <td><input type="text" name="title" placeholder="Enter advertisement title..." value="<?php if(isset($_POST['title'])) { echo htmlentities ($_POST['title']); }?>" required></td>
   </tr>
   <tr><td>&nbsp;</td></tr>
   <tr>
     <td class="tdtxt">Category :</td>
     <td>
           <!-- <select name="catid">
             <option value="">--select--</option>
            <?php 
             $ct=new Category();
             $allcat=$ct->getAllActiveCategory();
             if($allcat){
              while($rescat=$allcat->fetch_assoc()){
                ?>
                <option value="<?php echo $rescat['cat_id']; ?>"><?php echo $rescat['cat_name']; ?></option>
                <?php
              }
             }
             ?>
           </select> -->
           <select class="cat_addetails" name="catid" onchange="fetchSubcategory(this.value)" required>
             <option value="">---Select---</option>
             <?php
             $cat = new Category();
             $allCats =$cat -> getAllActiveCategory();
             $sl=1;
             if($allCats){
              while ($arr=$allCats->fetch_assoc()){
                ?>
                <option value="<?php echo $arr['cat_id'] ?>" <?php if (isset($_POST['catid']) && isset($_POST['catid'])==$arr['cat_id']) echo "selected";?>><?php echo $arr['cat_name'] ?></option>
                <?php
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
       <td class="tdtxt">Sub category :</td>
       <td>
           <!-- <select name="subcatid" id="scatid">
              <option value="">First Select Category</option>
               <option value="">--select--</option>
            <?php 
             $sct=new Subcategory();
             $allsubcat=$sct->getAllActiveSubcategory();
             if($allsubcat){
              while($ressubcat=$allsubcat->fetch_assoc()){
                ?>
                <option value="<?php echo $ressubcat['subcat_id']; ?>"><?php echo $ressubcat['subcat_name']; ?></option>
                <?php
              }
             }
             ?>
           </select> -->
           <select class="subcat_addetails" name="subcatid" id="scatid" required>
             <option value="">--- First Select Category ---</option>



            <!--  <?php 
             $sct=new Subcategory();
             $allsubcat=$sct->getAllActiveSubcategory();
             if($allsubcat){
              while($ressubcat=$allsubcat->fetch_assoc()){
                ?>
                <option value="<?php echo $ressubcat['subcat_id']; ?>" <?php if (isset($_POST['subcatid']) && isset($_POST['subcatid'])==$ressubcat['subcat_id']) echo "selected";?>><?php echo $ressubcat['subcat_name']; ?></option>
                <?php
              }
            }
            ?> -->
          </select>
        </td>
        <tr><td>&nbsp;</td></tr>
      </tr>
      <tr>
       <td class="tdtxt">Description :</td>
       <td><textarea name="descrp" placeholder="Enter product description..." rows="8" cols="10" required><?php if(isset($_POST['descrp'])) { echo htmlentities ($_POST['descrp']); }?>
       </textarea></td>
     </tr>
     <tr><td>&nbsp;</td></tr>
     <td class="tdtxt">Images :</td>
     <td><input type="file" name="pimg1" value="<?php if(isset($_FILE['pimg1'])) { echo htmlentities ($_FILE['pimg1']); }?>" onchange="readURL1(this);"></td>
     <td>&nbsp;</td>
     <td><img id="adimg1" class="img-circle" src="Images/dummy.png" alt="Image1" width="150px" height="130px"/></td> 
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
      <td><img id="adimg2" class="img-circle" src="Images/dummy.png" alt="Image2"  width="150px" height="130px" /></td> 
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td></td>
      <td><input type="file" name="pimg3" onchange="readURL3(this);"></td>
      <td>&nbsp;</td>
      <td><img id="adimg3" class="img-circle" src="Images/dummy.png" alt="Image3" width="150px" height="130px" /></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
     <td class="tdtxt">City :</td>
     <td>
       <select class="city_addetails" name="cityid" required>
             <!--  <option value="">--select--</option>
               <?php 
             $ct=new City();
             $allcity=$ct->getAllActiveCity();
             if($allcity){
              while($rescity=$allcity->fetch_assoc()){
                ?>
                <option value="<?php echo $rescity['city_id']; ?>"><?php echo $rescity['city_name']; ?></option>
                <?php
              }
             }
             ?> -->
             <option value="">---Select---</option>
             <?php 
             $ct=new City();
             $allcity=$ct->getAllActiveCity();
             if($allcity){
              while($rescity=$allcity->fetch_assoc()){
                ?>
                <option value="<?php echo $rescity['city_id']; ?>" <?php if (isset($_POST['cityid']) && isset($_POST['cityid'])==$rescity['city_id']) echo "selected";?>><?php echo $rescity['city_name']; ?></option>
                <?php
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
       <td class="tdtxt">Price:</td>
       <td><input type="text" name="price" id="price" placeholder="Enter product price..." value="<?php if(isset($_POST['price'])) { echo htmlentities ($_POST['price']); }?>" required></td>
     </tr>
     <tr><td>&nbsp;</td></tr>
     <tr>
       <td><button type="submit" name="pok" class="btn btn-success btn-lg">Submit</button></td>
       <td></td>
       <td><button type="submit" name="pok2" class="btn btn-danger btn-lg">Reset</button></td>
     </tr>
   </table>
 </form>
</div>
</div>


<!--Modal For ad post success-->
<div class="modal fade" id="addetailModal" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <h4 class="modal-title">
         <i class='fa fa-warning' style='color: yellow'></i><strong> Warning</strong>
        </h4>
      </div>
      <div class="modal-body" id="addetailmsgdisplay" style="font-size: 16px;">         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Modal For ad post success-->



<!-- refresh page on modal close-->
<!-- <script>
  $('#addetailModal').on('hidden.bs.modal', function () {
     location.reload();
 })
</script> -->
<!-- refresh page on modal close-->


