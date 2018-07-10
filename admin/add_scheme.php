
<?php include 'Classes/Scheme.php';?>
<?php
$schm=new Scheme();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addscheme'])){
       $days=$_POST['days'];
       $ads=$_POST['ads'];
       $adminid = Session::get("userId");

       $insertSchemet=$schm->schemeInsert($days,$ads,$adminid);
}
?>
<div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Add New Scheme</div>
  <div class="panel-body">
  <div class="col-lg-8">
  <section style="margin-left:400px;font-size: 18px;">
     <?php
    if(isset($insertSchemet)){
      echo "$insertSchemet";
    }
    ?>
</section>
<form name="addScheme" method="post" class="afrm">
    <table cellpadding="10" cellspacing="10" align="center">
       <tr>
         <td class="atxt">No of Days :</td>
         <td><input type="text" name="days" id="days" placeholder="Enter days here..." value="<?php if(isset($_POST['days'])) { echo htmlentities ($_POST['days']); }?>"></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
         <tr>
         <td class="atxt">No of Ads allowed :</td>
         <td><input type="text" name="ads" id="ads" placeholder="Enter number of ads here..." value="<?php if(isset($_POST['ads'])) { echo htmlentities ($_POST['ads']); }?>"></td>
       </tr>

     </table>
     <input type="submit" name="addscheme" value="ADD">
   </form>
 </div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>
