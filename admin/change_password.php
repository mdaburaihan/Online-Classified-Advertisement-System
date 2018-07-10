<?php include("inc/header.php");?>
 <div class="main-page">
    <div class="form">
      <?php
      include("Classes/Admin.php");
      $usr=new Admin();
      if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['changePwd'])){
       $oldpwd=$_POST['oldpwd'];
       $newpwd=$_POST['newpwd'];
       $rnewpwd=$_POST['rnewpwd'];
       $adminid = Session::get("userId");

       $pwdchange=$usr->changePassword($_POST, $adminid);
     }
     ?>
<form name="pwdchange" method="post" class="changePasswordFrm">
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Change Password</div>
  <div class="panel-body">
      <section style="margin-left:320px;font-size: 16px;">
       <?php
       if(isset($pwdchange)){
        echo "$pwdchange";
      }
      ?>
    </section>
    <table cellpadding="10" cellspacing="10" align="center">
     <tr>
       <td class="ctxt">Old Password :</td>
       <td><input type="password" name="oldpwd" id="oldPassword" placeholder="Enter old password here..."></td>
       <td>&nbsp;</td>
       <td><input type="checkbox" onclick="myOldPwd()">Show</td>
     </tr>
     <tr><td>&nbsp;</td></tr>
     <tr>
       <td class="ctxt">New Password :</td>
       <td><input type="password" name="newpwd" id="newPassword" placeholder="Enter new password here..."></td>
       <td>&nbsp;</td>
       <td><input type="checkbox" onclick="myNewPwd()">Show</td>
     </tr>
     <tr><td>&nbsp;</td></tr>
     <tr>
       <td class="ctxt">Re-enter New Password :</td>
       <td><input type="password" name="rnewpwd" id="cnfrmNewPassword" placeholder="Re-enter new password here..."></td>
       <td>&nbsp;</td>
       <td><input type="checkbox" onclick="myCnfrmNewPwd()">Show</td>
     </tr>
   </table>
   <input type="submit" name="changePwd" value="Update">
  </div>
</div>
 </form>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
