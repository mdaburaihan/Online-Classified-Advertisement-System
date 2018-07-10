<?php
function __autoload($classname){
  include_once("admin/Classes/$classname.php");
}
include_once("Classes/AdsManage.php");
//include_once("Helpers/Format.php");
$adm=new AdsManage();
$frmt=new Format();
?>

<script>
  $(document).ready(function(){
    $('#answerBtn').click(function(){
      var adid= document.getElementById("hidden_adid").value;
      var ans = $("input[name='myRadio']:checked").val();


      $.ajax({
        type: "GET",
        url: "ad_activate_deactivate.php",
        data: {adid:adid,ans:ans,action:'deactivate'},
        cache: false,
        success: function(data) {

          //alert("hello");
         var result = $.trim(data);
         if(result=="trueSold")
         {
         $('#answerdisplay').html("Thank you for your answer.");
         $(".soldBtn").show();
         $("#myModalWhyDeactivate").modal('hide');
          $("#myModalAnswer").modal('show');
        }
        if(result=="truePoorAttention")
        {
         $('#answerdisplay').html("Thank you for your answer.");
        $(".activeadsBtn").show();
        $("#myModalWhyDeactivate").modal('hide');
          $("#myModalAnswer").modal('show');
        }
        if(result=="falseSold")
        {
          window.location="404.php";
        }
        if(daresultta=="falsePoorAttention")
        {
          window.location="404.php";
        }

      },
      error: function(err) {
        alert(err);
      }
    });
    });
  });
</script>
    <!-- <div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
     <img src="images/Loading_icon.gif" alt="Loading" />
  </div>
  <div id="main-content"> -->
    <div class="panel panel-primary" style="margin-top: 5px;">
      <div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%);">Active Advertisements</div>
      <div class="panel-body">
        <div class="container-fluid" style="overflow-y:hidden;overflow-x: scroll;">
          <?php
          $userId=Session::get("userId");
          $activeAds =$adm -> getAllActiveAds($userId);
          ?>
          <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="font-size: 16px;">
           <thead>
             <tr>
              <th>Sl.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Subcategory</th>
              <th>Description</th>
              <th>Image1</th>
              <th>Image2</th>
              <th>Image3</th>
              <th>City</th>
              <th>Price</th>
              <th>Action</th>
              <th>Delete</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sl.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Subcategory</th>
              <th>Description</th>
              <th>Image1</th>
              <th>Image2</th>
              <th>Image3</th>
              <th>City</th>
              <th>Price</th>
              <th>Action</th>
              <th>Delete</th>
              <th>Edit</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
//include("lib/database.php");
//     	$sql="SELECT * FROM ad_details p,category c,city ct,subcategory s WHERE p.cat_id=c.cat_id AND p.city_id=ct.city_id AND p.subcat_id=s.subcat_id";
// $res=mysql_query($sql);
            ?>
            <?php
            $sl=1;
            if($activeAds){
              while ($arr=$activeAds->fetch_assoc()){?>
              <tr>
                <td><?php echo $sl; ?></td>
                <td><?php echo $arr['title'] ?></td>
                <td><?php echo $arr['cat_name'] ?></td>
                <td><?php echo $arr['subcat_name'] ?></td>
                <td><?php echo $frmt->textShorten($arr['description']); ?></td>
                <td><img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" height="100" width="100"/></td>
                <td><img src="<?php echo 'Upload' . '/' . $arr['pic2']; ?>" height="100" width="100"/></td>
                <td><img src="<?php echo 'Upload' . '/' . $arr['pic3']; ?>" height="100" width="100"/></td>
                <td><?php echo $arr['city_name'] ?></td>
                <td><?php echo "₹".$arr['price'] ?></td>
                <td>
                  <?php 
                  if($arr['active_status'] == 1){
                    ?>

                    <button class="btn btn-danger btn-xs" style="padding: 6px;" data-toggle="modal"
                    data-target="#myModalWhyDeactivate">
                    Deactivate
                  </button>

                  <br><br>

                  <button class="btn btn-primary btn-xs" style="padding: 6px;" data-toggle="modal" onclick="location.href='ad_preview.php?adid=<?php echo $arr['ad_id']; ?>';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View&nbsp;&nbsp;&nbsp;&nbsp;
                  </button>
                  <input type="hidden" name="adid" id="hidden_adid" value="<?php echo $arr['ad_id']; ?>">
                  <?php
                }else{
                 ?>
                 <a href="ad_activate_deactivate.php?action=activate&ad_id=<?php echo $arr['ad_id']; ?>" class="btn btn-success" role="button">Activate</a>
                 <?php
               }
               ?>
             </td>
             <td><a href="delete_ad_detail.php?page=activatepage&ad_id=<?php echo $arr['ad_id']; ?>" onClick="return confirm('Do you want to delete?')"><img src="Images/delete.png" height="40px" width="40px"></a></td>

             <td><a href="edit_ad.php?ad_id=<?php echo $arr['ad_id']; ?>"><img src="Images/edit.png" height="40px" width="40px"></a></td>
           </tr> 
           <?php 
           $sl++;
         }
       } 
       ?>        
     </tbody>
   </table>
   <!--  </div> -->
   <script>
    $(document).ready(function() {
      $('#example').DataTable();
    } );
  </script>
</div>
</div>
</div>

<!--Modal For Asking Why Deactivate Ad-->
<div class="modal fade" id="myModalWhyDeactivate" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class="fa fa-question-circle" style="color: yellow"> </i><strong> Why are you deactivating this ad?</strong>
        </h4>
      </div>
      <div class="modal-body">
        <form name="myForm">
         <h4> <input type="radio" name="myRadio" id="myRadio"  value="1" /> I got buyer for this product.</h4>
         <h4> <input type="radio" name="myRadio" id="myRadio"  value="2" /> This advertisement is getting poor attention.</h4>
       </form>
     </div>
     <div class="modal-footer" style="padding: 8px;">  
      <button type="button" class="btn btn-success" id="answerBtn">Submit Answer</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<!--Modal For Asking Why Deactivate Ad-->

<!--Modal For answer of deactivation-->
<div class="modal fade" id="myModalAnswer" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class='fa fa-check-circle' style='color: yellow'></i><strong> Got your response.</strong>
        </h4>
      </div>
      <div class="modal-body" id="answerdisplay" style="font-size: 16px;">         
         Thank you for your answer.
      </div>
      <div class="modal-footer">
       <button type='button' style='display:none;' class='btn btn-success soldBtn' onclick="location.href = 'seller_dashboard.php?sold_products';">Go to Sold Products</button>

       <button type='button' style="display:none;" class='btn btn-success activeadsBtn' onclick="location.href='seller_dashboard.php?deactive_ads';">Go to Deactive Ads</button>

       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<!--Modal For answer of deactivation-->

<!-- refresh page on modal close-->
<script>
  $('#myModalAnswer').on('hidden.bs.modal', function () {
   location.reload();
 })
</script>
<!-- refresh page on modal close-->