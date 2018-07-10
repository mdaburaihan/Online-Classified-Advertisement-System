<?php include("inc/header.php"); ?>
 <div class="main-page">
    <div class="form">
  <?php
  include("Classes/Admin.php");
  $usr=new Admin();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addUser'])){

   $addUser=$usr->addNewUser($_POST);
 }
 ?>

<form name="pwdchange" method="post" class="addUserFrm">
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align: center;font-size: 16px;">Add New Admin</div>
  <div class="panel-body">
  <section style="margin-left:280px;font-size: 16px;">
   <?php
   if(isset($addUser)){
    echo "$addUser";
  }
  ?>
</section>
    <table cellpadding="10" cellspacing="10" align="center">
       <tr>
         <td class="autxt">Name :</td>
         <td><input type="text" name="name" placeholder="Enter user name here..."></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
       <tr>
         <td class="autxt">Email :</td>
         <td><input type="text" name="email" placeholder="Enter email here..."></td>
       </tr>
       <tr><td>&nbsp;</td></tr>
       <tr>
         <td class="autxt">Phone :</td>
         <td><input type="text" name="phone" placeholder="Enter phone no. here..."></td>
       </tr>
        <tr><td>&nbsp;</td></tr>
       <tr>
         <td class="autxt">Password :</td>
         <td><input type="password" name="pwd" id="myPassword" placeholder="Enter password here..."></td>
         <td>&nbsp;</td>
         <td><input type="checkbox" onclick="myPwd()">Show</td>
       </tr>
       <tr><td>&nbsp;</td></tr>
        <tr>
         <td class="autxt">Confirm Password :</td>
         <td><input type="password" name="cpwd" id="myConfirmPwd" placeholder="Re-enter password here..."></td>
         <td>&nbsp;</td>
         <td><input type="checkbox" onclick="myCPwd()">Show</td>
       </tr>
     </table>
     <input type="submit" name="addUser" value="ADD">
<!--       <input type="reset" name="reset" value="RESET"> -->
</div>
</div>
   </form>
 </div>
</div>
<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
