<?php 
$title="Register | Online Classified Advertisement System";
include("Inc/header.php");
?>
<?php Session::checkUserLogin(); ?>
<?php
include("Classes/User.php");
include("admin/Classes/City.php");
  $usr=new User();
  $ct=new City();
?>
<!-- Start of form -->
<div class="container" >
   <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="index.php">Account</a></li>
        <li><a href="register.php">Register</a></li>
  </ul>
  
 <?php
     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){

       $uRegist=$usr->userRegistration($_POST);
   }
  ?>
       
  <div class="register-page">
  <div class="rform">
    <h2 class="main-text">Sign Up here</h2>
    <!-- Start of form -->
    <form class="register-form" method ="post" onSubmit="return validateInputs()">
   <?php
     if(isset($uRegist)){
       echo "$uRegist";
     }
     ?>
      <label id="nameerrormsg" style="color:red;"></label>
      <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])) { echo htmlentities ($_POST['name']); }?>" placeholder="Name" onblur="validateName()" required> 
    
       <label id="emailerrormsg" style="color:red;"></label>
      <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) { echo htmlentities ($_POST['email']); }?>" placeholder="Email Id" onblur="validateEmail()" required>

       <label id="phoneerrormsg" style="color:red;"></label>
      <input type="text" name="phone" id="phone" value="<?php if(isset($_POST['phone'])) { echo htmlentities ($_POST['phone']); }?>" placeholder="Phone Number" onblur="validatePhone()" required>
      
     <label></label>
      <select name="cityid" required> 
         <option value="">City</option>
             <?php 
             $ct=new City();
             $allcity=$ct->getAllActiveCity();
             if($allcity){
              while($rescity=$allcity->fetch_assoc()){
                ?>
                <option value="<?php echo $rescity['city_id']; ?>" <?php if (isset($_POST['cityid']) && isset($_POST['cityid'])==$rescity['city_id']) echo "selected";?>><?php echo $rescity['city_name']; ?></option>
                <?php
              }
            }
            ?>
      </select>
      
      <label id="pinerrormsg" style="color:red;"></label>
      <input type="text" name="pin" id="pin" value="<?php if(isset($_POST['pin'])) { echo htmlentities ($_POST['pin']); }?>" placeholder="Pin" onblur="validatePin()" required>

      <label></label>
      <select name="role" required>
        <option value="">Register As</option>
        <option value="S">Seller</option>
        <option value="B">Buyer</option>
      </select>
     <label></label>
      <input type="password" name="pwd" value="<?php if(isset($_POST['pwd'])) { echo htmlentities ($_POST['pwd']); }?>" placeholder="Password" required>
      <label></label>
      <input type="password" name="cpwd" value="<?php if(isset($_POST['cpwd'])) { echo htmlentities ($_POST['cpwd']); }?>" placeholder="Confirm Password" required>
       <input type="text" name="captcha" id="captcha" placeholder="Enter Image Contents" style="width:68% !important" required/>
     <img src='Captcha.php'/> 
      
      <button class="btn" name="register">Register</button>
      <p class="message">Already have an account? <a href="login.php" onmouseover="this.style.color='red'"
        onmouseout="this.style.color='#337ab7'">Login</a></p>
    </form>
    <!-- End of form -->
   </div>
  </div>
</div>

<!-- End of form -->
<?php include("Inc/footer.php"); ?>