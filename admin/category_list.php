<?php
function __autoload($classname){
  include_once("Classes/$classname.php");
}
?>
    <div id="overlay" align="center">
     <img src="img/Loading_icon.gif" alt="Loading" />
  </div>
  <div id="main-content">
  <div class="container">
  <div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">All Category List</div>
  <div class="panel-body">
<?php
  $cat = new Category();
  $allCats =$cat -> getAllCategory();
  ?>
<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>SlNo.</th>
                <th>Category</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Action</th>
               <!--  <th>Delete</th> -->
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SlNo.</th>
                <th>Category</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Action</th>
                <!-- <th>Delete</th> -->
            </tr>
        </tfoot>
        <tbody>
            <?php
            $sl=1;
            if($allCats){
                while ($arr=$allCats->fetch_assoc()){?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $arr['cat_name'] ?></td>
                    <td>
                    <?php 
                      if($arr['status'] == 1){
                        ?>
                        <img src="img/active.png" height="30px" width="30px">
                        <?php
                      }else{
                        ?>
                         <img src="img/inactive.png" height="30px" width="30px">
                        <?php
                      }
                     ?>
                     </td>
                      <td><a href="edit_category.php?cat_id=<?php echo $arr['cat_id']; ?>"><img src="../Images/edit.png" height="40px" width="40px"></a></td>
                      <td>
                        <?php 
                      if($arr['status'] == 1){?>
                        <a href="cat_active_deactive.php?action=deactivate&cat_id=<?php echo $arr['cat_id']; ?>" class="btn btn-danger" role="button">Deactivate</a>
                    <?php 
                      }else{?>
                        <a href="cat_active_deactive.php?action=activate&cat_id=<?php echo $arr['cat_id']; ?>" class="btn btn-success" role="button">&nbsp;&nbsp;Activate&nbsp;&nbsp;</a>
                        <?php
                      }
                     ?>
                    </td>
                   <!--  <td><a href="cat_delete.php?cat_id=<?php echo $arr['cat_id']; ?>" onClick="return confirm('Do you want to delete?')"><img src="../images/delete.png" height="40px" width="40px"></a></td> -->

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
 <a target="_blank" href="Category_Report.php"><img src="img/pdf_icon.png" style="margin-left: 960px;"/>Click to download in pdf</a>
</div>
</div>