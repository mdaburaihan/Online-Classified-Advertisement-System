<?php include("inc/header.php"); ?>
<?php 
include("../Classes/AdsManage.php"); 
$ads = new AdsManage();

include("../Classes/User.php"); 
$usr = new User();
?>
<?php 
include("Classes/Category.php");
include("Classes/Subcategory.php"); 
?>

<?php
if(isset($_GET['action']) && $_GET['action']=="block")
{
  $adid = $_GET['adid'];


  $res = $ads -> blockAd($adid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("Advertisement is blocked successfully.");
       $("#myModalBlock").modal('show');

     });
   </script>
   <?php
 }
 else
 {
  header("location:404.php");
}

}



if(isset($_GET['action']) && $_GET['action']=="unblock")
{
  $adid = $_GET['adid'];


  $res = $ads -> deactivateAd($adid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("Advertisement is unblocked successfully.");
       $("#myModalBlock").modal('show');

     });
   </script>
   <?php
 }
 else
 {
  header("location:404.php");
}
}




/////Display Seller Details(start)////
if(isset($_GET['activity']) && $_GET['activity']=="SellerInfo")
{
  $sellerid = $_GET['userid'];

 // echo"<script>alert('Hello');</script>";

  $SellerDetails=$usr->getUserById($sellerid);

  if($SellerDetails)
  {
    $resSellerDetails=$SellerDetails->fetch_assoc();

    $sellerName=$resSellerDetails['name'];
    $sellerEmail=$resSellerDetails['email'];
    $sellerPhone=$resSellerDetails['phone'];
    ?>
    <script>
      $(document).ready(function(){
       $('#displaySellerInfo').html("<?php echo '<strong>Name:</strong> '.$sellerName.'<br><br><strong>Email:</strong> '.$sellerEmail.'<br><strong>Phone No:</strong> '.$sellerPhone ?>");
       $('#myModalDisplaySellerDetails').modal('show');
     });
   </script>
   <?php
 }
}
/////Display Seller Details(end)////
?>


<div class="well" style="height: 130px;">
	<h4>Search Advertisments Category-Subcategory Wise</h4>
 <form name="search_ads" method="post" style="margin-left: 100px;">  
   <div class="col-lg-6" style="margin-top: 20px;">
    <div class="col-lg-2" style="font-size: 16px;">
     <label>Category :</label>
   </div>
   <div class="col-lg-4">
    <select class="cat_select form-control" name="catid" id="setcatid">
     <option value="">---Select---</option>
     <?php
     $cat = new Category();
     $allCats =$cat -> getAllCategory();

     if($allCats){
      while ($catarr=$allCats->fetch_assoc()){
        ?>
        <option value="<?php echo $catarr['cat_id'] ?>"><?php echo $catarr['cat_name'] ?></option>
        <?php
      }
    }
    ?>
  </select>
</div>
<div class="col-lg-2" style="font-size: 16px;">
 <label>Subcategory:</label>
</div>
<div class="col-lg-4">
  <select class="cat_select form-control" name="subcatid" id="setsubcatid">
   <option value="">---Select---</option>
   <?php
   $scat = new Subcategory();
   $allSubcats =$scat -> getAllSubcategory();

   if($allSubcats){
    while ($subcatarr=$allSubcats->fetch_assoc()){
      ?>
      <option value="<?php echo $subcatarr['subcat_id'] ?>"><?php echo $subcatarr['subcat_name'] ?></option>
      <?php
    }
  }
  ?>
</select>
</div>
</div>
<div class="col-lg-6" style="margin-top: 20px;">
  <div class="col-lg-2">
    <button type="submit" name="search" class="btn btn-primary">Search</button>
  </div>
  <div class="col-lg-6">

  </div>
  <div class="col-lg-4" style="text-align: right">
   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalHelp">
    <img src="img/help.png"/>
  </button>
  <a href="#">Need Help?</a>
</div>
<!--<div class="col-lg-4" id="setcat">

</div>
<div class="col-lg-2">
  <label>Subcategory:</label>
</div>
<div class="col-lg-4">
  <label></label>
</div> -->
</div>
</form>
</div>
<script type="text/javascript">
  document.getElementById('setcatid').value = "<?php echo $_POST['catid'];?>";
  document.getElementById('setsubcatid').value = "<?php echo $_POST['subcatid'];?>";
</script>

<div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
 <img src="img/Loading_icon.gif" alt="Loading" />
</div>
<!-- <div id="test" style="display: none;">
  <div class="alert alert-danger" style="font-size:18px;text-align: center;">
    No Advertisements Available.
  </div>
</div> -->
<div id="main-content">
  <div class="container-fluid">
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Advertisements Submitted by Sellers</div>
      <div class="panel-body">
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search'])){

         $catid=$_POST['catid'];
         $subcatid=$_POST['subcatid'];


         if($catid=="" && $subcatid=="")
         {
          echo "<script>alert('Please Select Category or Subcategory.');</script>";
          ?>
          <script>
            window.location="search_cat_subcat_wise.php";
          </script>
          <?php
        }
        
        $allAds =$ads -> getAdsCatSubcatWise($_POST);
        if(empty($allAds))
        {
          echo"<script>alert('No Advertisements Found');</script>";
          ?>
          <script>
            window.location="search_cat_subcat_wise.php";
          </script>
          <?php
        }

      }
      ?>

      <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Sl.</th>
            <th>Date</th>
            <th>Title</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Description</th>
            <th>Image1</th>
            <th>Image2</th>
            <th>Image3</th>
            <th>City</th>
            <th>Price</th>
            <th>Status</th>
            <th>Seller</th>
            <th>Action</th>

          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Sl.</th>
            <th>Date</th>
            <th>Title</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Description</th>
            <th>Image1</th>
            <th>Image2</th>
            <th>Image3</th>
            <th>City</th>
            <th>Price</th>
            <th>Status</th>
            <th>Seller</th>
            <th>Action</th>

          </tr>
        </tfoot>
        <tbody>    
         <?php
         $sl=1;
         if(isset($allAds))
         {
          while ($arr=$allAds->fetch_assoc())
          {
            ?>

            <tr>
             <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">
             <td>
              <?php echo $sl; ?>
            </td>
            <td><?php echo $arr['adpostdate'] ?></td>
            <td><?php echo $arr['title'] ?></td>
            <td><?php echo $arr['cat_name'] ?></td>
            <td><?php echo $arr['subcat_name'] ?></td>
            <td><?php echo $arr['description'] ?></td>
            <td><img src="<?php echo '../Upload' . '/' . $arr['pic1']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><img src="<?php echo '../Upload' . '/' . $arr['pic2']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><img src="<?php echo '../Upload' . '/' . $arr['pic3']; ?>" height="100" width="100" class="zoomeffect"/></td>
            <td><?php echo $arr['city_name'] ?></td>
            <td><?php echo "₹".$arr['price'] ?></td>
            <td>
              <?php 
              if($arr['active_status'] == 0){
                ?>
                <img src="img/inactive.png" height="40px" width="40px">
                <?php
              }else if($arr['active_status'] == 1){
                ?>
                <img src="img/active.png" height="40px" width="40px">
                <?php
              }else if($arr['active_status'] == 2){
                ?>
                <img src="img/deleted.jpg" height="40px" width="40px">
                <?php
              }else if($arr['active_status'] == 3){
                ?>
                <img src="img/soldout.png" height="40px" width="40px">
                <?php
              }else if($arr['active_status'] == 4){
                ?>
                <img src="img/blocked.png" height="40px" width="40px">
                <?php
              }else{
                echo"Not Found.";
              }
              ?>
            </td>
            <td> 
             <a href="?activity=SellerInfo&userid=<?php echo $arr['user_id']; ?>" class="btn btn-info btn-xs" role="button">Show</a>
           </td>
           <td>
            <?php
            if($arr['active_status'] == 0 || $arr['active_status'] == 1)
            {
              ?>
              <!-- <button type="button" class="btn btn-danger btn-xs" id="blockBtn">Block</button> -->
              <a href="?action=block&adid=<?php echo $arr['ad_id']; ?>" class="btn btn-danger btn-xs" role="button">Block</a>
              <?php
            }
            else if($arr['active_status'] == 2 || $arr['active_status'] == 3)
            {
              echo"None";
            }
            else
            {
              ?>
              <a href="?action=unblock&adid=<?php echo $arr['ad_id']; ?>" class="btn btn-success btn-xs" role="button">Unblock</a>
              <?php
            }
            ?>
            <!-- <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>"> -->
          </td>
        </tr> 
        <?php 
        $sl++;
      }

    }
    else
    {

      $sl=1;
      $allAdsdisplay =$ads -> getAllAds();
      if($allAdsdisplay)
      {
        while ($arrr=$allAdsdisplay->fetch_assoc())
        {
          ?>

          <tr>
           <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arrr['ad_id']; ?>">
           <td>
            <?php echo $sl; ?>
          </td>
          <td><?php echo $arrr['adpostdate'] ?></td>
          <td><?php echo $arrr['title'] ?></td>
          <td><?php echo $arrr['cat_name'] ?></td>
          <td><?php echo $arrr['subcat_name'] ?></td>
          <td><?php echo $arrr['description'] ?></td>
          <td><img src="<?php echo '../Upload' . '/' . $arrr['pic1']; ?>" height="100" width="100" class="zoomeffect"/></td>
          <td><img src="<?php echo '../Upload' . '/' . $arrr['pic2']; ?>" height="100" width="100" class="zoomeffect"/></td>
          <td><img src="<?php echo '../Upload' . '/' . $arrr['pic3']; ?>" height="100" width="100" class="zoomeffect"/></td>
          <td><?php echo $arrr['city_name'] ?></td>
          <td><?php echo "₹".$arrr['price'] ?></td>
          <td>
            <?php 
            if($arrr['active_status'] == 0){
              ?>
              <img src="img/inactive.png" height="40px" width="40px">
              <?php
            }else if($arrr['active_status'] == 1){
              ?>
              <img src="img/active.png" height="40px" width="40px">
              <?php
            }else if($arrr['active_status'] == 2){
              ?>
              <img src="img/deleted.jpg" height="40px" width="40px">
              <?php
            }else if($arrr['active_status'] == 3){
              ?>
              <img src="img/soldout.png" height="40px" width="40px">
              <?php
            }else if($arrr['active_status'] == 4){
              ?>
              <img src="img/blocked.png" height="40px" width="40px">
              <?php
            }else{
              echo"Not Found.";
            }
            ?>
          </td>
          <td> 
           <a href="?activity=SellerInfo&userid=<?php echo $arrr['user_id']; ?>" class="btn btn-info btn-xs" role="button">Show</a>
         </td>
         <td>
          <?php
          if($arrr['active_status'] == 0 || $arrr['active_status'] == 1)
          {
            ?>
            <!-- <button type="button" class="btn btn-danger btn-xs" id="blockBtn">Block</button> -->
            <a href="?action=block&adid=<?php echo $arrr['ad_id']; ?>" class="btn btn-danger btn-xs" role="button">Block</a>
            <?php
          }
          else if($arrr['active_status'] == 2 || $arrr['active_status'] == 3)
          {
            echo"None";
          }
          else
          {
            ?>
            <a href="?action=unblock&adid=<?php echo $arrr['ad_id']; ?>" class="btn btn-success btn-xs" role="button">Unblock</a>
            <?php
          }
          ?>
          <!-- <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>"> -->
        </td>
      </tr> 
      <?php 
      $sl++;
    }

  }

}
?>      
</tbody>
</table>
</div>
</div>
</div>
</div>


<!--Modal For answer of deactivation-->
<div class="modal fade" id="myModalBlock" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class='fa fa-check-circle' style='color: yellow;position:static'></i><strong> Message.</strong>
        </h4>
      </div>
      <div class="modal-body" id="blockstatusdisplay" style="font-size: 16px;">         

      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<!--Modal For answer of deactivation-->



<?php include("inc/footer.php"); ?>

<!--Modal Display Seller Details-->
<div class="modal fade" id="myModalDisplaySellerDetails" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class='fa fa-check-circle' style='color: yellow;position:static'></i><strong> Seller's Info</strong>
        </h4>
      </div>
      <div class="modal-body" id="displaySellerInfo" style="font-size: 16px;">         

      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<!--Modal Display Seller Details-->

<!-- Modal -->
<div class="modal fade" id="myModalHelp" role="dialog" style="margin-top: 100px;margin-left: 800px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#2299ca;color:white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-question-circle" style="font-size:20px;position:static"></i> Status icon signification</h4>
      </div>
      <div class="modal-body" style="font-size: 16px">
        <p><img src="img/active.png" height="30px" width="30px"/> Signify Active Ads. </p>
        <p><img src="img/inactive.png" height="30px" width="30px"/> Signify Inactive Ads. </p>
        <p><img src="img/blocked.png" height="30px" width="30px"/> Signify Blocked Ads. </p>
        <p><img src="img/soldout.png" height="30px" width="30px"/> Signify Sold product's Ads. </p>
        <p><img src="img/deleted.jpg" height="30px" width="30px"/> Signify Deleted Ads. </p>
      </div>
      <div class="modal-footer" style="padding: 6px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- refresh page on modal close-->
<script>
  $('#myModalBlock,#myModalDisplaySellerDetails').on('hidden.bs.modal', function () {
   window.location="search_cat_subcat_wise.php";
 })
</script>
<!-- refresh page on modal close-->


