
<?php include("admin/Classes/Scheme.php");?>

   <div class="col-lg-3">

   </div>
   <div class="col-lg-6">
   <div class="col-lg-2">
   </div>

<div class="panel panel-primary" style="margin-top: 5px;">
  <div class="panel-heading" style="text-align: center;font-size: 16px;background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%);">Choose a scheme from below</div>
  <div class="panel-body">

<form name="SelectScheme" method="post">
<?php
$schm=new Scheme();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['ChkScheme'])){
       
      $userId = Session::get("userId");
      $insertSelectedScheme = $schm-> selectedSchemeInsert($_POST,$userId);
}
?>
  <span style="margin-left:0px;font-size: 18px;">
  <?php
  if(isset($insertSelectedScheme)){?>

  <script>
  $(document).ready(function(){
     $("#schememsgdisplay").html("<?php echo $insertSelectedScheme.'<br><span><Strong>Note:</Strong>Your submitted ads in the previous scheme will be included in the currently selected scheme.</span>'; ?>");
     $("#selectschemeModal").modal();
  });
  </script>
<?php
  }
  ?>
</span>


<?php
$schm = new Scheme();
$allScheme =$schm -> getAllActiveScheme();
?>
 <div class="col-lg-8" style="padding:30px 0px 30px 30px;margin-left:100px;">
<?php
if($allScheme){
 while ($arr=$allScheme->fetch_assoc()){?>
 <div class="col-lg-2">
<input type="radio" checked="checked" name="scheme" class="checkmark" value="<?php echo $arr['scheme_id']?>">
</div>
 <div class="col-lg-10">
 <h3> <?php echo $arr['Ads'].' ads for '.$arr['days'].' days'; ?></h3>
</div>
  <?php
  }
}
?>
<button style="margin-left: 100px;margin-top: 50px;" type="submit" name="ChkScheme" class="btn btn-success btn-lg">Submit</button>

 </div>
</form>
 <div class="col-lg-2">
   </div>
</div>
 <div class="col-lg-3">
   </div>
</div>
</div>


<!--Modal For scheme selection success-->
<div class="modal fade" id="selectschemeModal" role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5088d7;color: white;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <i class='fa fa-check-circle' style='color: yellow'></i><strong> Thank you</strong>
        </h4>
      </div>
      <div class="modal-body" id="schememsgdisplay" style="font-size: 16px;">         
       
      </div>
      <div class="modal-footer">
        <button type='button' class='btn btn-success soldBtn' onclick="location.href = 'seller_dashboard.php?post_ad';">Post Ads Now</button>
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
   </div>
 </div>
</div>
<!--Modal For scheme selection success-->

<!-- refresh page on modal close-->
<script>
  $('#selectschemeModal').on('hidden.bs.modal', function () {
   window.location="seller_dashboard.php";
 })
</script>
<!-- refresh page on modal close-->