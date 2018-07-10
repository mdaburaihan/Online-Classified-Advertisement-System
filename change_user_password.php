<div style="margin-top: 10px;text-align: center;color:blue;">
	<h3><u>Change Password</u></h3>
	 <?php
      include("Classes/User.php");
      $usr=new User();
      if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatePassword'])){
       $oldpwd=$_POST['oldpwd'];
       $newpwd=$_POST['newpwd'];
       $rnewpwd=$_POST['rnewpwd'];
       $userid = Session::get("userId");

       $pwdchange=$usr->changePassword($_POST, $userid);
     }
     ?>
	<section style="margin-left:0px;font-size:18px;">
		<?php
		if(isset($pwdchange)){
			echo "$pwdchange";
		}
		?>
	</section>
</div>
<div class="col-lg-2">
</div>
<div class="col-lg-8" style="margin-top: 30px;">

	<div class="panel panel-primary">
		<div class="panel-heading" style="background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Change your password here...</div>
		<div class="panel-body">

			<form class="form-horizontal editprofile" action="" method="post" id="contentid">

				<div class="form-group">
					<label class="control-label col-lg-4" style="text-align: left;font-size: 16px;" for="Name">Old Password:</label>
					<div class="col-lg-6">
						<input type="password" class="form-control" name="oldpwd" id="oldpwd" placeholder="Enter old password">
					</div>
					<div class="col-lg-2"> 
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-lg-4" style="text-align: left;font-size: 16px;" for="Email">New password:</label>
					<div class="col-lg-6"> 
						<input type="password" class="form-control" name="newpwd" id="newpwd" placeholder="Enter new password">
					</div>
					<div class="col-lg-2"> 
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4" style="text-align: left;font-size: 16px;" for="Phone">Re-enter New Password:</label>
					<div class="col-lg-6"> 
						<input type="password" class="form-control" name="rnewpwd" id="rnewpwd" placeholder="Re-enter new password">
					</div>
					<div class="col-lg-2"> 
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-4"> 
					</div>
					<div class="col-lg-2"> 
						
					</div>
					<div class="col-lg-6"> 
						<button type="submit" name="updatePassword" class="btn btn-success">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div> 
</div>
<div class="col-lg-2">
</div>