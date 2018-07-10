<?php include("inc/header.php"); ?>
 <div class="main-page">
    <div class="form">
<?php
$adminid = Session::get("userId");
?>
  <?php
  include("Classes/Admin.php");
  $usr=new Admin();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['editProfile'])){
   $pwdchange=$usr->profileUpdate($_POST, $adminid);
 }
 ?>
<form name="pwdchange" method="post" class="editProfileFrm" id="contentid">
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Edit Profile</div>
  <div class="panel-body">
  <section style="margin-left:170px;font-size:16px;">
   <?php
   if(isset($pwdchange)){
    echo "$pwdchange";
  }
  ?>
</section>
<?php
$SelectedAdmin = $usr -> getAdminById($adminid);
if($SelectedAdmin){
  $arr=$SelectedAdmin->fetch_assoc();
  ?>
    <table cellpadding="10" cellspacing="10" align="center">
       <tr>
         <td class="eptxt"><b>Name :</b></td>
         <td><input type="text" name="name" id="name" value="<?php echo $arr['name'] ?>"></td>
         <td>&nbsp;</td>
         <td><a href="#" class="btn btn-default" role="button" id="editName">Change</a></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
       <tr>
         <td class="eptxt"><b>Email :</b></td>
         <td><input type="text" name="email" id="email" value="<?php echo $arr['email'] ?>"></td>
         <td>&nbsp;</td>
         <td><a href="#" class="btn btn-default" role="button" id="editEmail">Change</a></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
       <tr>
         <td class="eptxt"><b>Phone :</b></td>
         <td><input type="text" name="phone" id="phone" value="<?php echo $arr['phone'] ?>"></td>
         <td>&nbsp;</td>
         <td><a href="#" class="btn btn-default" role="button" id="editPhone">Change</a></td>
       </tr>
     </table>
     <?php
   }
     ?>
     <input type="submit" name="editProfile" value="Update">
   </div>
 </div>
   </form>
 </div>
</div>
<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
