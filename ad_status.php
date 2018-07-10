<?php
function __autoload($classname){
  include_once("admin/Classes/$classname.php");
}
include_once("Classes/AdsManage.php");
include_once("Classes/Buyer.php");
//include_once("Helpers/Format.php");
$adm=new AdsManage();
$byr=new Buyer();
$format = new Format();
?>


    <!-- <div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
     <img src="images/Loading_icon.gif" alt="Loading" />
   </div>-->
   <div class="panel panel-primary" style="margin-top: 5px">
    <div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Advertisement Status</div>
    <div class="panel-body">
      <div class="container-fluid" style="overflow-y:hidden;overflow-x: scroll;">
        <?php
        $userId=Session::get("userId");
        $adstatus =$adm -> getAdStatus($userId);
        ?>
        <table id="example" class="table table-striped table-bordered table-hover" style="font-size: 16px;">
         <thead>
           <tr>
            <th>Sl.</th>
            <th>Date</th>
            <th>Title</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Description</th>
            <th>Image</th>
            <th>City</th>
            <th>Price</th>
            <th>Status</th>
            <th>Wishlisted</th>
            <th>Confirmed</th>
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
            <th>Image</th>
            <th>City</th>
            <th>Price</th>
            <th>Status</th>
            <th>Wishlisted</th>
            <th>Confirmed</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $sl=1;
          if($adstatus){
            while ($arr=$adstatus->fetch_assoc()){?>
            <tr>
              <td><?php echo $sl; ?></td>
              <td><?php echo $format->formatDate($arr['date']) ?></td>
              <td><?php echo $arr['title'] ?></td>
              <td><?php echo $arr['cat_name'] ?></td>
              <td><?php echo $arr['subcat_name'] ?></td>
              <td><?php echo $format->textShorten($arr['description']); ?></td>
              <td><img src="<?php echo 'Upload' . '/' . $arr['pic1']; ?>" height="100" width="100"/></td>
              <td><?php echo $arr['city_name'] ?></td>
              <td><?php echo "₹".$arr['price'] ?></td>
              <td>
                <?php 
                if($arr['active_status'] == 1){
                  ?>
                  <img src="Images/active.png" height="50px" width="50px">
                  <?php
                }else if($arr['active_status'] == 0){
                 ?>
                 <img src="Images/inactive.png" height="50px" width="50px">
                 <?php
               }else if($arr['active_status'] == 3){
                ?>
                <img src="Images/soldout.png" height="50px" width="50px">
                <?php
              }else if($arr['active_status'] == 4){
               ?>
               <img src="Images/blocked.png" height="50px" width="50px">
               <?php
             }else{

             }
             ?>
           </td>
           <td>
            <?php 
            $WishlistedArr = array();
            $adid=$arr['ad_id'];
            $WishlistedNo = $byr->countWishlistedNo($adid);
            if($WishlistedNo){
              while($result=$WishlistedNo->fetch_assoc()){
                $WishlistedArr[] = $result['wishlist_id'];

              }
              $countWishlisted = count($WishlistedArr);
              echo "<h4>$countWishlisted</h4>";
            }
            else
            {
              echo "<h4>0</h4>";
            }
            ?>
          </td>
           <td>
            <?php 
           //  if($arr['status'] == 2){
           //   echo"<i class='fa fa-check' style='font-size:30px;color:green'></i>";
           // }
          // else{
          //   echo"<i class='fa fa-minus-circle' style='font-size:30px;color:yellow;'></i>";
          // }
            $ConfirmedArr = array();
            $adid=$arr['ad_id'];
            $ConfirmedNo = $byr->countConfirmedNo($adid);
            if($ConfirmedNo){
              while($result=$ConfirmedNo->fetch_assoc()){
                $ConfirmedArr[] = $result['wishlist_id'];

              }
              $countConfirmed = count($ConfirmedArr);
              echo "<h4>$countConfirmed</h4>";
            }
            else
            {
              echo "<h4>0</h4>";
            }
            ?>
          </td>
          <td>
            <button class="btn btn-primary btn-xs" style="padding: 6px;" onclick="location.href='ad_preview.php?adid=<?php echo $arr['ad_id']; ?>';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View&nbsp;&nbsp;&nbsp;&nbsp;
            </button>
          </td>
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
      // $('#example').dataTable({
      //   bAutoWidth: false , 
      //   aoColumns : [
      //   { sWidth: '50%' },
      //   { sWidth: '15%' },
      //   { sWidth: '15%' },
      //   { sWidth: '15%' },
      //   { sWidth: '15%' },
      //   { sWidth: '15%' },
      //   { sWidth: '10%' }
      //   ]
      // });
    });
  </script>

</div>
</div>
</div>



