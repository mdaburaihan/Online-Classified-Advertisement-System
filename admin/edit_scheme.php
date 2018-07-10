<?php include("inc/header.php"); ?>
 <div class="well">
  <h4>Manage Schemes</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_scheme.php?add_scheme';">Add New Scheme</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_scheme.php?scheme_list';">All Scheme List</button>
</div>
<div>
	<?php 
	if(isset($_GET['add_scheme']))
	{
		?>
		<div>
			<?php
			include("add_scheme.php");
		}
		?>
	</div>
	<?php 
	if(isset($_GET['scheme_list']))
	{
		?>
		<div>
			<?php
			include("scheme_list.php");
		}
		?>
	</div>
	<?php include 'Classes/Scheme.php';?>
  <?php
  $schm=new Scheme();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatescheme'])){
   $days=$_POST['days'];
   $ads=$_POST['ads'];
   $schemeid=$_POST['schemeid'];
   $adminid = Session::get("userId");

   $updateScheme=$schm->schemeUpdate($days,$ads,$schemeid,$adminid);
 }
 ?>
 <div class="container">
<div class="col-lg-2">
</div>
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Edit Scheme</div>
  <div class="panel-body">
  <div class="col-lg-8">
  <section style="margin-left:400px;font-size: 18px;">
    <?php
    if(isset($updateScheme)){
     echo "$updateScheme";
   }
   ?>
 </section>
 <form name="editscheme" method="post" class="afrm">
  <?php
  $schemeid = $_GET['scheme_id'];
  $SelectedScheme = $schm -> getSchemeById($schemeid);
  if($SelectedScheme){
    $arr=$SelectedScheme->fetch_assoc();
    ?>
    <table cellpadding="10" cellspacing="10" align="center">
      <input type="hidden" name="schemeid" value="<?php echo $arr['scheme_id'] ?>">
       <tr>
         <td class="atxt">No of Days :</td>
         <td><input type="text" name="days" id="days" value="<?php echo $arr['days'] ?>"></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
         <tr>
         <td class="atxt">No of Ads allowed :</td>
         <td><input type="text" name="ads" id="ads" value="<?php echo $arr['Ads'] ?>"></td>
       </tr>
     </table>
     <?php
 }
 ?>
     <input type="submit" name="updatescheme" value="Update">
   </form>
 </div>
 </div>
</div>
 <div class="col-lg-2">
</div>
</div>
<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
