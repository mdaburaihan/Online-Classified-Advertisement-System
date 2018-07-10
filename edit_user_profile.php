<?php
include("Classes/User.php");
include("admin/Classes/City.php");
$usr=new User();
$cit=new City();
$userid = Session::get("userId");
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['updateName']) || isset($_POST['updateEmail']) || isset($_POST['updatePhone']) || isset($_POST['updateCity']) || isset($_POST['updatePin'])){
		$updateprofile=$usr->profileUpdate($_POST, $userid);
	}
}
?>
<div style="margin-top: 10px;text-align: center;color:blue;">
	<h3><u>Edit Profile</u></h3>
	<section style="margin-left:0px;font-size:18px;">
		<?php
		if(isset($updateprofile)){
			echo "$updateprofile";
		}
		?>
	</section>
</div>
<div class="col-lg-3">
</div>
<div class="col-lg-6" style="margin-top: 30px;">

	<div class="panel panel-primary">
		<div class="panel-heading" style="background: linear-gradient(to left, #a0ba18 0%, #0364c6 100%)">Edit your profile details here...</div>
		<div class="panel-body">
			<?php
			$SelectedUser = $usr -> getUserById($userid);
			if($SelectedUser){
				$arr=$SelectedUser->fetch_assoc();
				?>
				<form class="form-horizontal editprofile" method="post" id="contentid" onSubmit="return validateInputs()">
					<div class="panel-group" id="accordion">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									Name</a>
								</h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="form-group">

										<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Name">Name:</label>
										<div class="col-lg-7">
											<input type="text" class="form-control" name="name" id="name" value="<?php echo $arr['name'] ?>" onblur="validateName()">
											<label id="nameerrormsg" style="color:red;"></label>
										</div>
										<div class="col-lg-3">
											<button type="submit" name="updateName" class="btn btn-success">Save</button>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
									Email Address</a>
								</h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Email">Email:</label>
										<div class="col-lg-7"> 
											<input type="text" class="form-control" name="email" id="email" value="<?php echo $arr['email'] ?>" onblur="validateEmail()">
											<label id="emailerrormsg" style="color:red;"></label>
										</div>
										<div class="col-lg-3">
											<button type="submit" name="updateEmail" class="btn btn-success">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
									Phone No.</a>
								</h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Phone">Phone:</label>
										<div class="col-lg-7"> 
											<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $arr['phone'] ?>" onblur="validatePhone()">
											<label id="phoneerrormsg" style="color:red;"></label>
										</div>
										<div class="col-lg-3">
											<button type="submit" name="updatePhone" class="btn btn-success">Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
									City</a>
								</h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="City">City:</label>
										<div class="col-lg-7"> 
											<select name="cityid" class="form-control">
												<?php
												$cityid=$arr['city_id'];
												$res = $cit -> getCityById($cityid);
												if($res){
													$rescity=$res->fetch_assoc();           
													?>
													<option
													<?php
													if($rescity['city_id']==$arr['city_id'])
													{
														echo "Selected";
													} 
													?>
													value="<?php echo $rescity['city_id']; ?>">
													<?php echo $rescity['city_name']; ?>

												</option> 
												<?php
											}

											?>     
											<?php
											$allcit = $cit->getAllActiveCity();
											while($arrcit=$allcit->fetch_assoc())
											{
												?>
												<option value=<?php echo $arrcit['city_id']; ?>><?php echo $arrcit['city_name']; ?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-lg-3">
										<button type="submit" name="updateCity" class="btn btn-success">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
								Pin</a>
							</h4>
						</div>
						<div id="collapse5" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="form-group">
									<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Pin">Pin:</label>
									<div class="col-lg-7"> 
										<input type="text" class="form-control" name="pin" id="pin" value="<?php echo $arr['pin'] ?>" onblur="validatePin()">
										<label id="pinerrormsg" style="color:red;"></label>
									</div>
									<div class="col-lg-3">
										<button type="submit" name="updatePin" class="btn btn-success">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</form>
			<?php
		}
		?>

			<!-- <form class="form-horizontal editprofile" action="" method="post" id="contentid">
				<?php
				$SelectedUser = $usr -> getUserById($userid);
				if($SelectedUser){
					$arr=$SelectedUser->fetch_assoc();
					?>
					<div class="form-group">
						<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Name">Name:</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="name" id="name" value="<?php echo $arr['name'] ?>">
						</div>
						<div class="col-lg-3">
							<a href="#" class="btn btn-default" role="button" id="editName">Change</a>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Email">Email:</label>
						<div class="col-lg-7"> 
							<input type="text" class="form-control" name="email" id="email" value="<?php echo $arr['email'] ?>">
						</div>
						<div class="col-lg-3">
							<a href="#" class="btn btn-default" role="button" id="editName">Change</a>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Phone">Phone:</label>
						<div class="col-lg-7"> 
							<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $arr['phone'] ?>">
						</div>
						<div class="col-lg-3">
							<a href="#" class="btn btn-default" role="button" id="editName">Change</a>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="City">City:</label>
						<div class="col-lg-7"> 
							<select name="cityid" class="form-control">
								<?php
								$cityid=$arr['city_id'];
								$res = $cit -> getCityById($cityid);
								if($res){
									$rescity=$res->fetch_assoc();           
									?>
									<option
									<?php
									if($rescity['city_id']==$arr['city_id'])
									{
										echo "Selected";
									} 
									?>
									value="<?php echo $rescity['city_id']; ?>">
									<?php echo $rescity['city_name']; ?>

								</option> 
								<?php
							}

							?>     
							<?php
							$allcit = $cit->getAllCity();
							while($arrcit=$allcit->fetch_assoc())
							{
								?>
								<option value=<?php echo $arrcit['city_id']; ?>><?php echo $arrcit['city_name']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="col-lg-3">
						<a href="#" class="btn btn-default" role="button" id="editName">Change</a>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-2" style="text-align: left;font-size: 16px;" for="Pin">Pin:</label>
					<div class="col-lg-7"> 
						<input type="text" class="form-control" name="pin" id="pin" value="<?php echo $arr['pin'] ?>">
					</div>
					<div class="col-lg-3">
						<a href="#" class="btn btn-default" role="button" id="editName">Change</a>
					</div>
				</div>
				<?php
			}
			?>
			<div class="form-group"> 
				<div class="col-lg-offset-2 col-lg-8">
					<div class="col-lg-6">
						<button type="submit" class="btn btn-default">Update</button>
					</div>
					<div class="col-lg-6">
						<button type="submit" class="btn btn-default">Reset</button>
					</div>
				</div>
			</div>
		</form>
	-->
</div>
</div> 
<strong>Note</strong>: Click on the links to expand.
</div>
<div class="col-lg-3">
</div>