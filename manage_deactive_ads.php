<?php
function __autoload($classname){
  include_once("admin/Classes/$classname.php");
}
include_once("Classes/AdsManage.php");
//include_once("Helpers/Format.php");
$adm=new AdsManage();
$frmt=new Format();
?>
   <!--  <div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
     <img src="images/Loading_icon.gif" alt="Loading" />
  </div>
  <div id="main-content"> -->

    <div class="panel panel-primary" style="margin-top: 5px;">
      <div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Deactive Advertisements</div>
      <div class="panel-body">
        <div class="container-fluid" style="overflow-y:hidden;overflow-x: scroll;">
          <?php
          $userId =Session::get("userId");
          $activeAds =$adm -> getAllDeactiveAds($userId);
          ?>
          <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
                    <a href="Ad_activate_deactivate.php?action=deactivate&ad_id=<?php echo $arr['ad_id']; ?>" class="btn btn-danger" role="button">Deactivate</a>
                    <?php
                  }else{
                   /////if currently any scheme is not selected then seller can't active ads
                    $ifAnySchemeSelected = $slr-> ifAnySchemeSelected($userId);
                    if(isset($ifAnySchemeSelected)){

                      if($ifAnySchemeSelected == false){
                        ?>
                        <a href="#" class="btn btn-warning btn-xs" role="button" style="padding: 6px;cursor:not-allowed;" data-toggle="tooltip" title="You can't active this ad right now.Please select a scheme to active your ads." data-placement="right">&nbsp;&nbsp;Activate&nbsp;&nbsp;</a>

                          <br><br>

                         <button class="btn btn-primary btn-xs" style="padding: 6px;" data-toggle="modal" onclick="location.href='ad_preview.php?adid=<?php echo $arr['ad_id']; ?>';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View&nbsp;&nbsp;&nbsp;&nbsp;
                      </button>
                        <?php
                      }else{
                        ?>
                        <a href="ad_activate_deactivate.php?action=activate&ad_id=<?php echo $arr['ad_id']; ?>" class="btn btn-warning btn-xs" style="padding: 6px;" role="button">&nbsp;&nbsp;Activate&nbsp;&nbsp;</a>

                        <br><br>

                        <button class="btn btn-primary btn-xs" style="padding: 6px;" data-toggle="modal" onclick="location.href='ad_preview.php?adid=<?php echo $arr['ad_id']; ?>';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View&nbsp;&nbsp;&nbsp;&nbsp;
                      </button>
                      <?php
                    }
                  }
                }
                ?>
              </td>
              <td><a href="delete_ad_detail.php?page=deactivatepage&ad_id=<?php echo $arr['ad_id']; ?>" onClick="return confirm('Do you want to delete?')"><img src="Images/delete.png" height="40px" width="40px"></a></td>

              <td><a href="edit_ad.php?ad_id=<?php echo $arr['ad_id']; ?>"><img src="Images/edit.png" height="40px" width="40px"></a></td>
            </tr> 
            <?php 
            $sl++;
          }
        } 
        ?>        
      </tbody>
    </table>
  </div>
</div>
</div>
    <!--  </div> -->

    <script>
      $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script>


