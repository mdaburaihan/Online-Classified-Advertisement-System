<?php include("inc/header.php"); ?>
<?php 
include("Classes/Admin.php"); 
$adm = new Admin();
?>
<?php 
include("Classes/City.php"); 
?>
<?php
if(isset($_GET['action']) && $_GET['action']=="block")
{
  $userid = $_GET['userid'];


  $res = $usr -> blockUser($userid);
  if($res)
  {
    ?>
    <script>
      $(document).ready(function(){
       $('#blockstatusdisplay').html("User is Blocked Successfully.");
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
?>


<div class="well" style="height: 130px;">
  <h4>Admin members of the system</h4>
</div>


<div id="overlay" align="center" style="padding-top: 100px;padding-left: 100px;">
 <img src="img/Loading_icon.gif" alt="Loading" />
</div>
<div id="main-content">
  <div class="container-fluid">
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 16px;">Admin Members</div>
      <div class="panel-body">

      <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Sl.</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email Id</th>
            <th>Contact No</th>
            <th>Member Since</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Sl.</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email Id</th>
            <th>Contact No</th>
            <th>Member Since</th>
          </tr>
        </tfoot>
        <tbody>    
       <?php
        
      $sl=1;
      $allAdmins =$adm -> getAllAdmin();
       if($allAdmins)
        {
        while ($arrr=$allAdmins->fetch_assoc())
          {
          ?>

            <tr>
             <input type="hidden" name="adid" id="hidden_userid" value="<?php echo $arrr['admin_id']; ?>">
             <td>
              <?php echo $sl; ?>
            </td>
            <td><?php echo $arrr['name'] ?></td>
            <td>
              <?php
              if($arrr['role'] == 'SA')
              {
                echo"<strong>Super Admin</strong>";
              }
              else
              {
                echo"<strong>Admin</strong>";
              }
              ?>
            </td>
            <td><?php echo $arrr['email'] ?></td>
            <td><?php echo $arrr['phone'] ?></td> 
            <td><?php echo $arrr['date'] ?></td>
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

<!-- refresh page on modal close-->
<script>
  $('#myModalBlock').on('hidden.bs.modal', function () {
   window.location="manage_users.php";
 })
</script>
<!-- refresh page on modal close-->

<?php include("inc/footer.php"); ?>


<!-- Modal -->
  <div class="modal fade" id="myModalHelp" role="dialog" style="margin-top: 100px;margin-left: 800px;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#2299ca;color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-question-circle" style="font-size:20px;position:static"></i> Status icon signification</h4>
        </div>
        <div class="modal-body" style="font-size: 16px">
        <p><img src="img/active.png" height="30px" width="30px"/> Signify Active User. </p>
        <p><img src="img/blocked.png" height="30px" width="30px"/> Signify Blocked User. </p>
        </div>
        <div class="modal-footer" style="padding: 6px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>