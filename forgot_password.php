<?php 
$title="Forgot Password | Online Classified Advertisement System";
include("Inc/header.php");
include("Classes/User.php");
$usr=new User();
Session::checkUserLogin();

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['resetlink'])){
 $identifyusersendlink=$usr->identifyUserAndSendResetLink($_POST);
}
?>
<div class="form-gap" style="padding-top: 70px"></div>
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-body"  style="box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 20px 0px, rgba(0, 0, 0, 0.24) 0px 5px 5px 0px;">
          <div class="text-center">
            <h3><i class="fa fa-lock fa-4x"></i></h3>
            <h2 class="text-center">Forgot Password?</h2>
            <h5>Provide Your Register Email</h5>

            <form id="forgotpassword-form" role="form" autocomplete="off" class="form" method="post">
             <?php
             if(isset($identifyusersendlink)){
               echo "$identifyusersendlink";
             }
             ?>
             <div class="form-group">
              <div class="input-group" style="font-size: 16px;font-family:'Roboto', sans-serif;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                <input id="email" name="email" placeholder="Enter email here..." class="form-control"  type="email" required>
              </div>
            </div>
            <div class="form-group">
              <select name="role" required>

                <option value="">Select Your Role</option>
                <option value="S">
                  Seller
                </option>
                <option value="B">
                  Buyer
                </option>

              </select>
            </div>
            <div class="form-group">
              <input name="resetlink" class="btn btn-lg btn-primary btn-block" value="Send Reset Link" type="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include("Inc/footer.php"); ?>